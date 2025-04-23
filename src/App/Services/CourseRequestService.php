<?php

declare(strict_types=1);

namespace App\Services;

use Error;
use Exception;
use Framework\Database;

class CourseRequestService
{
    public function __construct(private Database $db) {}

    public function create(array $formData)
    {
        $user_id = $_SESSION['user'];
        try {
            $this->db->query(
                "INSERT INTO course_requests(title, description, subject_id, grade_id, user_id, location)
                VALUES (:title, :description, :subject_id, :grade_id, :user_id, :location)",
                [
                    "title" => $formData['title'],
                    "description" => $formData['description'],
                    "subject_id" => $formData['subject'] ? $formData['subject'] : null,
                    "grade_id" => $formData['grade'] ? $formData['grade'] : null,
                    "user_id" => $user_id,
                    "location" => $formData['location']
                ]
            );
        } catch (Exception $e) {
            error_log("Failed to insert data to course request table: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    public function getCourseRequestsforView()
    {
        $query =
            "SELECT 
                cr.title,
                cr.request_id, 
                cr.description,
                cr.status, 
                s.subject_title AS subject, 
                cr.created_date, 
                cr.updated_date, 
                u.user_id as author_id,
                CONCAT(u.first_name, ' ', u.last_name) AS author,
                COUNT(c.comment_id) AS comments_count
            FROM 
                course_requests cr
            LEFT JOIN 
                subjects s ON cr.subject_id = s.subject_id
            JOIN 
                users u ON cr.user_id = u.user_id
            LEFT JOIN 
                course_request_comments c ON cr.request_id = c.request_id
            GROUP BY 
                cr.title, cr.request_id, cr.description, cr.status, s.subject_title, 
                cr.created_date, cr.updated_date, u.first_name, u.last_name;    
            ";

        $requests = $this->db->query($query)->findAll();

        return $requests;
    }

    public function getApprovedCourseRequests(int $length = 6, int $offset = 0)
    {
        $searchTerm = trim($_GET['s'] ?? '');
        $subject = $_GET['subject'] ?? 'all';
        $grade = $_GET['grade'] ?? 'all';
        $sort = $_GET['sort'] ?? 'recent';

        $whereConditions = [];
        $params = [];

        if (!empty($searchTerm)) {
            $whereConditions[] = "(u.first_name LIKE :term OR u.last_name LIKE :term OR cr.title LIKE :term)";
            $params["term"] = "%{$searchTerm}%";
        }

        if ($subject !== 'all') {
            $whereConditions[] = "cr.subject_id = :subject";
            $params["subject"] = $subject;
        }
        if ($grade !== 'all') {
            $whereConditions[] = "cr.grade_id = :grade";
            $params["grade"] = $grade;
        }

        // Sorting
        $orderClause = "";
        switch ($sort) {
            case 'recent':
                $orderClause = "ORDER BY cr.created_date DESC";
                break;
            case 'oldest':
                $orderClause = "ORDER BY cr.created_date ASC";
                break;
            case 'popular':
                $orderClause = "ORDER BY comments_count DESC";
                break;
        }

        $whereClause = !empty($whereConditions) ? "AND " . implode(" AND ", $whereConditions) : "";
        $query = "SELECT 
        cr.title,
        cr.request_id, 
        cr.description,
        cr.status, 
        cr.location,
        s.subject_title AS subject, 
        s.subject_id, 
        g.grade_name AS grade,
        g.grade_id AS grade_id,
        cr.created_date, 
        cr.updated_date, 
        u.user_id as author_id,
        CONCAT(u.first_name, ' ', u.last_name) AS author,
        COUNT(c.comment_id) AS comments_count
        FROM course_requests cr
        LEFT JOIN subjects s ON cr.subject_id = s.subject_id
        JOIN users u ON cr.user_id = u.user_id
        JOIN grades g ON g.grade_id = cr.grade_id
        LEFT JOIN course_request_comments c ON cr.request_id = c.request_id
        WHERE cr.status = 'approved'
        {$whereClause}
        GROUP BY 
        cr.request_id, cr.title, cr.description, cr.status, cr.location,
        s.subject_title, s.subject_id, g.grade_name, g.grade_id,
        cr.created_date, cr.updated_date, u.user_id, u.first_name, u.last_name
        {$orderClause}
        LIMIT {$length} OFFSET {$offset};";

        $requests = $this->db->query($query, $params)->findAll();

        $requestCount = $this->db->query(
            "SELECT 
        COUNT(*)
        FROM course_requests cr
        LEFT JOIN subjects s ON cr.subject_id = s.subject_id
        JOIN users u ON cr.user_id = u.user_id
        JOIN grades g ON g.grade_id = cr.grade_id
        LEFT JOIN course_request_comments c ON cr.request_id = c.request_id
        WHERE cr.status = 'approved'
        {$whereClause};",
            $params
        )->count();

        return [$requests, $requestCount];
    }
    public function getPendingCourseRequests()
    {
        $query =
            "SELECT 
                cr.title,
                cr.request_id, 
                cr.description,
                cr.status, 
                s.subject_title AS subject, 
                cr.created_date, 
                cr.updated_date, 
                u.user_id as author_id,
                u.user_role,
                CONCAT(u.first_name, ' ', u.last_name) AS author
            FROM 
                course_requests cr
            LEFT JOIN 
                subjects s ON cr.subject_id = s.subject_id
            JOIN 
                users u ON cr.user_id = u.user_id
            WHERE 
                cr.status = 'pending'
            GROUP BY 
                cr.title, cr.request_id, cr.description, cr.status, s.subject_title, 
                cr.created_date, cr.updated_date, u.first_name, u.last_name;    
            ";

        $requests = $this->db->query($query)->findAll();

        return $requests;
    }

    public function getCourseReuqestById(string $requestId)
    {
        $query =
            "SELECT 
                cr.title,
                cr.request_id, 
                cr.description,
                s.subject_id, 
                s.subject_title AS subject,
                cr.grade_id,
                g.grade_name AS grade,
                cr.location,
                cr.created_date, 
                cr.updated_date,
                cr.user_id,
                CONCAT(u.first_name, ' ', u.last_name) AS author
            FROM 
                course_requests cr
            LEFT JOIN 
                subjects s ON cr.subject_id = s.subject_id
            JOIN 
                users u ON cr.user_id = u.user_id
            JOIN
                grades g ON g.grade_id = cr.grade_id
            WHERE 
                request_id = :request_id  
            ";

        $request = $this->db->query(
            $query,
            [
                "request_id" => $requestId
            ]
        )->find();

        return $request;
    }

    public function getCommentsByRequestId(string $requestId)
    {
        $query =
            "SELECT 
                comments.comment_id,
                comments.comment,
                comments.created_date, 
                comments.updated_date,
                comments.user_id as author_id,
                CONCAT(u.first_name, ' ', u.last_name) AS author
            FROM 
                course_request_comments AS comments
            JOIN
                users u ON comments.user_id = u.user_id
            WHERE 
                request_id = :request_id      
            ";

        $comments = $this->db->query(
            $query,
            [
                "request_id" => $requestId
            ]
        )->findAll();

        return $comments;
    }

    public function createComment(array $formData, string $requestId)
    {
        $user_id = $_SESSION['user'];

        $query =
            "INSERT INTO course_request_comments(comment, user_id, request_id)
            VALUES (:comment, :user_id, :request_id) ";

        $this->db->query(
            $query,
            [
                "comment" => $formData['comment'],
                "user_id" => $user_id,
                "request_id" => $requestId,
            ]
        );
    }

    public function deleteCourseRequestById(string $requestId)
    {
        $this->db->query(
            "DELETE FROM course_requests WHERE request_id = :request_id AND user_id = :user_id",
            [
                "request_id" => $requestId,
                "user_id" => $_SESSION['user']
            ]
        );
    }

    public function deleteCommentById(string $requestId, string $commentId)
    {
        $this->db->query(
            "DELETE FROM course_request_comments WHERE request_id = :request_id AND user_id = :user_id AND comment_id = :comment_id",
            [
                "request_id" => $requestId,
                "user_id" => $_SESSION['user'],
                "comment_id" => $commentId
            ]
        );
    }

    public function updateCourseRequestById(array $formData, string $requestId)
    {
        try {
            $this->db->query(
                "UPDATE course_requests SET
                title = :title,
                description = :description,
                subject_id = :subject_id,
                grade_id = :grade_id,
                location = :location
                WHERE request_id = :request_id AND user_id = :user_id",
                [
                    "title" => $formData['title'],
                    "description" => $formData['description'],
                    "subject_id" => $formData['subject'] != -1 ? $formData['subject'] : null,
                    "request_id" => $requestId,
                    'grade_id' => $formData['grade'],
                    'location' => $formData['location'],
                    "user_id" => $_SESSION['user']
                ]
            );
        } catch (Exception $e) {
            error_log("Failed to update course request: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    public function approveCourseRequestById(string $requestId)
    {
        $this->db->query(
            "UPDATE course_requests
             SET status = :status
             WHERE request_id = :request_id",
            [
                "request_id" => $requestId,
                "status" => 'approved'
            ]
        );
    }

    public function rejectCourseRequestById(string $requestId)
    {
        $this->db->query(
            "DELETE FROM course_requests
             WHERE request_id = :request_id",
            [
                "request_id" => $requestId
            ]
        );
    }

    public function updateCommentById(array $formData, string $requestId, string $commentId)
    {
        $query =
            "UPDATE course_request_comments SET
            comment = :comment
            WHERE request_id = :request_id AND user_id = :user_id AND comment_id = :comment_id";

        $this->db->query(
            $query,
            [
                "comment" => $formData["comment"],
                "request_id" => $requestId,
                "user_id" => $_SESSION['user'],
                "comment_id" => $commentId
            ]
        );
    }

    public function getUserCourseRequest(int $id)
    {
        try {
            return $this->db->query(
                "SELECT * FROM
                course_requests
                WHERE user_id = :id",
                [
                    'id' => $id
                ]
            )->findAll();
        } catch (Exception $e) {
            error_log("Failed to fetch course request by user ID: " . $e->getMessage());
            redirectTo('server-error');
        }
    }

    public function getRecentCourseRequest(int $limit = 0)
    {
        try {
            if ($limit != 0) {
                $limitClouse = "LIMIT " . $limit;
            }
            return $this->db->query(
                "SELECT 
                cr.title,
                cr.request_id, 
                cr.description,
                cr.status, 
                cr.location,
                s.subject_title AS subject, 
                s.subject_id, 
                g.grade_name AS grade,
                g.grade_id AS grade_id,
                cr.created_date, 
                cr.updated_date, 
                u.user_id as author_id,
                CONCAT(u.first_name, ' ', u.last_name) AS author,
                COUNT(c.comment_id) AS comments_count
                FROM course_requests cr
                LEFT JOIN subjects s ON cr.subject_id = s.subject_id
                JOIN users u ON cr.user_id = u.user_id
                JOIN grades g ON g.grade_id = cr.grade_id
                LEFT JOIN course_request_comments c ON cr.request_id = c.request_id
                WHERE cr.status = 'approved'
                ORDER BY cr.created_date DESC
                {$limitClouse};"
            )->findAll();
        } catch (Exception $e) {
            error_log("Failed to fetch recent course requests: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }
}
