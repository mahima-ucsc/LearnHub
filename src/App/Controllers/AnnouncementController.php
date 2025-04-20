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
        $student_id = $_SESSION['user'];
        $announcements = $this->AnnouncementService->getAnnouncements($courseId, $student_id);
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

    public function markAsButtonToggle()
    {
        if (!isset($_POST['announcement_id'], $_POST['is_read'], $_SESSION['user'])) {
            http_response_code(400);
            echo "Missing Required data";
            return;
        }

        $is_read = $_POST['is_read'] === 'true' ? 1 : 0;
        $announcementId = $_POST['announcement_id'];
        $userId = $_SESSION['user'];

        $this->AnnouncementService->toggleMarkAsBtn($announcementId, $userId, $is_read);

        echo $is_read ? "Marked as read" : "Marked as Unread";
    }

    public function markAsRead()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $announcementId = $data['announcement_id'] ?? null;
        // $announcementId = $_POST['announcement_id'];
        $studentId = $_SESSION['user'];
        // dd([$announcementId, $studentId]);

        if ($announcementId) {
            $this->AnnouncementService->markAsRead($announcementId, $studentId);
            echo json_encode(['status' => 'success', 'message' => 'Announcement marked as read']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid announcement ID']);
        }
    }

    public function markAsUnread()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $announcementId = $data['announcement_id'] ?? null;
        $studentId = $_SESSION['user'];

        if ($announcementId) {
            $this->AnnouncementService->markAsUnread($announcementId, $studentId);
            echo json_encode(['status' => 'success', 'message' => 'Announcement marked as unread']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid announcement ID']);
        }
    }
}
