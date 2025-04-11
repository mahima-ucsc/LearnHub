<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{UserService, ReviewService};
use Framework\TemplateEngine;

class TutorProfileController
{
    public function __construct(private TemplateEngine $view, private UserService $userService, private ReviewService $reviewService) {}
    public function tutorProfile($params)
    {
        // dd($params);
        $tutorReview = $this->reviewService->getTutorReview($params['id']);
        // dd($tutorReview);
        //calculate summery of reviews
        $summeryOfReviews = [];
        $totalReviews = count($tutorReview);
        $starCount = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $totalRating = 0;
        foreach ($tutorReview as $review) {
            $totalRating += $review['rating'];
            $starCount[$review['rating']]++;
        }
        $avgRating = $totalReviews > 0 ? ($totalRating / $totalReviews) : 0;

        $summeryOfReviews = ['totalReviews' => $totalReviews, 'avgRating' => number_format($avgRating, 2), 'starCount' => $starCount];
        $userDetails = $this->userService->getUserProfile();
        echo $this->view->render('Tutor/profile.php', [
            "title" => "Tutor",
            "userDetails" => $userDetails,
            "userReview" => $tutorReview,
            "summeryOfReviews" => $summeryOfReviews
        ]);
    }
}
