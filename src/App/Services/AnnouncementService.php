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
        $this->db->beginTransaction();
        if ($fileData && !empty($fileData['attachments']['name'][0])) {
            try {
                // Handle file uploads
                $uploadDir = __DIR__ . '/../../../public/assets/uploads/announcement/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $attachments = [];
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
                $this->db->rollback();
                throw new ValidationException(["File upload error: " . $e->getMessage()]);
            }
        }
        // dd($formData);

        // Insert data into the database
        try {
            $this->db->query(
                "INSERT INTO announcements (course_id, title, content, category, visibility, specific_emails, attachments, send_email) 
                VALUES ( :course_id, :title, :content, :category, :visibility, :specific_emails, :attachments, :send_email)",
                [
                    'course_id' => $formData['course_id'],
                    'title' => $formData['title'],
                    'content' => $formData['content'],
                    'category' => $formData['category'],
                    'visibility' => $formData['visibility'],
                    'specific_emails' => $formData['visibility'] === 'specific' ? $formData['specific_emails'] : null,
                    'attachments' => !empty($attachments) ? json_encode($attachments) : null,
                    'send_email' => isset($formData['sendEmail']) ? 1 : 0,
                ]
            );
        } catch (Exception $e) {
            $this->db->rollback();
            throw new ValidationException(["Database error: " . $e->getMessage()]);
        }

        $this->db->commit();
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
