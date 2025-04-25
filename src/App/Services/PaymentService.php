<?php

declare(strict_types=1);

namespace App\Services;

use App\Config\AppConstants;
use App\Exceptions\PayhereException;
use Exception;
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


    public function getCourseAmount(string $courseId)
    {
        $this->db->query("SELECT price FROM courses WHERE course_id = :courseId", [
            'courseId' => $courseId
        ]);

        return $this->db->find()['price'];
    }

    public function getAdvertisementAmount(string $advertisementId)
    {
        $package = $this->db->query("SELECT package FROM advertisement WHERE advertisement_id = :advertisementId", [
            'advertisementId' => $advertisementId
        ])->find()['package'];

        $packageAmounts = AppConstants::ADVERTISEMENT_PACKAGES;
        return $packageAmounts[$package] ?? 0;
    }

    public function createOnetimeCourseOrderId(string $courseId)
    {
        return 'cid_' . $courseId . '_' . time() . '_' . $_SESSION['user'];
    }

    public function createSubPeriodOrderId(string $courseId, string $subperiodId)
    {
        return 'cid_' . $courseId . '_spid_' . $subperiodId . '_' . time() . '_' . $_SESSION['user'];
    }


    public function createAdvertisementOrderId(string $advertisementId)
    {
        return 'ad_' . $advertisementId . '_' . time() . '_' . $_SESSION['user'];
    }

    public function createCoursePaymentEntry(string $orderId, string $courseId, ?string $subperiodId, string $userId, float $amount)
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
                    'subperiodId' => $subperiodId, // null if one-time course
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

    public function createAdvertisementPaymentEntry(string $orderId, string $advertisementId, string $userId, float $amount)
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
                "INSERT INTO advertisement_payments (advertisement_id, user_id, payment_id) 
            VALUES (:advertisementId, :userId, :paymentId)",
                [
                    'advertisementId' => $advertisementId,
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
        try {
            $this->processPendingRecurringCourseSubPeriodPayments($userId, $courseId, $subPeriodId);
        } catch (\Exception $e) {
            $logFile = AppConstants::LOG_FOLDER . 'payment_verification_error.log';
            file_put_contents(
                $logFile,
                "Error occurred during payment verification:\n" . $e->getMessage() .
                    PHP_EOL . $e->getTraceAsString() .
                    PHP_EOL . str_repeat("-", 50) . PHP_EOL,
                FILE_APPEND
            );
        }

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

    public function isOneTimeCoursePaid($userId, $courseId)
    {
        try {
            $this->processPendingOneTimeCoursePayments($userId, $courseId);
        } catch (\Exception $e) {
            $logFile = AppConstants::LOG_FOLDER . 'payment_verification_error.log';
            file_put_contents(
                $logFile,
                "Error occurred during payment verification:\n" . $e->getMessage() .
                    PHP_EOL . $e->getTraceAsString() .
                    PHP_EOL . str_repeat("-", 50) . PHP_EOL,
                FILE_APPEND
            );
        }
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
            $this->processPendingPayments($pendingPayments);
        }
    }

    private function processPendingOneTimeCoursePayments($userId, $courseId)
    {
        $pendingPayments = $this->db->query(
            "SELECT p.order_id FROM payments p INNER JOIN course_payments cp ON p.payment_id = cp.payment_id
            WHERE cp.user_id = :user_id AND cp.course_id = :course_id AND cp.sub_period_id IS NULL AND p.payment_status = " .
                AppConstants::PAYMENT_STATUS_PENDING,
            [
                "user_id" => $userId,
                "course_id" => $courseId
            ]
        )->findAll();

        if ($pendingPayments) {
            $this->processPendingPayments($pendingPayments);
        }
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

    public function getViewDetailsForCourseSubPeriodCheckout(string $courseId, string $subperiodId)
    {
        $course = $this->db->query(
            "SELECT * FROM courses WHERE course_id = :course_id",
            [
                "course_id" => $courseId
            ]
        )->find();

        $subPeriod = $this->db->query(
            "SELECT * FROM recurring_course_sub_periods WHERE sub_period_id = :sub_period_id AND course_id = :course_id",
            [
                "course_id" => $courseId,
                "sub_period_id" => $subperiodId
            ]
        )->find();

        return [
            "course_title" => $course['title'],
            "start_date" => $subPeriod['start_datetime'],
            "end_date" => $subPeriod['end_datetime'],
        ];
    }

    public function getViewDetailsForCourseCheckout(string $courseId)
    {
        $course = $this->db->query(
            "SELECT * FROM courses WHERE course_id = :course_id",
            [
                "course_id" => $courseId
            ]
        )->find();

        return [
            "course_title" => $course['title'],
        ];
    }

    public function getViewDetailsForAdvertisementCheckout(string $advertisementId)
    {
        $ad = $this->db->query(
            "SELECT * FROM advertisement WHERE advertisement_id = :advertisement_id",
            [
                "advertisement_id" => $advertisementId
            ]
        )->find();
        $course_title = $this->db->query(
            "SELECT title FROM courses WHERE course_id = :course_id",
            [
                "course_id" => $ad['course_id']
            ]
        )->find()['title'];

        return [
            "package" => $ad['package'],
            "course_title" => $course_title,
        ];
    }

    public function getTeacherCourseIncome(int $id)
    {
        try {
            return $this->db->query(
                "SELECT SUM(p.amount) AS revenue
                FROM payments p
                JOIN course_payments cp ON p.payment_id = cp.payment_id
                JOIN courses c ON c.course_id = cp.course_id
                WHERE c.tutor_id = :id",
                [
                    'id' => $id
                ]
            )->find();
        } catch (Exception $e) {
            error_log("Fail to fetch the teacher course income: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }
    public function getWithdrawedAmount(int $id)
    {
        try {
            return $this->db->query(
                "SELECT SUM(amount) AS total_amount
                FROM teacher_withdrawal
                WHERE teacher_id = :id",
                [
                    'id' => $id
                ]
            )->find();
        } catch (Exception $e) {
            error_log("Fail to fetch the teacher course income: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    public function getTotalCourseIncome()
    {
        try {
            return $this->db->query(
                "SELECT SUM(p.amount) AS revenue
                FROM payments p
                JOIN course_payments cp ON p.payment_id = cp.payment_id"
            )->findAll();
        } catch (Exception $e) {
            error_log("Fail to fetch total course income: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    public function getTeacherCoursesPaymentHistory(string $teacherId)
    {
        try {
            return $this->db->query(
                "SELECT 
                p.*,
                c.title
                FROM payments p
                JOIN course_payments cp ON cp.payment_id = p.payment_id
                JOIN courses c ON c.course_id = cp.course_id
                WHERE c.tutor_id = :id",
                [
                    'id' => $teacherId
                ]
            )->findAll();
        } catch (Exception $e) {
            error_log("Failed to fetch teacher payment hisoty: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    public function getStudentPaymentHistory(int $id)
    {
        try {
            return $this->db->query(
                "SELECT 
                p.*,
                c.title
                FROM payments p
                JOIN course_payments cp ON cp.payment_id = p.payment_id
                JOIN courses c ON c.course_id = cp.course_id
                WHERE cp.user_id = :id",
                [
                    'id' => $id
                ]
            )->findAll();
        } catch (Exception $e) {
            error_log("Failed to fetch student payment hisoty: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }
    public function getPaymentHistory(int $length = 9, int $offset = 0)
    {
        try {
            $searchTerm = trim($_GET['s'] ?? '');
            $status = $_GET['status'] ?? 'all';
            $date = (isset($_GET['date']) && $_GET['date'] !== '') ? $_GET['date'] : 'all';

            $whereConditions = [];
            $params = [];

            // Search condition
            if (!empty($searchTerm)) {
                $whereConditions[] = "(c.title LIKE :search OR p.payment_id LIKE :search)";
                $params['search'] = "%{$searchTerm}%";
            }

            // Status condition
            if ($status !== 'all') {
                $whereConditions[] = "p.payment_status = :status";
                $params['status'] = $status;
            }

            // Date condition
            if ($date !== 'all') {
                $whereConditions[] = "DATE(p.created_date) = :date";
                $params['date'] = $date;
            }

            $whereClause = !empty($whereConditions) ? "AND " . implode(" AND ", $whereConditions) : "";
            if (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'teacher') {
                $params['id'] = $_SESSION['user'];

                $paymentDetails = $this->db->query(
                    "SELECT 
                    p.*,
                    c.title
                    FROM payments p
                    JOIN course_payments cp ON cp.payment_id = p.payment_id
                    JOIN courses c ON c.course_id = cp.course_id
                    WHERE c.tutor_id = :id
                    {$whereClause}
                    LIMIT {$length} OFFSET {$offset}",
                    $params
                )->findAll();

                $count = $this->db->query(
                    "SELECT 
                    COUNT(p.payment_id)
                    FROM payments p
                    JOIN course_payments cp ON cp.payment_id = p.payment_id
                    JOIN courses c ON c.course_id = cp.course_id
                    WHERE c.tutor_id = :id
                    {$whereClause}",
                    $params
                )->count();
            } elseif (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'student') {
                $params['id'] = $_SESSION['user'];
                $paymentDetails = $this->db->query(
                    "SELECT 
                    p.*,
                    c.title
                    FROM payments p
                    JOIN course_payments cp ON cp.payment_id = p.payment_id
                    JOIN courses c ON c.course_id = cp.course_id
                    WHERE cp.user_id = :id
                    {$whereClause}
                    LIMIT {$length} OFFSET {$offset}",
                    $params
                )->findAll();
                $count = $this->db->query(
                    "SELECT 
                    COUNT(p.payment_id)
                    FROM payments p
                    JOIN course_payments cp ON cp.payment_id = p.payment_id
                    JOIN courses c ON c.course_id = cp.course_id
                    WHERE cp.user_id = :id
                    {$whereClause}",
                    $params
                )->count();
            } elseif (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'admin') {

                $paymentDetails = $this->db->query(
                    "SELECT 
                    p.*,
                    c.title
                    FROM payments p
                    JOIN course_payments cp ON cp.payment_id = p.payment_id
                    JOIN courses c ON c.course_id = cp.course_id
                    WHERE 1 = 1
                    {$whereClause}
                    LIMIT {$length} OFFSET {$offset}",
                    $params
                )->findAll();
                $count = $this->db->query(
                    "SELECT 
                    COUNT(p.payment_id)
                    FROM payments p
                    JOIN course_payments cp ON cp.payment_id = p.payment_id
                    JOIN courses c ON c.course_id = cp.course_id
                    {$whereClause}",
                    $params
                )->count();
            }

            return [$paymentDetails, $count];
        } catch (Exception $e) {
            error_log("Failed to fetch payment hisoty: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }
    public function getWithdrawalHistory(int $length = 9, int $offset = 0)
    {
        try {
            $searchTerm = trim($_GET['s'] ?? '');
            $status = $_GET['status'] ?? 'all';
            $date = (isset($_GET['date']) && $_GET['date'] !== '') ? $_GET['date'] : 'all';

            $whereConditions = [];
            $params = [];

            // Search condition
            if (!empty($searchTerm)) {
                $whereConditions[] = "u.first_name LIKE :term OR u.last_name LIKE :term OR CONCAT(u.first_name, ' ', u.last_name) LIKE :term";
                $params['search'] = "%{$searchTerm}%";
            }

            // Status condition
            if ($status !== 'all') {
                $whereConditions[] = "tw.status = :status";
                $params['status'] = $status;
            }

            // Date condition
            if ($date !== 'all') {
                $whereConditions[] = "DATE(tw.date_requested) = :date";
                $params['date'] = $date;
            }

            $whereClause = !empty($whereConditions) ? "AND " . implode(" AND ", $whereConditions) : "";
            if (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'teacher') {
                $detailsQuery = "
                SELECT 
                tw.*,
                CONCAT(u.first_name, ' ', u.last_name) AS username
                FROM teacher_withdrawal tw
                JOIN users u ON u.user_id = tw.teacher_id
                WHERE tw.teacher_id = :user_id
                {$whereClause}
                LIMIT {$length} OFFSET {$offset}";

                $countQuery = "
                SELECT 
                COUNT(tw.withdrawal_id)
                FROM teacher_withdrawal tw
                JOIN users u ON u.user_id = tw.teacher_id
                WHERE tw.teacher_id = :user_id
                {$whereClause}";

                $params['user_id'] = $_SESSION['user'];
            } elseif (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'admin') {
                $detailsQuery = "
                SELECT 
                tw.*,
                CONCAT(u.first_name, ' ', u.last_name) AS username
                FROM teacher_withdrawal tw
                JOIN users u ON u.user_id = tw.teacher_id
                WHERE 1 = 1
                {$whereClause}
                LIMIT {$length} OFFSET {$offset}";

                $countQuery = "
                SELECT 
                COUNT(tw.withdrawal_id)
                FROM teacher_withdrawal tw
                JOIN users u ON u.user_id = tw.teacher_id
                WHERE 1 = 1
                {$whereClause}";
            }
            $withdrawalHistory = $this->db->query($detailsQuery, $params)->findAll();
            $count = $this->db->query($countQuery, $params)->count();

            return [$withdrawalHistory, $count];
        } catch (Exception $e) {
            error_log("Failed to fetch payment hisoty: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    public function requestWithdrawal(array $formData)
    {
        try {
            $this->db->query(
                "INSERT INTO teacher_withdrawal
                (teacher_id,
                amount,
                bank_details)
                VALUES(
                :id,
                :amount,
                :bank_details
                )",
                [
                    "amount" => $formData['amount'],
                    'bank_details' => $formData['bank_details'],
                    "id" => $_SESSION['user']
                ]
            );
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function completeWithdraw(string $id, string $userId)
    {
        try {
            $this->db->query(
                "UPDATE teacher_withdrawal
                SET status = 'completed'
                WHERE withdrawal_id = :id
                AND teacher_id = :user_id",
                [
                    "id" => $id,
                    "user_id" => $userId
                ]
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function cancelWithdrawal(string $id, string $userId)
    {
        try {
            $this->db->query(
                "UPDATE teacher_withdrawal
                SET status = 'canceled'
                WHERE withdrawal_id = :id
                AND teacher_id = :user_id",
                [
                    "id" => $id,
                    "user_id" => $userId
                ]
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
}
