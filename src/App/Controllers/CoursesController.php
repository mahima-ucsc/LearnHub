<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{AssignmentService, ValidatorService, CourseService, UserService, FileService, SubjectService};
use App\Config\Paths;

class CoursesController
{

    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private CourseService $courseService,
        private UserService $userService,
        private FileService $fileService,
        private AssignmentService $assignmentService,
        private SubjectService $subjectService,
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
        $course = $this->courseService->getCourseById($params['course_id']);
        /**
         * 'isPaid' property based on the course type:
         * - For one-time courses: Boolean value (true or false)
         * - For recurring courses: Null value
         */

        if (!$course) {
            redirectTo('/courses/my-courses');
        }
        if ($course['billing_type'] === 'onetime') {
            $courseModules = $this->courseService->getCourseModuleList($params['course_id']);
        } else {
            $content = $this->courseService->getCurrentContentAndPastContent($params['course_id']);
            $currentContent = $content['currentContent'];
            $pastContent = $content['pastContent'];
        }

        // TODO: Fetch module resources based on the updated database schema and course flow.
        // Get module resources based on module ID
        // $moduleResources = [];
        // foreach ($courseModules as $module) {
        //     $resources = $this->courseService->courseResourceList($module['course_id'], $module['module_id']);
        //     $moduleResources[$module['module_id']] = $resources;
        // }
        $assignments = $this->assignmentService->getAssignmentByCourse($params['course_id']);

        // Get module resources based on module ID
        $assignmentsResources = [];
        foreach ($assignments as $assignment) {
            $resources = $this->assignmentService->getAssignmentResource($assignment['assignment_id']);
            $assignmentsResources[$assignment['assignment_id']] = $resources;
        }

        // get course reviews
        $userReview = [];
        $userReview = $this->courseService->getReviewForcourse($params['course_id']);

        //calculate summery of reviews
        $summeryOfReviews = [];
        $totalReviews = count($userReview);
        $starCount = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
        $totalRating = 0;
        foreach ($userReview as $review) {
            $totalRating += $review['rating'];
            $starCount[$review['rating']]++;
        }
        $avgRating = $totalReviews > 0 ? ($totalRating / $totalReviews) : 0;
        $summeryOfReviews = ['totalReviews' => $totalReviews, 'avgRating' => $avgRating, 'starCount' => $starCount];

        // get tutor profile
        $user = $this->userService->getUserProfile($course['tutor_id']);

        echo $this->view->render(
            'course/course-info/course-info.php',
            [
                'course' => $course,
                'title' => $course['title'],
                'user' => $user,
                'modules' => $courseModules ?? [],
                'currentContent' => $currentContent ?? [],
                'pastContent' => $pastContent ?? [],
                'assignments' => $assignments,
                'assignmentsResources' => $assignmentsResources,
                // 'moduleResources' => $moduleResources,
                'userReview' => $userReview,
                'summeryOfReviews' => $summeryOfReviews

            ]
        );
    }

    public function createCourseView()
    {
        $subjects = $this->subjectService->getSubjects();
        echo $this->view->render('course/create_course.php', [
            "title" => "Create Course",
            "subjects" => $subjects
        ]);
    }

    /**
     * This function is used when creating a course. Initially, it saves the course data in the session 
     * and then redirects to the next page to add course modules. The add module view sends a POST request 
     * invoking the createCourse function to save both course data and course modules at the same time.
     * 
     * However, the new flow allows creating courses without modules. Modules can be added later.
     * 
     * @deprecated This function is deprecated due to the new flow that allows creating courses without modules.
     */
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

    /**
     * @deprecated
     * It was used to save both modules and course details at once when redirected from the add course view to the add modules view.
     */
    public function createCourse()
    {
        $this->courseService->create($_POST['modules'], $_FILES['modules']);
        redirectTo('/courses/my-courses');
    }

    // TODO: Rename this function when the old create course is removed
    public function createCourseNew()
    {
        $thumbnail = $_FILES['thumbnail'] ?? null;
        $this->validatorService->validateImg($thumbnail);
        $this->validatorService->validateCourse($_POST);
        $thumbnailFileName = $this->fileService->uploadFile(Paths::RELATIVE_COURSE_THUMBNAIL_UPLOADS, $thumbnail);
        $formData = $_POST;
        $formData['thumbnail_filename'] = $thumbnailFileName;
        $this->courseService->createCourse($formData);
        redirectTo('/courses/my-courses');
    }

    // Dont use for anything
    // Left for Rollback
    public function myCoursesOld()
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
    public function myCourses()
    {
        $url = $_SESSION['user_role'] === 'teacher' ? 'Tutor/my_courses.php' : 'User/student/registered_courses.php';

        if ($_SESSION['user_role'] == 'student') {
            [$courses, $pinnedCourses] = $this->courseService->registeredCourses();
        } else if ($_SESSION['user_role'] == 'teacher') {
            $courses = $this->courseService->getMyCourses();
        }


        echo $this->view->render($url, [
            "title" => "My Courses",
            "courses" => $courses,
            "pinnedCourses" => $pinnedCourses ?? []
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
        redirectTo($_SERVER['HTTP_REFERER']);
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

    public function pinCourse()
    {
        $requestBody = file_get_contents('php://input');
        $data = json_decode($requestBody, true);
        $courses = $this->courseService->registeredCourses();
        echo json_encode([
            'success' => true,
            'pinnedCourses' => $courses,
        ]);
    }

    public function readModuleResources(array $params)
    {
        $module = $this->courseService->getCourseModule($params['course_id'], $params['module_id']);
        if (empty($module)) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }

        $resource = $this->courseService->moduleResource($params['resource_id']);
        if (empty($resource)) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }

        if ($resource['module_id'] !== $module['module_id']) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }

        $this->courseService->readResource($resource);
    }

    public function myCoursesTest()
    {
        echo $this->view->render(
            "course/test.php",
            [
                'title' => "Course Participants",
            ]
        );
    }
}
