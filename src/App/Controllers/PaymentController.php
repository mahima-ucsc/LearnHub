<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config\AppConstants;
use App\Services\PaymentService;
use Framework\App;
use Framework\TemplateEngine;

class PaymentController
{
    public function __construct(
        private TemplateEngine $view,
        private PaymentService $paymentService
    ) {}

    public function courserSubPeriodPaymentView(array $params)
    {
        $amount = $this->paymentService->getCousreSubperiodAmount($params["course_id"], $params["subperiod_id"]);
        $checkoutData = $this->paymentService->getViewDetailsForCourseSubPeriodCheckout($params["course_id"], $params["subperiod_id"]);

        echo $this->view->render('Payment/course-subperiod-payment.php', [
            "title" => "Course Payment",
            "amount" => $amount,
            "courseId" => $params["course_id"],
            "subperiodId" => $params["subperiod_id"],
        ]);
    }

    public function courseSubperiodPayment(array $params)
    {

        $orderId = $this->paymentService->createSubPeriodOrderId($params["course_id"], $params["subperiod_id"]);
        $amount = $this->paymentService->getCousreSubperiodAmount($params["course_id"], $params["subperiod_id"]);
        $currency = "LKR";

        $this->paymentService->createPayment($orderId, $params["course_id"], $params["subperiod_id"], (string) $_SESSION["user"], (float)$amount);

        echo $this->view->render('Payment/course-subperiod-payment-autosubmit.php', [
            "title" => "Course Payment",
            "first_name" => $_POST["first_name"],
            "last_name" => $_POST["last_name"],
            "email" => $_POST["email"],
            "phone" => $_POST["phone"],
            "address" => $_POST["address"],
            "city" => $_POST["city"],
            "merchant_id" => AppConstants::PAYHERE_MERCHANT_ID,
            "return_url" => AppConstants::COURSE_PAYMENT_RETURN_URL,
            "cancel_url" => AppConstants::COURSE_PAYMENT_CANCEL_URL,
            "notify_url" => AppConstants::COURSE_PAYMENT_NOTIFY_URL,
            "country" => "Sri Lanka",
            "items" => $orderId,
            "order_id" => $orderId,
            "currency" => $currency,
            "amount" => $amount,
            "hash" => $this->paymentService->createPaymentHash($orderId, (float)$amount, $currency)
        ]);
    }

    public function handlePaymentNotification()
    {
        $isPaymentVerified = $this->paymentService->isPaymentVerified($_POST);

        $logFile = AppConstants::LOG_FOLDER . 'payment_notification_log.txt';
        file_put_contents(
            $logFile,
            "Payment Notification Received:\n" . print_r($_POST, true) .
                "\nVerification Result: " . ($isPaymentVerified ? "Verified" : "Not Verified") .
                PHP_EOL . str_repeat("-", 50) . PHP_EOL,
            FILE_APPEND
        );

        if ($isPaymentVerified) {
            try {
                $this->paymentService->handleVerifiedPayment(
                    (string) ($_POST['order_id'] ?? ''),
                    (int) ($_POST['status_code'] ?? 0),
                    (float) ($_POST['payhere_amount'] ?? 0.00)
                );
            } catch (\Exception $e) {
                file_put_contents(
                    $logFile,
                    "Error handling verified payment: " . $e->getMessage() . PHP_EOL .
                        "Stack trace:\n" . $e->getTraceAsString() . PHP_EOL,
                    FILE_APPEND
                );
            }
        }

        // Respond to the notification
        http_response_code(200);
        echo "Notification received";
    }
}
