<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{AssignmentService, ValidatorService, CourseService, UserService, FileService, SubjectService};
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
        $attendance = $this->courseService->userAttendance($_SESSION['user']);
        $attendanceData = [];
        foreach ($attendance as $a) {
            $attendanceData[$a['module_id']] = $a['is_attended'];
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
                'moduleResources' => $moduleResources,
                'userReview' => $userReview,
                'summeryOfReviews' => $summeryOfReviews,
                'participantCount' => $participantCount,
                "isParticipant" => $isParticipant,
                "attendanceData" => $attendanceData

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
        // TODO: Get Payment status
        $isParticipant = false;
        if ($_SESSION['user_role'] == 'student') {
            $courses = $this->courseService->getStudentCourses((string)$_SESSION['user']);
            foreach ($courses as $course) {
                if ($course['course_id'] == $params['course_id']) {
                    $isParticipant = true;
                    break;
                }
            }
            if (!$isParticipant) {
                redirectTo('/unauthorized-access');
            }
        }
        $students = $this->courseService->getCourseParticipants($params['course_id']);
        $studentCount = count($students);
        echo $this->view->render(
            "course/course_participants.php",
            [
                'students' => $students,
                'title' => "Course Participants",
                'isParticipant' => $isParticipant,
                'stdCount' => $studentCount
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
        try {
            // Upload course thumbnail
            $courseThumbnail = $_FILES['courseThumbnail'] ?? null;
            $this->validatorService->validateImg($courseThumbnail);
            $thumbnailFileName = $this->fileService->uploadFile(Paths::RELATIVE_COURSE_THUMBNAIL_UPLOADS, $courseThumbnail);

            // Process module attachments
            $moduleAttachments = [];
            if (isset($_FILES['modules']['name'][0]['attachments'])) {
                foreach ($_FILES['modules']['name'][0]['attachments'] as $index => $filename) {
                    if (!empty($filename)) {
                        $moduleAttachments[] = [
                            'name' => $_FILES['modules']['name'][0]['attachments'][$index],
                            'type' => $_FILES['modules']['type'][0]['attachments'][$index],
                            'tmp_name' => $_FILES['modules']['tmp_name'][0]['attachments'][$index],
                            'error' => $_FILES['modules']['error'][0]['attachments'][$index],
                            'size' => $_FILES['modules']['size'][0]['attachments'][$index]
                        ];
                    }
                }
            }

            // Prepare modules data
            $modulesData = [];
            if (isset($_POST['modules']) && is_array($_POST['modules'])) {
                foreach ($_POST['modules'] as $index => $module) {
                    $moduleData = [
                        'title' => $module['title'],
                        'description' => $module['description'],
                        'price' => floatval($module['price']),
                        'start_date' => $module['moduleStartTime'],
                        'end_date' => $module['moduleEndTime'],
                        'has_free_trial' => isset($module['hasFreeTrial']) && $module['hasFreeTrial'] === 'on',
                        'free_trial_start_date' => $module['freeTrialStartDate'] ?? null,
                        'free_trial_end_date' => $module['freeTrialEndDate'] ?? null,
                        'duration_minutes' => (isset($module['hours']) ? intval($module['hours']) * 60 : 0) +
                            (isset($module['minutes']) ? intval($module['minutes']) : 0),
                        'attachments' => $moduleAttachments
                    ];

                    $modulesData[] = $moduleData;
                }
            }


            // Prepare course data
            $courseData = [
                'title' => $_POST['courseTitle'],
                'description' => $_POST['courseDescription'],
                'subject_id' => intval($_POST['subject']),
                'grade_id' => intval($_POST['grade']),
                'tutor_id' => 1,
                'start_time' => $_POST['courseStartTime'],
                'end_time' => $_POST['courseEndTime'],
                'day' => $_POST['courseday'],
                'billing_type' => $_POST['courseType'],
                'price' => isset($_POST['fullCoursePrice']) ? floatval($_POST['fullCoursePrice']) : null,
                'location' => $_POST['location'],
                'thumbnail_url' => $thumbnailFileName,
                'modules' => $modulesData
            ];

            // Create the course with modules
            $courseId = $this->courseService->createCourseWithModules($courseData, $_FILES);

            // Redirect to my courses page
            if ($courseId) {
                echo json_encode("Success");
            } else {
                // Handle error
                echo json_encode("Error");
                // redirectTo('/courses/create?error=failed');
            }
        } catch (ValidationException $e) {
            // Handle validation errors
            // redirectTo('/courses/create');
        } catch (Exception $e) {
            // Handle general errors
            error_log('Course creation failed: ' . $e->getMessage());
            $_SESSION['error'] = 'Failed to create course. Please try again.';
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

        $course = $this->courseService->getCourseById($params['course_id']);
        if (!$course) {
            redirectTo('/server-error');
            exit;
        }

        $this->courseService->update($course, $_POST, (int)$params['course_id']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function getTeacherCourses()
    {
        $teacherId =  $_SESSION['user'];
        return $this->courseService->getTeacherCourses($teacherId);
    }

    public function createModuleView(array $params)
    {
        $courseId = $params['course_id'];
        echo $this->view->render('/course/create_module.php', [
            "title" => "Create Module"
        ]);
    }
    public function createModule(array $params)
    {
        $courseId = $params['course_id'];
        $course = $this->courseService->getCourseById($courseId);
        $type = $course['billing_type'];
        // Process module attachments
        $moduleAttachments = [];
        if (isset($_FILES['modules']['name'][0]['attachments'])) {
            foreach ($_FILES['modules']['name'][0]['attachments'] as $index => $filename) {
                if (!empty($filename)) {
                    $moduleAttachments[] = [
                        'name' => $_FILES['modules']['name'][0]['attachments'][$index],
                        'type' => $_FILES['modules']['type'][0]['attachments'][$index],
                        'tmp_name' => $_FILES['modules']['tmp_name'][0]['attachments'][$index],
                        'error' => $_FILES['modules']['error'][0]['attachments'][$index],
                        'size' => $_FILES['modules']['size'][0]['attachments'][$index]
                    ];
                }
            }
        }
        // Prepare modules data
        $modulesData = [];
        if (isset($_POST['modules']) && is_array($_POST['modules'])) {
            foreach ($_POST['modules'] as $index => $module) {
                $moduleData = [
                    'title' => $module['title'],
                    'description' => $module['description'],
                    'price' => floatval($module['price']),
                    'start_date' => $module['moduleStartTime'],
                    'end_date' => $module['moduleEndTime'],
                    'has_free_trial' => isset($module['hasFreeTrial']) && $module['hasFreeTrial'] === 'on',
                    'free_trial_start_date' => $module['freeTrialStartDate'] ?? null,
                    'free_trial_end_date' => $module['freeTrialEndDate'] ?? null,
                    'duration_minutes' => (isset($module['hours']) ? intval($module['hours']) * 60 : 0) +
                        (isset($module['minutes']) ? intval($module['minutes']) : 0),
                    'attachments' => $moduleAttachments
                ];

                $modulesData[] = $moduleData;
            }
        }
        $this->courseService->createModule($courseId, $type, $modulesData, 1);
        echo json_encode($modulesData);
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
}
