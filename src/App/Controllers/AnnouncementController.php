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

    public function announcementsFormView()
    {
        echo $this->view->render(
            "User/Tutor/create_announcement.php",
            [
                'title' => 'create announcement',
            ]
        );
    }

    public function createAnnouncements()
    {
        $this->AnnouncementService->createAnnouncements($_POST, $_FILES);
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
}
