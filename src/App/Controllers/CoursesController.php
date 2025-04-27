<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{AssignmentService, ValidatorService, CourseService, UserService, FileService, SubjectService, ReviewService, PaymentService};
use App\Config\Paths;
use Exception;
use Framework\Exceptions\ValidationException;


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
        private ReviewService $reviewService,
        private PaymentService $paymentService
    ) {}


    // Search courses
    public function course()
    {
        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 9;
        $offset = ($page - 1) * $itemsPerPage;

        // Get search parameters
        $searchParams = [
            's' => $_GET['s'] ?? '',
            'location' => $_GET['location'] ?? null,
            'subject' => $_GET['subject'] ?? 'all',
            'type' => $_GET['type'] ?? 'all',
            'price' => $_GET['price'] ?? 'all',
            'sort' => $_GET['sort'] ?? '',
        ];

        [$courses, $courseCount] = $this->courseService->searchCourse(
            $itemsPerPage,
            $offset
        );

        $courseLocations = $this->courseService->getLocations();
        $subjects = $this->subjectService->getSubjects();

        $pagination = generatePagination($courseCount, $page, $itemsPerPage, $searchParams);


        echo $this->view->render('course/Courses.php', [
            "title" => "Search Course",
            "courses" => $courses,
            "courseLocations" => $courseLocations,
            "courseCount" => $courseCount,
            "subjects" => $subjects,
            'pagination' => $pagination
        ]);
    }

    public function courseInfo(array $params)
    {
        $course = $this->courseService->getCourseById($params['course_id']);
        $participants = $this->courseService->getCourseParticipants((string) $params['course_id']);
        $participantCount = count($participants);

        // Get user_ids of the students registered to the course 
        $participantIds = [];
        for ($i = 0; $i < $participantCount; $i++) {
            $participantIds[$i] = $participants[$i]['user_id'];
        }

        // Check whether the current user is a participant of the course
        $isParticipant = in_array($_SESSION['user'], $participantIds);

        // Get user attendance
        if (!empty($_SESSION['user']) && $isParticipant) {
            $attendance = $this->courseService->userAttendance((int)$_SESSION['user']);
            $attendanceData = [];
            foreach ($attendance as $a) {
                $attendanceData[$a['module_id']] = $a['is_attended'];
            }
        }


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
            // Get module resources based on module ID
            $moduleResources = [];
            foreach ($courseModules as $module) {
                $resources = $this->courseService->courseResourceList($module['course_id'], $module['module_id']);
                $moduleResources[$module['module_id']] = $resources;
            }
        } else {
            $content = $this->courseService->getCurrentContentAndPastContent($params['course_id']);
            $currentContent = $content['currentContent'];
            $pastContent = $content['pastContent'];
            // Get module resources based on module ID
            $allContent = $currentContent + $pastContent;
            $moduleResources = [];
            foreach ($allContent as $contentModule) {
                $resources = $this->courseService->courseResourceList((int)$contentModule['course_id'], (int)$contentModule['modules'][0]['module_id']);
                $moduleResources[$contentModule['modules'][0]['module_id']] = $resources;
            }
        }

        $assignments = $this->assignmentService->getAssignmentByCourse($params['course_id']);

        // Get module resources based on module ID
        $assignmentsResources = [];
        foreach ($assignments as $assignment) {
            $resources = $this->assignmentService->getAssignmentResource($assignment['assignment_id']);
            $assignmentsResources[$assignment['assignment_id']] = $resources;
        }

        // get course reviews
        $userReview = [];
        $userReview = $this->reviewService->getCourseReview($params['course_id'], '0');
        //calculate summery of reviews
        $summeryOfReviews = $this->reviewService->getSummeryOfReview($params['course_id']);
        // get tutor profile
        $user = $this->userService->getUserDetailsById((string)$course['tutor_id']);
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
                'moduleResources' => $moduleResources,
                'userReview' => $userReview,
                'summeryOfReviews' => $summeryOfReviews,
                'participantCount' => $participantCount,
                "isParticipant" => $isParticipant,
                "attendanceData" => $attendanceData ?? []

            ]
        );
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




    public function deleteCourse(array $params)
    {
        $this->courseService->delete((int)$params['course']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function courseParticipantStat(array $params)
    {
        $studentId = (string)$params['participant_id'];
        $courseId = (string)$params['course_id'];

        $courseAssignments = $this->assignmentService->getAssignmentByCourse($courseId);
        $totalAssignments = count($courseAssignments);
        if ($totalAssignments > 0) {
            $studentSubmissions = $this->assignmentService->getStudentAssignmentSubmissionsByCourse($studentId, $courseId);
        }

        $totalModules = count($this->courseService->getCourseModuleList($courseId));
        $attendance = $this->courseService->getStudentAttendanceCountForCourse($studentId, $courseId);
        $user = $this->userService->getUserDetailsById($studentId);
        echo $this->view->render(
            "course/user_course_stats.php",
            [
                'title' => "Stats",
                "studentSubmissions" => $studentSubmissions ?? [],
                "user" => $user,
                "totalAssignments" => $totalAssignments,
                "totalModules" => $totalModules ?? 0,
                "attendance" => $attendance ?? 0
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
        $isParticipant = false;
        $isTeacher = false;
        if ($_SESSION['user_role'] == 'student') {
            $courses = $this->courseService->getStudentCourses((string)$_SESSION['user']);
            foreach ($courses as $course) {
                if ($course['course_id'] == $params['course_id']) {
                    $isParticipant = true;
                    break;
                }
            }
        }

        $course = $this->courseService->getCourseById((string)$params['course_id']);
        if ($course['tutor_id'] == $_SESSION['user']) {
            $isTeacher = true;
        }
        if (!$isParticipant && !$isTeacher) {
            redirectTo('/unauthorized-access');
        }

        $course = $this->courseService->getCourseById((string)$params['course_id']);

        $students = $this->courseService->getCourseParticipants($params['course_id']);
        $studentCount = count($students);
        echo $this->view->render(
            "course/course_participants.php",
            [
                'students' => $students,
                'title' => "Course Participants",
                'isParticipant' => $isParticipant,
                'stdCount' => $studentCount,
                "isTeacher" => $isTeacher
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

    // New functions after update the table
    public function createView()
    {
        $subjects = $this->subjectService->getSubjects();
        $grades = $this->courseService->getGrades();
        echo $this->view->render(
            'course/create.php',
            [
                'title' => "Create Course",
                'subjects' => $subjects,
                'grades' => $grades
            ]
        );
    }

    public function create()
    {

        $this->validatorService->validateCourseWithImage($_POST, $_FILES['courseThumbnail']);

        // Upload course thumbnail
        $courseThumbnail = $_FILES['courseThumbnail'];
        $thumbnailFileName = $this->fileService->uploadFile(Paths::RELATIVE_COURSE_THUMBNAIL_UPLOADS, $courseThumbnail);
        // Prepare course data

        $courseData = [
            'title' => $_POST['courseTitle'],
            'description' => $_POST['courseDescription'],
            'subject_id' => intval($_POST['subject']),
            'grade_id' => intval($_POST['grade']),
            'tutor_id' => $_SESSION['user'],
            'start_time' => $_POST['courseStartTime'],
            'end_time' => $_POST['courseEndTime'],
            'day' => $_POST['courseday'],
            'billing_type' => $_POST['courseType'],
            'price' => isset($_POST['fullCoursePrice']) ? floatval($_POST['fullCoursePrice']) : null,
            'location' => $_POST['location'],
            'thumbnail_url' => $thumbnailFileName,
        ];

        $courseId = $this->courseService->createCourse($courseData, $_FILES);
        if ($courseId) {
            redirectTo("/courses/" . $courseId);
        }
    }

    public function courseEditView(array $params)
    {
        $course = $this->courseService->getCourseById($params['course_id']);
        $subjects = $this->subjectService->getSubjects();
        $grades = $this->courseService->getGrades();

        if (!$course) {
            redirectTo('/error');
        }

        echo $this->view->render(
            'course/edit_course.php',
            [
                'title' => "Edit Course",
                'course' => $course,
                'subjects' => $subjects,
                'grades' => $grades
            ]
        );
    }

    public function editCourse(array $params)
    {

        $this->validatorService->validateCourseData($_POST);
        $course = $this->courseService->getCourseById($params['course_id']);
        if (!$course) {
            redirectTo('/server-error');
            exit;
        }

        $this->courseService->update($course, $_POST, (int)$params['course_id']);
        redirectTo("/courses/{$params['course_id']}");
    }

    public function getTeacherCourses()
    {
        $teacherId =  $_SESSION['user'];
        return $this->courseService->getTeacherCourses((int)$teacherId);
    }

    public function createModuleView(array $params)
    {
        $courseId = $params['course_id'];
        $course = $this->courseService->getCourseById((string)$courseId);
        if ($course['billing_type'] == "recurring") {
            $courseSubPeriods = $this->courseService->getRecurringCourseSubPeriods((string)$courseId);
        }
        echo $this->view->render('/course/create_module.php', [
            "title" => "Create Module",
            "course" => $course,
            "courseSubPeriods" => $courseSubPeriods ?? []
        ]);
    }
    public function createModule(array $params)
    {

        $this->validatorService->validateModuleData($_POST);

        $courseId = $params['course_id'];
        $course = $this->courseService->getCourseById($courseId);
        $type = $course['billing_type'];

        // Process module attachments
        $moduleAttachments = [];
        if (isset($_FILES['moduleAttachments']['name'])) {
            foreach ($_FILES['moduleAttachments']['name'] as $index => $filename) {
                if (!empty($filename)) {
                    $moduleAttachments[] = [
                        'name' => $_FILES['moduleAttachments']['name'][$index],
                        'type' => $_FILES['moduleAttachments']['type'][$index],
                        'tmp_name' => $_FILES['moduleAttachments']['tmp_name'][$index],
                        'error' => $_FILES['moduleAttachments']['error'][$index],
                        'size' => $_FILES['moduleAttachments']['size'][$index]
                    ];
                }
            }
        }
        // Prepare modules data
        $moduleData = $_POST;
        $moduleData['attachments'] = $moduleAttachments;

        $moduleId = $this->courseService->createModule($courseId, $type, $moduleData);
        if ($moduleId) {
            $this->modleSuccessMessage($moduleId, $courseId);
        }
    }
    public function modleSuccessMessage(string $moduleId, string $courseId)
    {
        echo $this->view->render(
            "course/module_success.php",
            [
                'title' => "Course Create Successfully",
                'moduleId' => $moduleId,
                "courseId" => $courseId
            ]
        );
    }

    public function deleteCourseModule(array $params)
    {
        $this->courseService->deleteModule($params['course_id'], $params['module_id']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function markAttendance()
    {
        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $this->courseService->markAttendance($data);
            $result = [
                "success" => true,
                "message" => "Attendance marked successfully",
                "receivedData" => $data
            ];
        } catch (Exception $e) {
            $result = [
                "success" => false,
                "message" => $e->getMessage(),
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }

    public function userCourses()
    {
        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 9;
        $offset = ($page - 1) * $itemsPerPage;

        // Get search parameters
        $searchParams = [
            's' => $_GET['s'] ?? '',
        ];

        // if (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'teacher') {
        //     if ($_SESSION['user_role'] === 'teacher') {
        //         $courses = $this->courseService->getTutorcourses((string)$_SESSION['user']);

        //         $courseCount = count($courses);
        //     }
        // }


        if (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'teacher') {
            if ($_SESSION['user_role'] === 'teacher') {
                $courses = $this->courseService->getTeacherCourses($_SESSION['user'], $itemsPerPage, $offset);
                $courseCount = count($courses);
            }
        } elseif (!empty($_SESSION['user']) && $_SESSION['user_role'] == 'student') {

            [$courses, $courseCount] = $this->courseService->getUserCourses(
                $itemsPerPage,
                $offset
            );
        }

        $pagination = generatePagination($courseCount, $page, $itemsPerPage, $searchParams);


        echo $this->view->render('User/user_courses.php', [
            "title" => "Search Course",
            "courses" => $courses,
            "courseCount" => $courseCount,
            'pagination' => $pagination
        ]);
    }
}
