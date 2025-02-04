<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Framework\Database;
use App\Config\Paths;
use Framework\Exceptions\ValidationException;


class AssignmentService
{
    public function __construct(private Database $db) {}

    public function create(array $formData, string $courseId, array $files)
    {
        $this->db->beginTransaction();
        try {
            $this->db->query(
                "INSERT INTO assignments(course_id, deadline, instruction, tutor_id, title)
                VALUES(:course_id, :deadline, :instruction, :tutor_id, :title)",
                [
                    'course_id' => $courseId,
                    'deadline' => $formData['deadline'],
                    'instruction' => $formData['instruction'],
                    'tutor_id' => $_SESSION['user'],
                    'title' => $formData['title']
                ]
            );
            $assignmentId = $this->db->lastInsertId();

            if (!empty($files['files']['name'][0])) {
                foreach ($files['files']['tmp_name'] as $key => $tmpName) {
                    // Build the individual file array
                    $file = [
                        'name'     => $files['files']['name'][$key],
                        'tmp_name' => $files['files']['tmp_name'][$key],
                        'error'    => $files['files']['error'][$key],
                    ];
                    try {
                        // Call uploadFile function for each file
                        $newFileName = $this->uploadFile($file, 'assignments');
                        $this->db->query(
                            "INSERT INTO assignment_resource(assignment_id, course_id, resource_path)
                            VALUES(:assignment_id, :course_id, :resource_path)",
                            [
                                "assignment_id" => $assignmentId,
                                "course_id" => $courseId,
                                "resource_path" => $newFileName
                            ]
                        );
                    } catch (ValidationException $e) {
                        throw new ValidationException([
                            "file" => [$e]
                        ]);
                    }
                }
            }
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    public function getAssignment(string $id)
    {
        return $this->db->query(
            "SELECT * FROM assignments WHERE assignment_id = :id",
            ["id" => $id]
        )->find();
    }

    public function uploadFile(array $file, string $dir)
    {
        $storageDir = Paths::STORAGE_UPLOADS . "/" . $dir;
        $extention = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid("", true) . "." . $extention;
        $storagePath = $storageDir . "/" . $fileName;
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0777, true);
        }
        if (!move_uploaded_file($file['tmp_name'], $storagePath)) {
            throw new ValidationException([
                "file" => ['Failed to upload.']
            ]);
        }

        return $fileName;
    }
}
