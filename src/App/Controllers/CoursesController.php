<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, CourseService, UserService, FileService};
use App\Config\Paths;

class CoursesController
{

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private CourseService $courseService,
        private UserService $userService,
        private FileService $fileService
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
        $course = $this->courseService->getByCourseId($params['course_id']);
        if (!$course) {
            redirectTo('/courses/my-courses');
        }
        $courseModules = $this->courseService->getCourseModules($params['course_id']);

        $user = $this->userService->getUserProfile($course['tutor_id']);



        echo $this->view->render(
            'course/course_info.php',
            [
                'course' => $course,
                'title' => $course['title'],
                'user' => $user,
                'modules' => $courseModules
            ]
        );
    }

    public function createCourseView()
    {

        echo $this->view->render('course/create_course.php', [
            "title" => "Create Course"
        ]);
    }

    // Save course data in SESSION and redirect to next page to add course module
    public function saveCourseData()
    {
        $thumbnail = $_FILES['thumbnail'] ?? null;
        $this->validatorService->validateImg($thumbnail);
        $this->fileService->upload("courses", $thumbnail); // Save image temporary

        $_SESSION['courseData'] = $_POST;
        redirectTo('/course/create/add-module');
    }

    public function addModuleView()
    {
        echo $this->view->render('course/add_course_module.php', [
            "title" => "Add Course Module"
        ]);
    }

    public function createCourse()
    {
        $this->courseService->create($_POST['modules']);
        redirectTo('/courses/my-courses');
    }

    public function myCourses()
    {
        $url = $_SESSION['user_role'] === 'teacher' ? 'Tutor/my_courses.php' : 'User/user_courses.php';
        if ($_SESSION['user_role'] == 'student') {
            $courses = $this->courseService->registeredCourses();
        } else if ($_SESSION['user_role'] == 'teacher') {
            $courses = $this->courseService->getMyCourses();
        }
        echo $this->view->render($url, [
            "title" => "My Courses",
            "courses" => $courses
        ]);
    }

    public function courseEditView(array $params)
    {
        $course = $this->courseService->getMyCourseById($params['course']);

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
        $course = $this->courseService->getMyCourseById($params['course']);

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

    public function courseParticipantStat()
    {
        echo $this->view->render(
            "course/user_course_stats.php",
            [
                'title' => "Stats"
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

    public function successMessage()
    {
        echo $this->view->render(
            "course/success.php",
            [
                'title' => "Course Create Successfully"
            ]
        );
    }

    public function courseParticipant(array $params)
    {
        $students = $this->courseService->getCourseParticipants($params['course_id']);
        echo $this->view->render(
            "course/course_participants.php",
            [
                'students' => $students,
                'title' => "Course Participants",
            ]
        );
    }

    public function RemoveCourseParticipant(array $params)
    {
        $this->courseService->RemoveParticipant($params['course_id'], $params['user_id']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function AddParticipant(array $params)
    {
        $this->courseService->AddParticipant($params['course_id'], $_POST['email']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }
}
