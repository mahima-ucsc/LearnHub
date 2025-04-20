<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{CourseRequestService, UserService, CourseService, AdvertisementService, PaymentService, ResourceService, ReviewService};
use APP\Config\Paths;


class PageController
{
    public function __construct(
        private TemplateEngine $view,
        private UserService $userService,
        private CourseService $courseService,
        private CourseRequestService $courseRequestService,
        private AdvertisementService $advertisementService,
        private PaymentService $paymentService,
        private ResourceService $resourceService,
        private ReviewService $reviewService
    ) {}

    public function home()
    {
        $advertisements = $this->advertisementService->getApprovedAds();
        $courseCount = $this->courseService->getNoOfCourses();
        $roundedCourseCount = floor($courseCount / 10) * 10;
        $subjectCourseCount = $this->courseService->getCourseCountBySubject(10);
        $recentCourseRequests = $this->courseRequestService->getRecentCourseRequest(2);

        //TODO: must implement after development of resource component is finished
        // $recentResources = $this->resourceService->getRecentResource(3);

        echo $this->view->render('index.php', [
            "title" => "Home",
            "advertisements" => $advertisements,
            "roundedCourseCount" => $roundedCourseCount,
            "subjectCounts" => $subjectCourseCount,
            "recentCourseRequests" => $recentCourseRequests
        ]);
    }
    public function helpAndSupportReview()
    {
        echo $this->view->render('User/Admin/help_And_Support_Review.php', [
            "title" => "Help & Support"
        ]);
    }

    public function about()
    {
        $courseCount = $this->courseService->getNoOfCourses();
        $roundedCourseCount = floor($courseCount / 10) * 10;
        $userCount = $this->userService->getUserCount();
        $roundedTeacherCount = ($userCount['teachers'] / 10) * 10;
        $roundedStudentCount = ($userCount['students'] / 10) * 10;

        echo $this->view->render('about.php', [
            "title" => "About",
            "roundedCourseCount" => $roundedCourseCount,
            "roundedTeacherCount" => $roundedTeacherCount,
            "roundedStudentCount" => $roundedStudentCount
        ]);
    }

    public function helpAndSupport()
    {
        echo $this->view->render('help_and_support.php', [
            "title" => "help-and-support"
        ]);
    }

    public function contact()
    {
        echo $this->view->render('contact.php', [
            "title" => "contact-us"
        ]);
    }

    public function dashboard()
    {
        if ($_SESSION['user_role'] === "student") {

            $path = "User/student/std_index.php";
            $courses = $this->courseService->getStudentCourses($_SESSION['user']);
            $userData = $this->userService->getUserProfile($_SESSION['user']);
            $courseThumbnailPath = Paths::STORAGE_UPLOADS . Paths::RELATIVE_COURSE_THUMBNAIL_UPLOADS;
            // dd($courses);
            echo $this->view->render($path, [
                "title" => "Dashboard",
                'courses' => $courses,
                'userData' => $userData,
                'courseThumbnailPath' => $courseThumbnailPath
            ]);
        } elseif ($_SESSION['user_role'] === "teacher") {
            $path = "User/Tutor/teacher_index.php";
        } elseif ($_SESSION['user_role'] === "admin") {

            $path = "User/Admin/admin_dashboard.php";
            $userCount = $this->userService->getUserCount();
            $courseCount = $this->courseService->getNoOfCourses();
            $stat = [
                "users" => $userCount,
                "courses" => $courseCount
            ];

            echo $this->view->render($path, [
                "title" => "Admin Dashboard",
                'users' => $users ?? '',
                "courses" => $courses ?? '',
                "stat" => $stat,
            ]);
            exit;
        } else {
            $path = "index.php";
        }
        $users = $this->userService->getAllUsers();
        echo $this->view->render($path, [
            "title" => "Dashboard",
            'users' => $users,
        ]);
    }

