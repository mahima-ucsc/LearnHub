<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\NotificationService;
use Framework\TemplateEngine;

class NotificationController
{
    public function __construct(
        private TemplateEngine $view,
        private NotificationService $notificationService
    ) {}

    public function getUserNotifications()
    {
        $notifications = $this->notificationService->getNotificationsForLoggedInUser();
        $this->view->renderJson($notifications);
    }

    public function markAllAsRead()
    {
        $this->notificationService->markAllAsRead((string) $_SESSION['user']);
        $this->view->renderJson(['status' => 'success']);
    }

    public function markAsRead(array $params)
    {
        $notificationId = $params['notification_id'] ?? null;
        if (empty($notificationId)) {
            $this->view->renderJson(['status' => 'error', 'message' => 'Notification ID is required.'], 400);
            return;
        }
        // Mark the notification as read

        $this->notificationService->markAsRead((string) $_SESSION['user'], (string) $notificationId);
        $this->view->renderJson(['status' => 'success']);
    }

    public function notificationView(array $params)
    {
        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 6;
        $offset = ($page - 1) * $itemsPerPage;
        $isread = isset($_GET['isread']) ? $_GET['isread'] : '';
        $searchTerm = $_GET['s'] ?? '';

        // Get search parameters
        $searchParams = [
            's' => $searchTerm,
            'isread' => $isread,
        ];

        [$notifications, $notificationCount] = $this->notificationService->getNotificationsForView(
            $itemsPerPage,
            $offset,
            $searchTerm,
            $isread
        );

        $pagination = generatePagination($notificationCount, $page, $itemsPerPage, $searchParams);

        echo $this->view->render('/notification/notifications.php', [
            "title" => "Notifications",
            "notifications" => $notifications,
            "pagination" => $pagination,
            'isread' => $isread,
        ]);
    }
}
