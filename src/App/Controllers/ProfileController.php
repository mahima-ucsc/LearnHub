<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{UserService, ReviewService};
use Framework\TemplateEngine;

class ProfileController
{

    public function __construct(private TemplateEngine $view, private UserService $userService, private ReviewService $reviewService) {}

    // public function profile()
    // {
    //     $userDetails = $this->userService->getUserProfile();
    //     echo $this->view->render('User/profile.php', [
    //         "title" => "Profile",
    //         "userDetails" => $userDetails
    //     ]);
    // }
    public function profile()
    {
        $userDetails = $this->userService->getUserProfile();
        $userReview = $this->reviewService->getUserReview();
        echo $this->view->render('Tutor/profile.php', [
            "title" => "Profile",
            "userDetails" => $userDetails,
            "userReview" => $userReview
        ]);
    }
}
