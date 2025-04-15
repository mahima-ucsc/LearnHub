<?php

declare(strict_types=1);

namespace App\Services;

use App\Config\AppConstants;
use App\Exceptions\PayhereException;
use Framework\App;
use Framework\Database;

class PaymentService
{
    public function __construct(private Database $db) {}

    public function createPaymentHash(string $orderId, float $amount, string $currency): string
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

    public function getCousreSubperiodAmount(string $courseId, string $subperiodId)
    {
        $this->db->query("SELECT price FROM recurring_course_sub_periods WHERE course_id = :courseId AND sub_period_id = :subperiodId", [
            'courseId' => $courseId,
            'subperiodId' => $subperiodId
        ]);

        return $this->db->find()['price'];
    }

    public function createSubPeriodOrderId(string $courseId, string $subperiodId)
    {
        return 'cid_' . $courseId . '_spid_' . $subperiodId . '_' . time();
    }

    public function createPayment(string $orderId, string $courseId, string $subperiodId, string $userId, float $amount)
    {

        try {
            $this->db->beginTransaction();

            $this->db->query("INSERT INTO payments (order_id, amount, payment_status) VALUES (:orderId, :amount, :payment_status)", [
                'orderId' => $orderId,
                'amount' => $amount,
                'payment_status' => AppConstants::PAYMENT_STATUS_PENDING
            ]);

            $this->db->query("SELECT payment_id FROM payments WHERE order_id = :orderId", [
                'orderId' => $orderId
            ]);
            $paymentId = $this->db->find()['payment_id'];

            $this->db->query(
                "INSERT INTO course_payments (course_id, sub_period_id, user_id, payment_id) 
            VALUES (:courseId, :subperiodId, :userId, :paymentId)",
                [
                    'courseId' => $courseId,
                    'subperiodId' => $subperiodId,
                    'userId' => $userId,
                    'paymentId' => $paymentId
                ]
            );

            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function isPaymentVerified(array $paymentData)
    {
        $merchant_id         = $paymentData['merchant_id'] ?? '';
        $order_id            = $paymentData['order_id'] ?? '';
        $payhere_amount      = $paymentData['payhere_amount'] ?? '';
        $payhere_currency    = $paymentData['payhere_currency'] ?? '';
        $status_code         = $paymentData['status_code'] ?? '';
        $md5sig              = $paymentData['md5sig'] ?? '';

        $merchant_secret = AppConstants::PAYHERE_MERCHANT_SECRET;

        $local_md5sig = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    $payhere_amount .
                    $payhere_currency .
                    $status_code .
                    strtoupper(md5($merchant_secret))
            )
        );

        return ($local_md5sig === $md5sig);
    }

    public function handleVerifiedPayment(string $orderId, int $statusCode, float $amount)
    {
        try {
            $this->db->beginTransaction();
            // Update the payment record in the database
            $this->db->query(
                "UPDATE payments 
            SET payment_status = :payment_status, 
                amount = :payhere_amount, 
                updated_date = CURRENT_TIMESTAMP 
            WHERE order_id = :order_id",
                [
                    'payment_status' => $statusCode,
                    'payhere_amount' => $amount,
                    'order_id' => $orderId
                ]
            );

            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getOrderDetails(string $orderId)
    {


        $accessToken = $this->getRetrievalApiAccessToken(AppConstants::PAYHERE_AUTHORIZATION_CODE);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, AppConstants::PAYHERE_RETRIEVAL_API_URL . $orderId);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
        ]);

        $response = curl_exec($ch);
        $orderResponse = json_decode($response, true);

        if (curl_errno($ch)) {
            throw new PayhereException('Error: ' . curl_error($ch));
        } else if (isset($orderResponse['error']) && $orderResponse['error'] = 'invalid_token') {
            throw new PayhereException('Error: Invalid access token.');
        } else {
            return $orderResponse;
        }

