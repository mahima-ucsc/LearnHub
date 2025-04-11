<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class AnnouncementController
{
    public function __construct(
        private TemplateEngine $view
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
        dd($_POST);
    }
}