    public function billingAndPayment()
    {
        echo $this->view->render('User/payment.php', [
            'title' => "Billing & Payment"
        ]);
    }
    public function teacherU()
    {
        $users = $this->userService->getAllUsers();
        echo $this->view->render('User/Admin/user_managment.php', [
            'title' => "User Managment",
            'users' => $users
        ]);
    }
    public function courseManagment()
    {
        if ($_SESSION['user_role'] === 'teacher') {
            $courses = $this->courseService->getTeacherCourses($_SESSION['user']);
            $courseCount = count($courses);
            $revenue = $this->paymentService->getTeacherCourseIncome($_SESSION['user']);
            $revenue = $revenue[0]['revenue'];
        } else {
            $courseCount = $this->courseService->getNoOfCourses();
            $courses = $this->courseService->getCourseList();
            $revenue = $this->paymentService->getTotalCourseIncome();
            $revenue = $revenue[0]['revenue'];
        }
        echo $this->view->render('User/course_managment.php', [
            'title' => "Course Managment",
            'courseCount' => $courseCount,
            "courses" => $courses,
            'revenue' => $revenue
        ]);
    }
    public function unauthorizedAccess()
    {
        echo $this->view->render("unauthorized_access.php", [
            'title' => "401 Unauthorized Access"
        ]);
    }
    public function notFound()
    {
        echo $this->view->render('notFound.php', [
            'title' => "404 - Page Not Found"
        ]);
    }
    public function internalServerError()
    {
        echo $this->view->render('internal_server_error.php', [
            'title' => "500 - Internal Server Error"
        ]);
    }

    public function myCourses()
    {
        echo $this->view->render(
            "User/user_courses.php",
            [
                'title' => "User Courses"
            ]
        );
    }

    public function interest()
    {
        echo $this->view->render(
            'interest_selection.php',
            [
                'title' => "Pick Your Interest"
            ]
        );
    }
    public function interestSkip()
    {
        echo $this->view->render(
            'index.php',
            [
                'title' => "Pick Your Interest"
            ]
        );
    }
    public function interestContinue()
    {
        echo $this->view->render(
            'index.php',
            [
                'title' => "Pick Your Interest"
            ]
        );
    }
    public function createAd()
    {
        echo $this->view->render(
            'Tutor/create_ad.php',
            [
                'title' => "Create Ad"
            ]
        );
    }

    public function settings()
    {
        $userDetails = $this->userService->getUserProfile();
        echo $this->view->render('User/settings.php', [
            "title" => "Settings",
            "userDetails" => $userDetails
        ]);
    }

    public function createAnnouncements()
    {
        echo $this->view->render("User/Tutor/create_announcement.php", [
            "title" => "Create Announcement"
        ]);
    }
    public function teacher()
    {
        echo $this->view->render("User/Tutor/teacher_index.php", [
            "title" => "Teacher"
        ]);
    }
    public function userManagment()
    {
        if ($_SESSION['user_role'] === "teacher") {
            $path = "User/Tutor/user_managment.php";
        } else {
            $path = "User/Admin/admin_user_managment.php";
            $users = $this->userService->getUsers();
            $userCount = $this->userService->getUserCount();
        }
        echo $this->view->render($path, [
            "title" => "User Managment",
            "users" => $users,
            "userCount" => $userCount
        ]);
    }
    public function postManagment()
    {
        $courseRequests = $this->courseRequestService->getPendingCourseRequests();
        echo $this->view->render("User/Admin/admin_post_managment.php", [
            "title" => "Post Managment",
            "posts" => $courseRequests
        ]);
    }
    public function adManagment()
    {
        $advertisements = $this->advertisementService->getAdvertisements();
        // dd($advertisements);
        echo $this->view->render("User/Admin/admin_ad_managment.php", [
            "title" => "Ad Managment",
            "advertisements" => $advertisements
        ]);
    }
    public function userResourceView()
    {
        $resources = $this->resourceService->getResources();
        echo $this->view->render(
            '/User/student/resource.php',
            [
                'title' => "My resource",
                'resources' => $resources
            ]
        );
    }
    public function profile()
    {
        $userDetails = $this->userService->getUserProfile();
        $userReview = $this->reviewService->getUserReview();
        [$courses, $courseCount] = $this->courseService->searchCourse(
            3,
            0
        );
        echo $this->view->render('Tutor/profile.php', [
            "title" => "Profile",
            "userDetails" => $userDetails,
            "userReview" => $userReview,
            "courses" => $courses
        ]);
    }

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
    public function test()
    {

        echo $this->view->render("test.php", [
            "title" => "Post Managment"
        ]);
    }
}
