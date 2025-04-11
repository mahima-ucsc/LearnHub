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

        // upload files
        if (isset($_FILES['attachments'])) {
            $fileName = $_FILES['attachments']['name'];
            $fileTmp = $_FILES['attachments']['tmp_name'];

            $destination = __DIR__ . '/../../../public/assets/uploads/announcement/'  . basename($fileName);
            echo ($destination);

            if (move_uploaded_file($fileTmp, $destination)) {
                dd("File uploaded successfully!");
            } else {
                dd("Upload failed!");
            }
        }
        dd($_POST);
    }
}
