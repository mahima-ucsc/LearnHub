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
            "SELECT n.notification_id as notification_id, message, url, updated_at, is_read FROM notifications n INNER JOIN notification_users n_u ON n.notification_id = n_u.notification_id
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

    public function markAsRead(string $userId, string $notificationId)
    {
        $this->db->query(
            "UPDATE notification_users SET is_read = 1 WHERE user_id = :user_id AND notification_id = :notification_id",
            [
                'user_id' => $userId,
                'notification_id' => $notificationId
            ]
        );
    }

    // TODO: Test this function.
    public function createNotification(string $message, string $url, array $userIds): void
    {
        // Insert the notification into the notifications table
        $this->db->query(
            "INSERT INTO notifications (message, url) VALUES (:message, :url)",
            [
                'message' => $message,
                'url' => $url
            ]
        );

        $notificationId = $this->db->lastInsertId();

        // Insert into the notification_users table for each user ID
        foreach ($userIds as $userId) {
            $this->db->query(
                "INSERT INTO notification_users (user_id, notification_id, is_read) VALUES (:user_id, :notification_id, :is_read)",
                [
                    'user_id' => $userId,
                    'notification_id' => $notificationId,
                    'is_read' => 0
                ]
            );
        }
    }

    public function getNotificationsForView(
        int $itemsPerPage,
        int $offset,
        string $searchTerm,
        string $isread
    ): array {
        $params = [];
        $query = "SELECT n.notification_id as notification_id, message, url, updated_at, is_read 
        FROM notifications n INNER JOIN notification_users n_u ON n.notification_id = n_u.notification_id
            WHERE n_u.user_id = :user_id";
        $params['user_id'] = $_SESSION['user'];

        $query .= " AND message LIKE :searchTerm";
        $params['searchTerm'] = "%{$searchTerm}%";

        if (isset($isread)) {
            $query .= " AND is_read = :is_read";
            $params['is_read'] = $isread;
        }

        $notificationCount = $this->db->query($query, $params)->rowCount();

        $query .= " ORDER BY n.updated_at DESC LIMIT {$itemsPerPage} OFFSET {$offset}";

        $notifications =  $this->db->query($query, $params)->findAll();

        return ([$notifications, $notificationCount]);
    }
}
