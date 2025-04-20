<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Framework\Database;
use App\Config\Paths;
use Framework\Exceptions\ValidationException;

class AnnouncementService
{
    public function __construct(private Database $db) {}

    public function createAnnouncements(array $formData, array $fileData)
    {
        $attachments = [];

        if ($fileData && !empty($fileData['attachments']['name'][0])) {
            try {
                // Handle file uploads
                $uploadDir = __DIR__ . '/../../../public/assets/uploads/announcement/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                if (isset($fileData['attachments']) && is_array($fileData['attachments']['name'])) {
                    foreach ($fileData['attachments']['name'] as $key => $fileName) {
                        $fileTmp = $fileData['attachments']['tmp_name'][$key];

                        // Generate a unique file name to avoid overwriting
                        $uniqueFileName = uniqid() . '_' . basename($fileName);
                        $destination = $uploadDir . $uniqueFileName;

                        if (move_uploaded_file($fileTmp, $destination)) {
                            $attachments[] = $uniqueFileName;
                        } else {
                            throw new Exception("File upload failed for file: " . $fileName);
                        }
                    }
                }
            } catch (Exception $e) {
                throw new ValidationException(["File upload error: " . $e->getMessage()]);
            }
        }
        // dd($formData);

        // Insert data into the database
        $this->db->query(
            "INSERT INTO announcements (course_id, title, content, category, visibility)
            VALUES (1, 'demo title two ', 'demo content', 'assignment', 'all')",
            []
        );
    }

    public function getAnnouncements($courseId)
    {
        return $this->db->query(
            "SELECT announcements.*, courses.title AS course_title, CONCAT(users.first_name, ' ', users.last_name) AS tutor_name 
            FROM announcements
            INNER JOIN courses ON announcements.course_id = courses.course_id
            INNER JOIN users ON courses.tutor_id = users.user_id
            WHERE announcements.course_id = :courseId
            ORDER BY announcements.created_at DESC",
            ['courseId' => $courseId]
        )->findAll();
    }

    public function getReadAnnouncements($courseId)
    {
        return $this->db->query(
            "SELECT announcements.*, courses.title AS course_title, CONCAT(users.first_name, ' ', users.last_name) AS tutor_name 
            FROM announcements
            INNER JOIN courses ON announcements.course_id = courses.course_id
            INNER JOIN users ON courses.tutor_id = users.user_id
            WHERE announcements.course_id = :courseId AND announcements.read = 1
            ORDER BY announcements.created_at DESC",
            ['courseId' => $courseId]
        )->findAll();
    }


    public function getOneAnnouncements($announcementId)
    {
        return $this->db->query(
            "SELECT announcements.*, courses.title AS course_title, CONCAT(users.first_name, ' ', users.last_name) AS tutor_name 
            FROM announcements
            INNER JOIN courses ON announcements.course_id = courses.course_id
            INNER JOIN users ON courses.tutor_id = users.user_id
            WHERE announcements.id = :announcementId;",
            ['announcementId' => $announcementId]
        )->find();
    }

    public function markAsRead($announcementId)
    {
        $this->db->query(
            "UPDATE announcements SET read_status = 1 WHERE id = :announcementId",
            ['announcementId' => $announcementId]
        );
    }

    public function markAsUnread($announcement)
    {
        $this->db->query(
            "UPDATE announcements SET read_status = 0 WHERE id = :announcementId",
            ['announcementId' => $announcement]
        );
    }
}