        curl_close($ch);
    }

    private function getRetrievalApiAccessToken(string $apiKey)
    {
        if (
            isset($_SESSION['payhere_access_token']) &&
            isset($_SESSION['payhere_token_expiry']) &&
            time() < $_SESSION['payhere_token_expiry'] - 10
        ) {
            return $_SESSION['payhere_access_token'];
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, AppConstants::PAYHERE_AUTHORIZATION_API_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Basic ' . $apiKey,
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'client_credentials'
        ]));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new PayhereException('Error: ' . curl_error($ch));
            curl_close($ch);
            return;
        }

        $tokenData = json_decode($response, true);
        curl_close($ch);

        if (!isset($tokenData['access_token']) || !isset($tokenData['expires_in'])) {
            throw new PayhereException('Error: Unable to retrieve access token.');
            return;
        }

        $_SESSION['payhere_access_token'] = $tokenData['access_token'];
        $_SESSION['payhere_token_expiry'] = time() + $tokenData['expires_in'];

        return $_SESSION['payhere_access_token'];
    }

    public function isRecurringCourseSubPeriodPaid($userId, $courseId, $subPeriodId)
    {
        $this->processPendingRecurringCourseSubPeriodPayments($userId, $courseId, $subPeriodId);

        $paid = $this->db->query(
            "SELECT SUM(p.amount) as total_paid FROM payments p INNER JOIN course_payments cp ON p.payment_id = cp.payment_id
            WHERE cp.user_id = :user_id AND cp.course_id = :course_id AND cp.sub_period_id = :sub_period_id AND p.payment_status = " .
                AppConstants::PAYMENT_STATUS_SUCCESS,
            [
                "user_id" => $userId,
                "course_id" => $courseId,
                "sub_period_id" => $subPeriodId
            ]
        )->find();

        $subPeriodFee = $this->db->query(
            "SELECT price FROM recurring_course_sub_periods
            WHERE sub_period_id = :sub_period_id",
            [
                "sub_period_id" => $subPeriodId
            ]
        )->find();

        $isPaid = $paid && $paid['total_paid'] >= $subPeriodFee['price'];
        return $isPaid;
    }

    private function processPendingRecurringCourseSubPeriodPayments($userId, $courseId, $subPeriodId)
    {
        $pendingPayments = $this->db->query(
            "SELECT p.order_id FROM payments p INNER JOIN course_payments cp ON p.payment_id = cp.payment_id
            WHERE cp.user_id = :user_id AND cp.course_id = :course_id AND cp.sub_period_id = :sub_period_id AND p.payment_status = " .
                AppConstants::PAYMENT_STATUS_PENDING,
            [
                "user_id" => $userId,
                "course_id" => $courseId,
                "sub_period_id" => $subPeriodId
            ]
        )->findAll();

        if ($pendingPayments) {
            @$this->processPendingPayments($pendingPayments);
        }
    }


    public function isOneTimeCoursePaid($userId, $courseId)
    {
        $paid = $this->db->query(
            "SELECT SUM(p.amount) as total_paid FROM payments p INNER JOIN course_payments cp ON p.payment_id = cp.payment_id 
            WHERE cp.user_id = :user_id AND cp.course_id = :course_id AND p.payment_status = " .
                AppConstants::PAYMENT_STATUS_SUCCESS,
            [
                "user_id" => $userId,
                "course_id" => $courseId
            ]
        )->find();

        $courseFee = $this->db->query(
            "SELECT price FROM courses
            WHERE course_id = :course_id",
            [
                "course_id" => $courseId
            ]
        )->find();
        $isPaid = $paid && $paid['total_paid'] >= $courseFee['price'];
        return $isPaid;
    }

    private function processPendingPayments(array $pendingPayments)
    {
        foreach ($pendingPayments as $payment) {
            $orderDetails = $this->getOrderDetails($payment['order_id']);

            if (
                isset($orderDetails['status']) &&
                isset($orderDetails['data'][0]['amount']) &&
                isset($orderDetails['data'][0]['order_id']) &&
                AppConstants::RETRIEVAL_API_TO_CHECKOUT_API_STATUS_MAP[$orderDetails['status']] !== AppConstants::PAYMENT_STATUS_PENDING &&
                $orderDetails['data'][0]['order_id'] === $payment['order_id']
            ) {
                $this->handleVerifiedPayment(
                    (string) $orderDetails['data'][0]['order_id'],
                    (int) AppConstants::RETRIEVAL_API_TO_CHECKOUT_API_STATUS_MAP[$orderDetails['status']],
                    (float) $orderDetails['data'][0]['amount']
                );
            }
        }
    }
}
