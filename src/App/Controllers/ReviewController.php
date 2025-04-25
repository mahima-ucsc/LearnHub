<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\ReviewService;

class ReviewController
{
    public function __construct(
        private TemplateEngine $view,
        private ReviewService $reviewService
    ) {}

    public function editView(array $params)
    {
        $review = $this->reviewService->getReviewById($params['review']);
        if (!$review) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }

        echo $this->view->render(
            "Review/edit_review.php",
            [
                "title" => "Edit Review",
                'review' => $review
            ]
        );
    }

    public function edit(array $params)
    {
        $review = $this->reviewService->getReviewById($params['review']);

        if (!$review) {
            redirectTo('/tutor');
        }
        $this->reviewService->update($_POST, (int)$params['review']);
        redirectTo("/tutor");
    }

    public function addReview()
    {
        $this->reviewService->create($_POST);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function userReview()
    {
        return $this->reviewService->getUserReview();
    }

    public function deleteReview(array $params)
    {
        $this->reviewService->delete((int)$params['review']);
        redirectTo('/tutor');
    }

    //course review
    public function addCourseReview()
    {
        $this->reviewService->createCourseReview($_POST);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function deleteCourseReview($params)
    {
        if ($_POST['token'] === $_SESSION['token']) {
            $this->reviewService->deleteCourseReview($params['review']);
            redirectTo($_SERVER['HTTP_REFERER']);
        } else {
            throw new \Exception("Invalid token. Please try again.");
        }
    }

    public function editCourseReviewView(array $params)
    {
        $review = $this->reviewService->getCourseReviewById($params['review']);

        if (!$review) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }
        echo $this->view->render(
            "course/course-info/course-review-edit.php",
            [
                "title" => "Edit Course Review",
                'review' => $review
            ]
        );
    }

    public function editCourseReview($params)
    {
        $review = $this->reviewService->getCourseReviewById($params['review']);
        if (!$review) {
            redirectTo('/course');
        }
        $this->reviewService->updateCourseRequest($_POST, (int)$params['review']);
        redirectTo("/courses/" . $review['course_id']);
    }

    public function getCourseReview($params)
    {
        header('Content-Type: application/json');
        $courseReview = $this->reviewService->getCourseReview($params['course'], $params['page']);
        echo json_encode($courseReview);
        exit;
    }

    // tutor review controllers
    public function addTutorReview()
    {
        $this->reviewService->creatTutorReview($_POST);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function deleteTutorReview()
    {
        if ($_POST['token'] === $_SESSION['token']) {
            $this->reviewService->deleteTutorReview($_POST['review_id']);
        }
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function editTutorReviewView(array $params)
    {
        $review = $this->reviewService->getTutorReviewById($params['review']);

        if (!$review) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }
        echo $this->view->render(
            "User/Tutor/tutor-review-edit.php",
            [
                "title" => "Edit Course Review",
                'review' => $review
            ]
        );
    }

    public function editTutorReview($params)
    {
        $review = $this->reviewService->getTutorReviewById($params['review']);
        if (!$review) {
            redirectTo('/');
        }
        $this->reviewService->updateTutorRequest($_POST, (int)$params['review']);
        redirectTo("/tutor/" . $review['tutor_id']);
    }

    public function getTutorReview($params)
    {
        header('Content-Type: application/json');
        $TutorReview = $this->reviewService->getTutorReview($params['tutor_id'], $params['page']);
        echo json_encode($TutorReview);
        exit;
    }
}
