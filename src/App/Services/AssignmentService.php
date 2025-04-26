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

    public function getAssignmentByCourse(string $course_id)
    {
        return $this->db->query(
            "SELECT * from assignments WHERE course_id = :id",
            [
                "id" => $course_id
            ]
        )->findAll();
    }

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
            return $assignmentId;
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

    public function getAssignmentResource(int $id)
    {
        return $this->db->query(
            "SELECT * FROM assignment_resource WHERE assignment_id = :id",
            ["id" => $id]
        )->findAll();
    }
    public function getResourceById(string $id)
    {
        return $this->db->query(
            "SELECT * FROM assignment_resource WHERE resource_id = :id",
            ["id" => $id]
        )->find();
    }

    public function uploadFile(array $file, string $dir)
    {
        $storageDir = Paths::STORAGE_UPLOADS . "/" . $dir;
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $baseName = pathinfo($file['name'], PATHINFO_FILENAME);
        // $fileName = uniqid("", true) . "." . $extention;

        $fileName = $file['name'];
        $storagePath = $storageDir . "/" . $fileName;

        // Ensure directory exists
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0777, true);
        }

        $counter = 1;
        while (file_exists($storagePath)) {
            $fileName = $baseName . "_" . $counter . "." . $extension;
            $storagePath = $storageDir . "/" . $fileName;
            $counter++;
        }
        if (!move_uploaded_file($file['tmp_name'], $storagePath)) {
            throw new ValidationException([
                "file" => ['Failed to upload.']
            ]);
        }

        return $fileName;
    }

    public function readResource(array $resource)
    {
        $filePath = Paths::STORAGE_UPLOADS . '/assignments/' . $resource['resource_path'];
        if (!file_exists($filePath)) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }
        header("Content-Disposition: attachment;filename={$resource['resource_path']}");
        readfile($filePath);
    }

    public function update(array $formData, string $courseId, string $assignmentId, array $files)
    {
        $this->db->beginTransaction();
        try {
            $this->db->query(
                "UPDATE assignments
                SET deadline = :deadline, instruction = :instruction, title = :title
                WHERE assignment_id = :assignment_id",
                [
                    'assignment_id' => $assignmentId,
                    'deadline' => $formData['deadline'],
                    'instruction' => $formData['instruction'],
                    'title' => $formData['title']
                ]
            );

            if (!empty($formData['deleted_files'])) {
                $deletedFiles = explode(",", $formData['deleted_files']);
                foreach ($deletedFiles as $resourceId) {
                    $file = $this->db->query(
                        "SELECT resource_path FROM assignment_resource WHERE resource_id = :id",
                        ['id' => $resourceId]
                    )->find();

                    if ($file) {
                        $filePath = Paths::STORAGE_UPLOADS . '/assignments/' . $file['resource_path'];
                        if (file_exists($filePath)) {
                            unlink($filePath); // Delete the file from server
                        }

                        $this->db->query(
                            "DELETE FROM assignment_resource WHERE resource_id = :id",
                            ['id' => $resourceId]
                        );
                    }
                }
            }

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

    public function submitAssignment(string $courseId, string $assignmentId, array $files)
    {
        $this->db->beginTransaction();
        try {
            $submission = $this->db->query(
                "SELECT * FROM assignment_submission
                WHERE assignment_id = :assignmentId
                AND course_id = :courseId
                AND student_id = :student_id",
                [
                    "assignmentId" => $assignmentId,
                    "courseId" => $courseId,
                    "student_id" => $_SESSION['user']
                ]
            )->find();
            // dd($$submission);

            if (empty($submission)) {
                $this->db->query(
                    "INSERT INTO assignment_submission(assignment_id, course_id, student_id)
                    VALUES(:assignment_id, :course_id, :student_id)",
                    [
                        'assignment_id' => $assignmentId,
                        'course_id' => $courseId,
                        'student_id' => $_SESSION['user']
                    ]
                );

                $submissionId = $this->db->lastInsertId();
            } else {
                $submissionId = $submission['submission_id'];
            }

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
                        $newFileName = $this->uploadFile($file, 'assignments_submission');
                        $this->db->query(
                            "INSERT INTO assignment_submission_attachment(submission_id, attachment_path)
                                VALUES(:submission_id, :attachment_path)",
                            [
                                "submission_id" => $submissionId,
                                "attachment_path" => $newFileName
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

    public function getSubmission($courseId, $assignmentId)
    {
        return $this->db->query(
            "SELECT a.submission_id AS id,
            CONCAT(u.first_name, ' ', u.last_name) AS studentName,
            a.status,
            a.grade,
            a.upload_date,
            a.feedback,
            JSON_ARRAYAGG(
                JSON_OBJECT(
                    'attachment_id', ast.attachment_id,
                    'name', ast.attachment_path
                    )
            ) AS attachments
            FROM assignment_submission a
            JOIN assignment_submission_attachment ast ON a.submission_id = ast.submission_id
            JOIN users u ON a.student_id = u.user_id
            WHERE a.course_id = :courseId AND a.assignment_id = :assignmentId
            GROUP BY a.submission_id",
            [
                "courseId" => $courseId,
                "assignmentId" => $assignmentId
            ]
        )->findAll();
    }

    public function getSubmissionById(string $submissionId)
    {
        return $this->db->query(
            "SELECT * FROM assignment_submission WHERE submission_id = :submission_id",
            [
                "submission_id" => $submissionId
            ]
        );
    }
    public function getUserSubmission()
    {
        return $this->db->query(
            "SELECT a.submission_id ,
            a.status,
            a.grade,
            a.upload_date,
            a.feedback,
            a.upload_date,
            JSON_ARRAYAGG(
                JSON_OBJECT(
                    'attachment_id', ast.attachment_id,
                    'name', ast.attachment_path
                    )
            ) AS attachments
            FROM assignment_submission a
            JOIN assignment_submission_attachment ast ON a.submission_id = ast.submission_id
            WHERE a.student_id = :id
            GROUP BY a.submission_id",
            [
                "id" => $_SESSION['user']
            ]
        )->find();
    }

    public function getSubmissionAttachment(string $id)
    {
        return $this->db->query(
            "SELECT * FROM assignment_submission_attachment WHERE attachment_id = :id",
            ["id" => $id]
        )->find();
    }

    public function readAttachment(array $attachment)
    {
        $filePath = Paths::STORAGE_UPLOADS . '/assignments_submission/' . $attachment['attachment_path'];
        if (!file_exists($filePath)) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }
        header("Content-Disposition: attachment;filename={$attachment['attachment_path']}");
        readfile($filePath);
    }

    public function submissionReview(string $id, string $feedback, int $grade)
    {
        return $this->db->query(
            "UPDATE assignment_submission
            SET
            feedback = :feedback,
            grade = :grade,
            status = :status
            WHERE submission_id = :id",
            [
                "feedback" => $feedback,
                "grade" => $grade,
                "id" => $id,
                "status" => "graded"
            ]
        );
    }

    public function removeSubmissionFile(string $submissionId, string $attachmentId)
    {
        $attachment = $this->db->query(
            "SELECT 
            attachment_id,
            attachment_path 
            FROM assignment_submission_attachment
            WHERE submission_id = :submissionId 
            AND attachment_id = :attachmentId",
            [
                "submissionId" => $submissionId,
                "attachmentId" => $attachmentId
            ]
        )->find();
        if (!empty($attachment)) {
            $filePath = Paths::STORAGE_UPLOADS . '/assignments_submission/' . $attachment['attachment_path'];
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file from server
            }
            $this->db->query(
                "DELETE FROM assignment_submission_attachment 
                WHERE attachment_id = :attachmentId",
                [
                    "attachmentId" => $attachment['attachment_id']
                ]
            );
        }
    }

    public function getStudentAssignmentSubmissionsByCourse(string $userId, string $courseId)
    {
        // TODO: REPLACE WITH THIS
        /*
        $this->db->query(
            "SELECT
            an.*,
            a.title
            FROM assignment_submission an
            JOIN assignments a ON an.assignment_id = a.assignment_id
            WHERE an.student_id = :student_id
            AND an.course_id = :course_id
            AND a.tutor_id = :tutor_id",
            [
                "student_id" => $userId,
                "course_id" => $courseId,
                "tutor_id" => $_SESSION['user']
            ]
                */
        try {
            return $this->db->query(
                "SELECT
                an.*,
                a.title,
                a.deadline
                FROM assignment_submission an
                JOIN assignments a ON an.assignment_id = a.assignment_id
                WHERE an.student_id = :student_id
                AND an.course_id = :course_id",
                [
                    "student_id" => $userId,
                    "course_id" => $courseId,
                ]
            )->findAll();
        } catch (Exception $e) {
            return $e;
        }
    }
}
