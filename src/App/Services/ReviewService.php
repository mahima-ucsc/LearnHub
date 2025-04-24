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

    // public function getTutorReview(string $id)
    // {
    //     $tutorReview = $this->db->query(
    //         "SELECT * FROM tutor_review WHERE tutor_id = :tutor_id",
    //         [
    //             'tutor_id' => $id
    //         ]
    //     )->findAll();
    //     return $tutorReview;
    // }

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
        $offset = $page * $limit;

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

    public function getSummeryOfReview(string $coruseId)
    {
        $userReview = $this->db->query(
            "SELECT rating FROM course_review WHERE course_id = :course_id",
            [
                'course_id' => $coruseId
            ]
        )->findAll();
        $totalReviews = count($userReview);
        $starCount = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $totalRating = 0;
        foreach ($userReview as $review) {
            $totalRating += $review['rating'];
            $starCount[$review['rating']]++;
        }
        $avgRating = $totalReviews > 0 ? ($totalRating / $totalReviews) : 0;
        $summeryOfReviews = ['totalReviews' => $totalReviews, 'avgRating' => $avgRating, 'starCount' => $starCount];
        return ($summeryOfReviews);
    }


    // tutor review 
    public function creatTutorReview(array $formData)
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

    public function deleteTutorReview(string $id)
    {
        $this->db->query(
            "DELETE FROM tutor_review WHERE review_id = :review_id ",
            [
                "review_id" => $id,
            ]
        );
    }

    public function getTutorReviewById(string $id)
    {
        return $this->db->query(
            "SELECT * FROM tutor_review WHERE review_id = :review_id",
            [
                "review_id" => $id,
            ]
        )->find();
    }

    public function updateTutorRequest(array $formData, int $id)
    {
        $this->db->query(
            "UPDATE tutor_review
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

    public function getTutorReview(string $tutorId, string $page)
    {
        $limit = 3;
        $offset = (int)$page * $limit;

        $userReview = $this->db->query(
            "SELECT tr.*, CONCAT(u.first_name, ' ', u.last_name) AS name, u.profile_picture_url 
            FROM tutor_review tr
            JOIN users u on tr.user_id = u.user_id 
            WHERE tutor_id = :tutor_id
            ORDER BY tr.date 
            DESC
            LIMIT $offset, $limit",
            [
                'tutor_id' => $tutorId,
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

    public function getSummeryOfTutorReview(string $tutorId)
    {
        $userReview = $this->db->query(
            "SELECT rating FROM tutor_review WHERE tutor_id = :tutor_id",
            [
                'tutor_id' => $tutorId
            ]
        )->findAll();
        $totalReviews = count($userReview);
        $starCount = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $totalRating = 0;
        foreach ($userReview as $review) {
            $totalRating += $review['rating'];
            $starCount[$review['rating']]++;
        }
        $avgRating = $totalReviews > 0 ? ($totalRating / $totalReviews) : 0;
        $summeryOfReviews = ['totalReviews' => $totalReviews, 'avgRating' => $avgRating, 'starCount' => $starCount];
        return ($summeryOfReviews);
    }
}
