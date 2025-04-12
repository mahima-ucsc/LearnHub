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
        try {
            // Handle file uploads
            $uploadDir = __DIR__ . '/../../../public/assets/uploads/announcement/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $attachments = [];
            if (isset($_FILES['attachments']) && is_array($_FILES['attachments']['name'])) {
                foreach ($_FILES['attachments']['name'] as $key => $fileName) {
                    $fileTmp = $_FILES['attachments']['tmp_name'][$key];

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

            // Insert data into the database
            $this->db->query(
                "INSERT INTO announcements (title, content, priority, visibility, specific_emails, attachments, send_email) 
                VALUES (:title, :content, :priority, :visibility, :specific_emails, :attachments, :send_email)",
                [
                    'title' => $formData['title'],
                    'content' => $formData['content'],
                    'priority' => $formData['priority'],
                    'visibility' => $formData['visibility'],
                    'specific_emails' => $formData['visibility'] === 'specific' ? $formData['specific_emails'] : null,
                    'attachments' => !empty($attachments) ? json_encode($attachments) : null,
                    'send_email' => isset($formData['sendEmail']) ? 1 : 0,
                ]
            );

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
            throw $e;
        }
    }
}
