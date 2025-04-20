<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{AnnouncementService};

class AnnouncementController
{
    public function __construct(
        private TemplateEngine $view,
        private AnnouncementService $AnnouncementService
    ) {}

    public function announcementsFormView($params)
    {
        echo $this->view->render(
            "Tutor/create_announcement.php",
            [
                'title' => 'create announcement',
                'course_id' => $params['course_id']
            ]
        );
    }

    public function createAnnouncements($params)
    {
        $_POST['course_id'] = $params['course_id'];
        $this->AnnouncementService->createAnnouncements($_POST, $_FILES);
        redirectTo("/courses/{$params['course_id']}/announcements");
    }

    public function announcementsListView($params)
    {
        $courseId = $params['course_id'];
        $announcements = $this->AnnouncementService->getAnnouncements($courseId);
        // $announcements = $this->AnnouncementService->getOneAnnouncements('1');
        // dd($announcements);
        echo $this->view->render(
            "course/course-info/announcements.php",
            [
                'title' => 'Announcements',
                'announcements' => $announcements,
            ]
        );
    }

    public function markAsRead()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $announcementId = $data['id'] ?? null;

        if ($announcementId) {
            $this->AnnouncementService->markAsRead($announcementId);
            echo json_encode(['status' => 'success', 'message' => 'Announcement marked as read']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid announcement ID']);
        }
    }

    public function markAsUnread()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $announcementId = $data['id'] ?? null;

        if ($announcementId) {
            $this->AnnouncementService->markAsUnread($announcementId);
            echo json_encode(['status' => 'success', 'message' => 'Announcement marked as unread']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid announcement ID']);
        }
    }
}
