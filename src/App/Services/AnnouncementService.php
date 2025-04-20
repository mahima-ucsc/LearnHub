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

        // Insert announcement data into the database
        $this->db->beginTransaction();
        try {
            $this->db->query(
                "INSERT INTO announcements (course_id, title, content, category, visibility, specific_emails, attachments, send_email)
                VALUES (:course_id, :title, :content, :category, :visibility, :specific_emails, :attachments, :send_email)",
                [
                    'course_id' => $formData['course_id'],
                    'title' => $formData['title'],
                    'content' => $formData['content'],
                    'category' => $formData['category'],
                    'visibility' => $formData['visibility'],
                    'specific_emails' => $formData['specific_emails'] ?? NULL,
                    'attachments' => !empty($attachments) ? json_encode($attachments) :  NULL,
                    'send_email' => $formData['send_email'],
                ]
            );

            $announcementId = $this->db->lastInsertId();

            $this->db->query(
                "INSERT INTO announcements_read (user_id, announcement_id, is_read) 
                SELECT sc.student_id, :announcement_id, 0 
                FROM students_courses sc 
                WHERE sc.course_id = :course_id",
                [
                    'announcement_id' => $announcementId,
                    'course_id' => $formData['course_id']
                ]
            );

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
        }
    }

    public function getAnnouncements($courseId, $studentId)
    {
        // dd([$courseId, $student_id]);
        return $this->db->query(
            "SELECT 
                a.*,
                c.title AS course_title, 
                CONCAT(u.first_name, ' ', u.last_name) AS tutor_name,
                ar.is_read
            FROM announcements a
            JOIN students_courses sc ON sc.course_id = a.course_id
            JOIN announcements_read ar ON ar.user_id = sc.student_id AND ar.announcement_id = a.announcement_id
            JOIN courses c ON a.course_id = c.course_id
            JOIN users u ON c.tutor_id = u.user_id
            WHERE a.course_id = :course_id AND sc.student_id = :student_id
            ORDER BY a.created_at DESC",
            [
                'course_id' => $courseId,
                'student_id' => $studentId,
            ]
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

    public function toggleMarkAsBtn($announcementId, $studentId, $is_read)
    {
        echo ($announcementId . $studentId . $is_read);
        $this->db->query(
            "UPDATE announcements_read SET is_read = :is_read WHERE announcement_id = :announcement_id AND user_id = :student_id",
            [
                'announcement_id' => $announcementId,
                'student_id' => $studentId,
                'is_read' => $is_read,
            ]
        );
    }

    public function markAsRead($announcementId, $studentId)
    {
        // dd([$announcementId, $studentId]);
        $this->db->query(
            "UPDATE announcements_read SET is_read = 1 WHERE announcement_id = :announcement_id AND user_id = :student_id",
            [
                'announcement_id' => $announcementId,
                'student_id' => $studentId,
            ]
        );
    }

    public function markAsUnread($announcementId, $studentId)
    {
        $this->db->query(
            "UPDATE announcements_read SET is_read = 0 WHERE announcement_id = :announcement_id AND user_id = :student_id",
            [
                'announcement_id' => $announcementId,
                'student_id' => $studentId,
            ]
        );
    }
}
