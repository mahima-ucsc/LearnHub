<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{AnnouncementService, CourseService, ValidatorService};

class AnnouncementController
{
    public function __construct(
        private TemplateEngine $view,
        private AnnouncementService $AnnouncementService,
        private CourseService $CourseService,
        private ValidatorService $ValidatorService
    ) {}

    public function announcementsFormView($params)
    {
        echo $this->view->render(
            "User/Tutor/create_announcement.php",
            [
                'title' => 'create announcement',
                'course_id' => $params['course_id']
            ]
        );
    }

    public function createAnnouncements($params)
    {

        $_POST['course_id'] = $params['course_id'];
        $this->ValidatorService->validateAnnouncemnetForm($_POST);
        $this->AnnouncementService->createAnnouncements($_POST, $_FILES);
        redirectTo("/courses/{$params['course_id']}/announcements");
    }

    public function announcementsListView($params)
    {
        $courseId = $params['course_id'];
        $user_id = $_SESSION['user'];
        $isparticipants = $this->AnnouncementService->getCourseisParticipants($courseId, $user_id);
        $courseData = $this->AnnouncementService->getcourseTitle($courseId);

        if ($user_id === $courseData['tutor_id'] || $_SESSION['user_role'] === 'admin') {
            $announcements = $this->AnnouncementService->getAllAnnouncements($courseId);
        } else {
            $announcements = $this->AnnouncementService->getAnnouncements($courseId, $user_id);
        }

        if ($isparticipants || $_SESSION['user_role'] === 'admin') {
            echo $this->view->render(
                "course/course-info/announcements.php",
                [
                    'title' => 'Announcements',
                    'announcements' => $announcements,
                    'course_title' => $courseData['title'],
                    'course_id' => $courseId,
                    'tutor_id' => $courseData['tutor_id']
                ]
            );
        } else {
            redirectTo('/dashboard');
        }
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

    public function downloadAttachment($params)
    {
        // dd($params);
        $file = $_POST['file_name'] ?? null;
        $Dir = __DIR__ . '/../../../public/assets/uploads/announcement/';
        if ($file) {
            // prevents directory traversal
            $safeFileName = basename($file);
            $filePath = $Dir . $safeFileName;

            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $safeFileName . '"');
                header('Content-Length: ' . filesize($filePath));

                // Clean output buffer and flush system output buffer
                ob_clean();
                flush();
                readfile($filePath);
                exit;
            } else {
                http_response_code(404);
                echo "File not found!";
            }
        } else {
            http_response_code(400);
            echo "No file name specified.";
        }
    }

    public function deleteAnnouncement($params)
    {
        $this->AnnouncementService->deleteAnnouncementById($params['announcement_id']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function editAnnouncementView($params)
    {
        $announcement = $this->AnnouncementService->getAnnouncementById($params['announcement_id']);
        echo $this->view->render(
            "User/Tutor/edit_announcement.php",
            [
                'title' => 'Edit announcement',
                'announcement_id' => $params['announcement_id'],
                'announcement' => $announcement
            ]
        );
    }

    public function editAnnouncement()
    {
        dd($_POST);
    }
}
