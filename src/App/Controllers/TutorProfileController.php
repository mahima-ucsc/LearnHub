<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{UserService, ReviewService};
use Framework\TemplateEngine;

class TutorProfileController
{
    public function __construct(private TemplateEngine $view, private UserService $userService, private ReviewService $reviewService) {}
    public function tutorProfile()
    {
        $userReview = $this->reviewService->getUserReview();
        $userDetails = $this->userService->getUserProfile();
        echo $this->view->render('Tutor/profile.php', [
            "title" => "Tutor",
            "userDetails" => $userDetails,
            "userReview" => $userReview
        ]);
    }
}
