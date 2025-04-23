<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use App\Config\Paths;

class ReviewService
{
    public function __construct(private Database $db) {}

    public function create(array $formData)
    {
        $this->db->query(
            "INSERT INTO tutor_review(review, rating, tutor_id, user_id)VALUES(:review, :rating, :tutor_id, :user_id)",
            [
                'review' => $formData['review'],
                'rating' => $formData['rating'],
                'tutor_id' => $formData['tutor_id'],
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function getTutorReview(string $id)
    {
        $tutorReview = $this->db->query(
            "SELECT * FROM tutor_review WHERE tutor_id = :tutor_id",
            [
                'tutor_id' => $id
            ]
        )->findAll();
        return $tutorReview;
    }

    public function getUserReview()
    {
        $userReview = $this->db->query(
            "SELECT * FROM tutor_review WHERE user_id = :user_id",
            [
                'user_id' => $_SESSION['user']
            ]
        )->findAll();
        return $userReview;
    }

    public function getReviewById(string $id)
    {
        return $this->db->query(
            "SELECT * FROM tutor_review WHERE review_id = :review_id AND user_id = :user_id",
            [
                "review_id" => $id,
                "user_id" => $_SESSION['user']
            ]
        )->find();
    }

    public function update(array $formData, int $id)
    {
        $this->db->query(
            "UPDATE tutor_review
            SET review = :review,
            rating = :rating
            WHERE review_id = :review_id AND user_id = :user_id",
            [
                "review" => $formData['review'],
                "rating" => $formData['rating'],
                "review_id" => $id,
                "user_id" => $_SESSION['user']
            ]
        );
    }

    public function delete(int $id)
    {
        $this->db->query(
            "DELETE FROM tutor_review WHERE review_id = :review_id AND user_id = :user_id",
            [
                "review_id" => $id,
                "user_id" => $_SESSION['user']
            ]
        );
    }

    // course review

    public function createCourseReview(array $formData)
    {
        $this->db->query(
            "INSERT INTO course_review(review, rating, course_id, user_id)VALUES(:review, :rating, :course_id, :user_id)",
            [
                'review' => $formData['review'],
                'rating' => $formData['rating'],
                'course_id' => $formData['course_id'],
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function deleteCourseReview(string $id)
    {
        $this->db->query(
            "DELETE FROM course_review WHERE review_id = :review_id ",
            [
                "review_id" => $id,
            ]
        );
    }

    public function getCourseReviewById(string $id)
    {
        return $this->db->query(
            "SELECT * FROM course_review WHERE review_id = :review_id",
            [
                "review_id" => $id,
            ]
        )->find();
    }

    public function updateCourseRequest(array $formData, int $id)
    {
        $this->db->query(
            "UPDATE course_review
            SET review = :review,rating = :rating
            WHERE review_id = :review_id AND user_id = :user_id",
            [
                "review" => $formData['review'],
                "rating" => $formData['rating'],
                "review_id" => $id,
                "user_id" => $_SESSION['user']
            ]
        );
    }

    public function getCourseReview(string $courseId, string $page)
    {
        $limit = 3;
        $offset = $page * $limit + 5;

        $userReview = $this->db->query(
            "SELECT c.*, CONCAT(u.first_name, ' ', u.last_name) AS name, u.profile_picture_url 
            FROM course_review c 
            JOIN users u on c.user_id = u.user_id 
            WHERE course_id = :course_id
            ORDER BY c.date 
            DESC
            LIMIT $offset, $limit",
            [
                'course_id' => $courseId,
            ]
        )->findAll();
        if ($userReview['profile_picture_url'] !== null) {
            $userReview['profile_picture_url'] =
                Paths::UPLOAD_FOLDER_RELATIVE_TO_PUBLIC . "/" .
                Paths::RELATIVE_USER_PROFILE_PICTURE_UPLOADS .
                '/' . $userReview['profile_picture_url'];
        }
        return $userReview;
    }
}
