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
}
