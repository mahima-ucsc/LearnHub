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
}
