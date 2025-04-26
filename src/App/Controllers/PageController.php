<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{CourseRequestService, UserService, CourseService, AdvertisementService, PaymentService, ResourceService, ReviewService, SubjectService};
use APP\Config\Paths;
use Exception;

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
        private ReviewService $reviewService,
        private SubjectService $subjectService
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
            $courses = $this->courseService->getStudentCourses((string)$_SESSION['user']);
            $userData = $this->userService->getUserProfile($_SESSION['user']);
            $courseThumbnailPath = Paths::STORAGE_UPLOADS . Paths::RELATIVE_COURSE_THUMBNAIL_UPLOADS;
            echo $this->view->render($path, [
                "title" => "Dashboard",
                'courses' => $courses,
                'userData' => $userData,
                'courseThumbnailPath' => $courseThumbnailPath
            ]);
            exit;
        } elseif ($_SESSION['user_role'] === "teacher") {

            $courses = $this->courseService->getTeacherCourses((int)$_SESSION['user']);
            $courseCount = count($courses);

            // Get course_id's
            $courseIds = [];
            foreach ($courses as $c) {
                $courseIds[] = $c['course_id'];
            }

            // Get number of students enrolled in teacher's courses
            $studentCount = 0;
            foreach ($courseIds as $id) {
                $participants = $this->courseService->getCourseParticipants((string) $id);
                $studentCount += count($participants);
            }

            $path = "User/Tutor/teacher_index.php";
            echo $this->view->render($path, [
                "title" => "Teacher Dashboard",
                "courseCount" => $courseCount,
                "studentCount" => $studentCount
            ]);
            exit;
        } elseif ($_SESSION['user_role'] === "admin") {

            $path = "User/Admin/admin_dashboard.php";
            $userCount = $this->userService->getUserCount();
            $totalUsers = (int)$userCount['students'] + (int)$userCount['admin'] + (int)$userCount['teacher'];

            $totalCourses = $this->courseService->getNoOfCourses();
            $courseCountByType = $this->courseService->getCourseCountByType();

            $stat = [
                "users" => $userCount,
            ];

            [$adRevenue, $withdrawalRevenue] = $this->paymentService->getTotalRevenue("", "");
            $totalRevenue = (int)$adRevenue + (int)$withdrawalRevenue;
            echo $this->view->render($path, [
                "title" => "Admin Dashboard",
                'users' => $users ?? '',
                "courses" => $courses ?? '',
                "stat" => $stat,
                "totalUsers" => $totalUsers ?? 0,
                "totalCourses" => $totalCourses ?? 0,
                "totalRevenue" => $totalRevenue ?? 0,
                "courseCountByType" => $courseCountByType ?? []
            ]);
            exit;
        } else {
            $path = "index.php";
        }
    }

    public function billingAndPayment()
    {
        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 9;
        $offset = ($page - 1) * $itemsPerPage;

        $searchParams = [
            's' => $_GET['s'] ?? '',
            'status' => $_GET['status'] ?? 'all',
            'date' => $_GET['date'] ?? 'all',
        ];

        [$paymentDetails, $count] = $this->paymentService->getPaymentHistory(
            $itemsPerPage,
            $offset
        );

        $pagination = generatePagination($count, $page, $itemsPerPage, $searchParams);


        if (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'teacher') {
            $revenue = $this->paymentService->getTeacherCourseIncome($_SESSION['user'])['revenue'];

            $courses = $this->courseService->getTeacherCourses((int)$_SESSION['user']);
            $courseCount = count($courses);
            // $paymentDetails = $this->paymentService->getTeacherCoursesPaymentHistory((string)$_SESSION['user']);

            echo $this->view->render('User/payment.php', [
                'title' => "Billing & Payment",
                "revenue" => $revenue,
                "courseCount" => $courseCount,
                "paymentDetails" => $paymentDetails,
                'pagination' => $pagination
            ]);
        } elseif (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'student') {
            // $paymentDetails = $this->paymentService->getStudentPaymentHistory($_SESSION['user']);
            echo $this->view->render('User/payment.php', [
                'title' => "Billing & Payment",
                "paymentDetails" => $paymentDetails,
                'pagination' => $pagination
            ]);
        } elseif (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'admin') {
            $totalTransactions = $this->paymentService->getTotalTransactions()['revenue'];
            $totalWithdrawal = $this->paymentService->getTotalWithdrawal()['revenue'];
            echo $this->view->render('User/payment.php', [
                'title' => "Billing & Payment",
                "paymentDetails" => $paymentDetails,
                'pagination' => $pagination,
                "transactions" => $totalTransactions,
                'totalWithdrawal' => $totalWithdrawal
            ]);
        }
    }

    public function walletView()
    {
        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 6;
        $offset = ($page - 1) * $itemsPerPage;

        $searchParams = [
            's' => $_GET['s'] ?? '',
            'status' => $_GET['status'] ?? 'all',
            'date' => $_GET['date'] ?? 'all',
        ];

        [$withdrawalHistory, $count] = $this->paymentService->getWithdrawalHistory(
            $itemsPerPage,
            $offset
        );

        $pagination = generatePagination($count, $page, $itemsPerPage, $searchParams);

        $totalRevenue = $this->paymentService->getTeacherCourseIncome((int)$_SESSION['user'])['revenue'];

        $withdrawedAmount = $this->paymentService->getWithdrawedAmount((int)$_SESSION['user'])['total_amount'];

        $balance = $totalRevenue - $withdrawedAmount;



        echo $this->view->render('User/Tutor/wallet.php', [
            'title' => "Wallet",
            'withdrawalHistory' => $withdrawalHistory,
            'pagination' => $pagination,
            'totalRevenue' => $totalRevenue,
            'withdrawedAmount' => $withdrawedAmount,
            "balance" => $balance
        ]);
    }

    public function requestWithdrawal()
    {
        try {
            $formData = $_POST;
            $formData['bank_details'] = nl2br($formData['bank_details']);
            $this->paymentService->requestWithdrawal($_POST);
        } catch (Exception $e) {
            error_log("Failed to request withdrawal: " . $e->getMessage());
            redirectTo("/server-error");
        }
    }
    public function courseManagment()
    {
        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 10;
        $offset = ($page - 1) * $itemsPerPage;
        $searchParams = [
            's' => $_GET['s'] ?? ''
        ];
        if ($_SESSION['user_role'] === 'teacher') {
            $courses = $this->courseService->getTeacherCourses($_SESSION['user'], $itemsPerPage, $offset);
            $courseCount = count($courses);
            $totalCourses = $this->courseService->getTeacherCourseCount($_SESSION['user']);


            $revenue = $this->paymentService->getTeacherCourseIncome($_SESSION['user']);
            $revenue = $revenue['revenue'];
            $pagination = generatePagination($courseCount, $page, $itemsPerPage, $searchParams);
        } else {
            [$courses, $courseCount] = $this->courseService->searchCourse(
                $itemsPerPage,
                $offset
            );
            $totalCourses = $this->courseService->getNoOfCourses();
            $revenue = $this->paymentService->getTotalCourseIncome();
            $revenue = $revenue[0]['revenue'];
            $pagination = generatePagination($courseCount, $page, $itemsPerPage, $searchParams);
        }
        echo $this->view->render('User/course_managment.php', [
            'title' => "Course Managment",
            'totalCourses' => $totalCourses,
            "courses" => $courses,
            'revenue' => $revenue,
            'pagination' => $pagination
        ]);
    }

    public function resourceManagment()
    {
        // $resources = $this->resourceService->getResources();
        // $resourceCount = count($resources);

        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 6;
        $offset = ($page - 1) * $itemsPerPage;

        // Get search parameters
        $searchParams = [
            's' => $_GET['s'] ?? '',
            'status' => $_GET['status'] ?? 'all',
        ];

        [$resources, $resourceCount] = $this->resourceService->searchResource(
            $itemsPerPage,
            $offset
        );

        $pagination = generatePagination($resourceCount, $page, $itemsPerPage, $searchParams);





        echo $this->view->render("User/Admin/admin_resource_managment.php", [
            "title" => "Admin Resource managment",
            "resources" => $resources,
            "resourceCount" => $resourceCount,
            "pagination" => $pagination
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

    public function interestView()
    {
        $subjects = $this->subjectService->getSubjects();
        echo $this->view->render(
            'interest_selection.php',
            [
                'title' => "Select Your Interests",
                'subjects' => $subjects
            ]
        );
    }

    public function interest()
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $this->userService->saveUserInterest($data['interests']);
            $data = [
                "success" => false,
                "message" => "Success"
            ];
        } catch (Exception $e) {
            $data = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }

        echo json_encode($data);
    }

    public function createAd()
    {
        echo $this->view->render(
            'User/Tutor/create_ad.php',
            [
                'title' => "Create Ad"
            ]
        );
    }

    public function settings()
    {
        $userDetails = $this->userService->getUserProfile();
        $subjects = $this->subjectService->getSubjects();
        $tutorBasic = $this->userService->getTutorbasic((string)$userDetails['user_id']);
        $tutorSubjects = $this->userService->getTutorSubjects((string)$userDetails['user_id']);
        $tutorEducations = $this->userService->getTutorEducations((string)$userDetails['user_id']);
        $tutorAvailablities = $this->userService->getTutorAvailability((string)$userDetails['user_id']);
        echo $this->view->render('User/settings.php', [
            "title" => "Settings",
            "userDetails" => $userDetails,
            "title" => "creat your profile",
            'subjects' => $subjects,
            'tutorBasic' => $tutorBasic,
            'tutorSubjects' => $tutorSubjects,
            'tutorEducations' => $tutorEducations,
            'tutorAvailablities' => $tutorAvailablities,
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
        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 10;
        $offset = ($page - 1) * $itemsPerPage;

        $searchParams = [
            's' => $_GET['s'] ?? '',
            'role' => $_GET['role'] ?? ''
        ];

        [$users, $userCount] = $this->userService->getUsers($itemsPerPage, $offset);
        $totalUsers = $this->userService->getUserCount();

        $pagination = generatePagination($userCount, $page, $itemsPerPage, $searchParams);

        echo $this->view->render('User/Admin/admin_user_managment.php', [
            "title" => "User Managment",
            "users" => $users,
            "totalUsers" => $totalUsers,
            "pagination" => $pagination
        ]);
    }
    public function postManagment()
    {
        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 10;
        $offset = ($page - 1) * $itemsPerPage;

        $searchParams = [
            'status' => $_GET['status'] ?? ''
        ];

        [$courseRequests, $requestCount] = $this->courseRequestService->getAllCourseRequests($itemsPerPage, $offset);
        $totalCount = $this->courseRequestService->getCount();
        $pagination = generatePagination($requestCount, $page, $itemsPerPage, $searchParams);
        echo $this->view->render("User/Admin/admin_post_managment.php", [
            "title" => "Post Managment",
            "posts" => $courseRequests,
            "totalCount" => $totalCount,
            "pagination" => $pagination
        ]);
    }
    public function adManagment()
    {

        if (!empty($_SESSION['user']) && $_SESSION['user_role'] == "admin") {
            $advertisements = $this->advertisementService->getAdvertisements();
            $path = "User/Admin/admin_ad_managment.php";
        } elseif (!empty($_SESSION['user']) && $_SESSION['user_role'] == "teacher") {
            $advertisements = $this->advertisementService->getTeacherAdvertisements((string)$_SESSION['user']);
            $path = "User/Tutor/teacher_ad_managment.php";
        }

        echo $this->view->render($path, [
            "title" => "Ad Managment",
            "advertisements" => $advertisements
        ]);
    }
    public function withdrawalManagment()
    {
        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 6;
        $offset = ($page - 1) * $itemsPerPage;

        $searchParams = [
            's' => $_GET['s'] ?? '',
            'status' => $_GET['status'] ?? 'all',
            'date' => $_GET['date'] ?? 'all',
        ];

        [$withdrawalHistory, $count] = $this->paymentService->getWithdrawalHistory(
            $itemsPerPage,
            $offset
        );
        $pagination = generatePagination($count, $page, $itemsPerPage, $searchParams);
        echo $this->view->render("User/Admin/admin_withdrawal_managment.php", [
            "title" => "Ad Managment",
            "withdrawalHistory" => $withdrawalHistory,
            "pagination" => $pagination
        ]);
    }

    public function completeWithdrawal(array $params)
    {
        try {
            $this->paymentService->completeWithdraw((string)$params['withdrawal_id'], (string)$_POST['user']);

            $data = [
                "success" => true,
                "message" => "Successfully complete the withdraw"
            ];
        } catch (Exception $e) {
            error_log("Error completing withdraw: " . $e->getMessage());
            $data = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        echo json_encode($data);
    }

    public function cancelWithdrawal(array $params)
    {
        try {
            $this->paymentService->cancelWithdrawal((string)$params['withdrawal_id'], (string)$_POST['user']);

            $data = [
                "success" => true,
                "message" => "Successfully cancel the withdraw"
            ];
        } catch (Exception $e) {
            error_log("Error canceling withdraw: " . $e->getMessage());
            $data = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        echo json_encode($data);
    }

    public function revenueReportView()
    {
        $startDate = $_GET['start'];
        $endDate = $_GET['end'];
        [$totalAdRevenue, $totalWithdrawalRevenue] = $this->paymentService->getTotalRevenue((string)$startDate, (string)$endDate);

        $totalAdRevenue = (float)$totalAdRevenue;
        $totalWithdrawalRevenue = (float)$totalWithdrawalRevenue;

        $totalRevenue = $totalAdRevenue + $totalWithdrawalRevenue;

        if ($totalAdRevenue) {
            $totalAdRevenue = round($totalAdRevenue, 2);
            $adRevenueRate = round(($totalAdRevenue / $totalRevenue) * 100);
        }

        if ($totalWithdrawalRevenue) {
            $totalWithdrawalRevenue = round($totalWithdrawalRevenue, 2);
            $WithdrawalRevenueRate = round(($totalWithdrawalRevenue / $totalRevenue) * 100);
        }



        echo $this->view->render(
            'User/Admin/revenue_report.php',
            [
                'title' => "Revenue Report",
                'totalAdRevenue' => $totalAdRevenue ?? 0,
                'totalWithdrawalRevenue' => $totalWithdrawalRevenue ?? 0,
                'totalRevenue' => $totalRevenue ?? 0,
                'adRevenueRate' => $adRevenueRate ?? 0,
                'WithdrawalRevenueRate' => $WithdrawalRevenueRate ?? 0

            ]
        );
    }


    // public function profile()
    // {
    //     $userDetails = $this->userService->getUserProfile();
    //     $userReview = $this->reviewService->getUserReview();
    //     [$courses, $courseCount] = $this->courseService->searchCourse(3, 0);
    //     echo $this->view->render('User/profile.php', [
    //         // "title" => "Profile",
    //         "userDetails" => $userDetails,
    //         "userReview" => $userReview,
    //         "courses" => $courses
    //     ]);
    // }

    public function tutorProfile($params)
    {
        $subjects = $this->subjectService->getSubjects();
        $tutorBasic = $this->userService->getTutorbasic($params['tutor-id']);
        $tutorSubjects = $this->userService->getTutorSubjects($params['tutor-id']);
        $tutorEducations = $this->userService->getTutorEducations($params['tutor-id']);
        $tutorAvailablities = $this->userService->getTutorAvailability($params['tutor-id']);
        $userReview = $this->reviewService->getTutorReview($params['tutor-id'], '0');
        $tutorDetails = $this->userService->getTutorProfile($params['tutor-id']);
        $courses = $this->courseService->getTutorcourses($params['tutor-id']);
        $totalReviews = count($userReview);
        $starCount = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $totalRating = 0;
        foreach ($userReview as $review) {
            $totalRating += $review['rating'];
            $starCount[$review['rating']]++;
        }
        $avgRating = $totalReviews > 0 ? ($totalRating / $totalReviews) : 0;
        $summeryOfReviews = ['totalReviews' => $totalReviews, 'avgRating' => $avgRating, 'starCount' => $starCount];

        // dd($courses);
        echo $this->view->render('User/Tutor/tutorProfile.php', [
            "title" => "Tutor",
            "tutorDetails" => $tutorDetails,
            'subjects' => $subjects,
            'tutorBasic' => $tutorBasic,
            'tutorSubjects' => $tutorSubjects,
            'tutorEducations' => $tutorEducations,
            'tutorAvailablities' => $tutorAvailablities,
            "userReview" => $userReview,
            'summeryOfReviews' => $summeryOfReviews,
            "courses" => $courses,
        ]);
    }
    public function test()
    {

        echo $this->view->render("test.php", [
            "title" => "Post Managment"
        ]);
    }
}
