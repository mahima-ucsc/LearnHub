<?php

declare(strict_types=1);

namespace App\Services;

use App\Config\AppConstants;
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
}
