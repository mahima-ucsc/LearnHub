<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config\AppConstants;
use Framework\TemplateEngine;

class PaymentController
{
    public function __construct(
        private TemplateEngine $view
    ) {}

    public function courserSubPeriodPaymentView(array $params)
    {
        echo $this->view->render('Payment/course-subperiod-payment.php', [
            "title" => "Course Payment",
            "merchant_id" => AppConstants::PAYHERE_MERCHANT_ID,
            "return_url" => "http://localhost:8000/payment/success",
            "cancel_url" => "http://localhost:8000/payment/cancel",
            "notify_url" => "http://shouldnotbelocalhost:8000/payment/notify",
            "country" => "Sri Lanka",
            "items" => "678",
            "order_id" => "12345",
            "currency" => "LKR",
            "amount" => 1000.00,
            "hash" => $this->createPaymantHash("12345", 1000.00, "LKR")
        ]);
    }

    private function createPaymantHash(string $orderId, float $amount, string $currency): string
    {
        $hash = strtoupper(
            md5(
                AppConstants::PAYHERE_MERCHANT_ID .
                    $orderId .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5(AppConstants::PAYHERE_MERCHANT_SECRET))
            )
        );

        return $hash;
    }
}
