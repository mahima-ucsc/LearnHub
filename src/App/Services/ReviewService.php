<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

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

    public function deleteCourseReview(int $id)
    {
        $this->db->query(
            "DELETE FROM course_review WHERE review_id = :review_id AND user_id = :user_id",
            [
                "review_id" => $id,
                "user_id" => $_SESSION['user']
            ]
        );
    }

    public function getCourseReviewById(string $id)
    {
        return $this->db->query(
            "SELECT * FROM course_review WHERE review_id = :review_id AND user_id = :user_id",
            [
                "review_id" => $id,
                "user_id" => $_SESSION['user']
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
}
