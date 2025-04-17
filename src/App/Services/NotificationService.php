<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class NotificationService
{
    public function __construct(private Database $db) {}

    public function getNotificationsForLoggedInUser()
    {
        return $this->db->query(
            "SELECT message, url, updated_at, is_read FROM notifications n INNER JOIN notification_users n_u ON n.notification_id = n_u.notification_id
            WHERE n_u.user_id = :user_id
            ORDER BY n.updated_at DESC",
            [
                'user_id' => $_SESSION['user']
            ]
        )->findAll();
    }

    public function markAllAsRead(string $userId)
    {
        $this->db->query(
            "UPDATE notification_users SET is_read = 1 WHERE user_id = :user_id",
            [
                'user_id' => $userId
            ]
        );
    }
}
