<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class CourseRequestService
{
    public function __construct(private Database $db) {}

    public function create(array $formData)
    {
        $user_id = $_SESSION['user'];
        $this->db->query(
            "INSERT INTO course_requests(title, description, subject_id, user_id)
            VALUES (:title, :description, :subject_id, :user_id)",
            [
                "title" => $formData['requestTitle'],
                "description" => $formData['requestDescription'],
                "subject_id" => $formData['subject_id'] != -1 ? $formData['subject_id'] : null,
                "user_id" => $user_id,
            ]
        );
    }

    public function getCourseRequestsforView()
    {
        $query =
            "SELECT 
                cr.title,
                cr.request_id, 
                cr.description, 
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
                cr.title, cr.request_id, cr.description, s.subject_title, 
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
                cr.created_date, 
                cr.updated_date, 
                CONCAT(u.first_name, ' ', u.last_name) AS author
            FROM 
                course_requests cr
            LEFT JOIN 
                subjects s ON cr.subject_id = s.subject_id
            JOIN 
                users u ON cr.user_id = u.user_id
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
        $query =
            "UPDATE course_requests SET
            title = :title,
            description = :description,
            subject_id = :subject_id
            WHERE request_id = :request_id AND user_id = :user_id";

        $this->db->query(
            $query,
            [
                "title" => $formData['requestTitle'],
                "description" => $formData['requestDescription'],
                "subject_id" => $formData['subject_id'] != -1 ? $formData['subject_id'] : null,
                "request_id" => $requestId,
                "user_id" => $_SESSION['user']
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
}
