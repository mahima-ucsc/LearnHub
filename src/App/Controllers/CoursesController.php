<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, CourseService, UserService};

class CoursesController
{

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private CourseService $courseService,
        private UserService $userService
    ) {}


    // Search courses
    public function course()
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 6;
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

        echo $this->view->render('course/Courses.php', [
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
    }


    public function enrollCourse()
    {
        echo $this->view->render('course/CourseEnroll.php', [
            "title" => "Enroll"
        ]);
    }

    public function courseInfo(array $params)
    {
        $course = $this->courseService->getCourse($params['course_id']);
        $user = $this->userService->getUserProfile();

        if (!$course) {
            redirectTo('/courses/my-courses');
        }


        echo $this->view->render(
            'course/CourseInfo.php',
            [
                'course' => $course,
                'title' => $course['title'],
                'user' => $user
            ]
        );
    }

    public function createCourseView()
    {

        echo $this->view->render('course/CreateCourse.php', [
            "title" => "Create Course"
        ]);
    }

    public function createCourse()
    {
        $this->validatorService->validateCourse($_POST);
        $this->courseService->create($_POST);
        redirectTo('/courses/my-courses');
    }

    public function myCourses()
    {
        $url = $_SESSION['user_role'] === 'teacher' ? 'Tutor/my_courses.php' : 'User/user_courses.php';
        $myCourses = $this->courseService->getMyCourses();
        echo $this->view->render($url, [
            "title" => "My Courses",
            "myCourses" => $myCourses
        ]);
    }

    public function courseEditView(array $params)
    {
        $course = $this->courseService->getCourse($params['course']);

        if (!$course) {
            redirectTo('/courses/my-courses');
        }

        echo $this->view->render(
            'course/edit_course.php',
            [
                'course' => $course,
                'title' => "Edit Course"
            ]
        );
    }

    public function editCourse(array $params)
    {
        $course = $this->courseService->getCourse($params['course']);

        if (!$course) {
            redirectTo('/courses/my-courses');
        }
        $this->validatorService->validateCourse($_POST);
        $this->courseService->update($_POST, (int)$params['course']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function deleteCourse(array $params)
    {
        $this->courseService->delete((int)$params['course']);
        redirectTo('/courses/my-courses');
    }

    public function courseParticipant()
    {
        $users = $this->userService->getAllUsers();
        echo $this->view->render('course/course_participant.php', [
            "title" => "Create Course",
            'users' => $users
        ]);
    }

    public function courseParticipantStat()
    {
        echo $this->view->render(
            "course/user_course_stats.php",
            [
                'title' => "Stats"
            ]
        );
    }
    public function singleCourses(array $params)
    {
        echo $this->view->render(
            "course/single_course.php",
            [
                'title' => "ICT 2024 A/L"
            ]
        );
    }
    public function regCourses()
    {
        $reviews = $this->courseService->getReviews();
        echo $this->view->render(
            "course/demo_registered_course.php",
            [
                'title' => "ICT 2024 A/L"
            ]
        );
    }
    public function userCourses()
    {
        echo $this->view->render(
            "User/user_courses.php",
            [
                'title' => "ICT 2024 A/L"
            ]
        );
    }
}
