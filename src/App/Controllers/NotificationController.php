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
        $this->notificationService->markAllAsRead((string)$_SESSION['user']);
        $this->view->renderJson(['status' => 'success']);
    }
}
