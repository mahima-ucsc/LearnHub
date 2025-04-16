<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{CourseRequestService, UserService, CourseService, AdvertisementService};


class PageController
{
    public function __construct(
        private TemplateEngine $view,
        private UserService $userService,
        private CourseService $courseService,
        private CourseRequestService $courseRequestService,
        private AdvertisementService $advertisementService
    ) {}

    public function home()
    {
        $advertisements = $this->advertisementService->getApprovedAds();
        echo $this->view->render('index.php', [
            "title" => "Home",
            "advertisements" => $advertisements
        ]);
    }
    /* OLD HOME*/
    // public function home()
    // {
    //     $user = $this->userService->getUserProfile();
    //     $userCount = $this->userService->getUserCount();
    //     $courseCount = $this->courseService->getNoOfCourses();
    //     $stat = [
    //         "users" => $userCount,
    //         "courses" => $courseCount
    //     ];
    //     $advertisements = $this->advertisementService->getApprovedAds();
    //     if ($_SESSION['user_role'] === "student") {
    //         $path = "User/student/std_index.php";
    //     } elseif ($_SESSION['user_role'] === "teacher") {
    //         $path = "User/Tutor/teacher_index.php";
    //     } elseif ($_SESSION['user_role'] === "admin") {
    //         $path = "User/Admin/admin_dashboard.php";
    //     } else {
    //         $path = "index.php";
    //     }
    //     echo $this->view->render('$index.php', [
    //         "title" => "Home",
    //         "userData" => $user,
    //         "stat" => $stat,
    //         "advertisements" => $advertisements
    //     ]);
    // }
    public function helpAndSupportReview()
    {
        echo $this->view->render('User/Admin/help_And_Support_Review.php', [
            "title" => "Help & Support"
        ]);
    }

    public function about()
    {
        echo $this->view->render('about.php', [
            "title" => "About"
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
        $myCourses = $this->courseService->getMyCourses();
        $users = $this->userService->getAllUsers();
        echo $this->view->render($path, [
            "title" => "Dashboard",
            'users' => $users,
            "myCourses" => $myCourses
        ]);
    }

    /*
    OLD dashboard
     */
    // public function dashboard()
    // {
    //     $myCourses = $this->courseService->getMyCourses();
    //     $users = $this->userService->getAllUsers();
    //     echo $this->view->render('User/Tutor/dashboard.php', [
    //         "title" => "Dashboard",
    //         'users' => $users,
    //         "myCourses" => $myCourses
    //     ]);
    // }



    /* 
    * Old AdminDashboard
    */
    // public function adminDashboard()
    // {
    //     $users = [];
    //     $courses = [];
    //     $courseRequests = [];

    //     // Handle user data
    //     if ($_GET['tab'] == 'user-managment') {

    //         // $users = $this->userService->getAllUsers();
    //         $users = $this->userService->getUsers();
    //     }

    //     // handle posts
    //     if ($_GET['tab'] == 'post-managment') {
    //         $courseRequests = $this->courseRequestService->getPendingCourseRequests();
    //     }

    //     if ($_GET['tab'] == 'course-managment') {
    //         $courses = $this->courseService->getAllCourses();
    //     }

    //     $userCount = $this->userService->getUserCount();
    //     $courseCount = $this->courseService->getNoOfCourses();
    //     $stat = [
    //         "users" => $userCount,
    //         "courses" => $courseCount
    //     ];
    //     echo $this->view->render('User/Admin/admin_dashboard.php', [
    //         "title" => "Admin Dashboard",
    //         'users' => $users ?? '',
    //         "courses" => $courses ?? '',
    //         "stat" => $stat,
    //         "courseRequests" => $courseRequests
    //     ]);
    // }

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
        $courseCount = $this->courseService->getNoOfCourses();
        $courses = $this->courseService->getCourseList();
        echo $this->view->render('User/Admin/admin_course_managment.php', [
            'title' => "Course Managment",
            'courseCount' => $courseCount,
            "courses" => $courses
        ]);
    }
    public function unauthorizedAccess()
    {
        echo $this->view->render("unauthorized_access.php", [
            'title' => "401 Unauthorized Access"
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
    public function notFound()
    {
        echo $this->view->render('notFound.php', [
            'title' => "404 - Page Not Found"
        ]);
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
            "title" => "Teacher",
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
    public function test()
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 8;
        $offset = ($page - 1) * $length;
        $searchTerm = $_GET['s'] ?? null;
        $searchBy = $_GET['f'] ?? null;
        $location = $_GET['location'] ?? null;

        [$courses, $courseCount] = $this->courseService->searchCourse(
            $length,
            $offset
        );


        $lastPage = ceil($courseCount / $length);
        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLinks = array_map(
            fn($pageNum) => http_build_query([
                'p' => $pageNum,
                's' => $searchTerm,
                'f' => $searchBy,
                "location" => $location
            ]),
            $pages
        );

        echo $this->view->render('course/Courses copy.php', [
            "title" => "Search Course",
            "courses" => $courses,
            "currentPage" => $page,
            "previousPageQuery" => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm,
                'f' => $searchBy,
                "location" => $location
            ]),
            "lastPage" => $lastPage,
            "nextPageQuery" => http_build_query([
                'p' => $page + 1,
                's' => $searchTerm,
                'f' => $searchBy,
                "location" => $location
            ]),
            "pageLinks" => $pageLinks,
            "searchTerm" => $searchTerm,
            "searchBy" => $searchBy,
            "location" => $location
        ]);
        // echo $this->view->render("test.php", [
        //     "title" => "Post Managment"
        // ]);
    }
    public function testPost()
    {
        dd($_POST);
    }
}
