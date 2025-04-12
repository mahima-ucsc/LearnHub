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
            redirectTo('/profile');
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
}
