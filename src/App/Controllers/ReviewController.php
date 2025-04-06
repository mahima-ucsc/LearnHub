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
    public function deleteCourseReview()
    {
        $this->reviewService->deleteCourseReview((int)$_POST['review_id']);
        redirectTo($_SERVER['HTTP_REFERER']);
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
}
