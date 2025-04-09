<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Framework\Database;
use App\Config\Paths;
use Framework\Exceptions\ValidationException;

class CourseService
{
    public function __construct(private Database $db) {}

    /**
     * @deprecated
     * This function is deprecated.
     * It was used to save both modules and course details at once when redirected from the add course view to the add modules view.
     */
    public function create(array $formData, array $files)
    {
        $this->db->beginTransaction();
        try {

            $tutor_id = $_SESSION['user'];
            $courseData = $_SESSION['courseData'];
            $thumbnailUrl = $_SESSION['thumbnail'];


            $this->db->query(
                "INSERT INTO courses(title, description, subject_id, grade_id, tutor_id, start_time, end_time, day, price, pricing_period, location, thumbnail_url)
                    VALUES (:title, :description, :subject_id, :grade_id, :tutor_id, :start_time, :end_time, :day, :price, :pricing_period, :location, :thumbnail_url)",
                [
                    "title" => $courseData['title'],
                    "description" => $courseData['description'],
                    "subject_id" => $courseData['subject_id'],
                    "grade_id" => $courseData['grade_id'],
                    "tutor_id" => $tutor_id,
                    "start_time" => $courseData['start_time'],
                    "end_time" => $courseData['end_time'],
                    "day" => $courseData['day'],
                    "price" => $courseData['price'],
                    "pricing_period" => $courseData['pricing_period'],
                    "location" => $courseData['location'],
                    "thumbnail_url" => $thumbnailUrl
                ]
            );
            $courseID = $this->db->lastInsertId();
            foreach ($formData as $index => $module) {
                $this->db->query(
                    "INSERT INTO course_modules(course_id, description, title)
                        VALUES (:courseID, :description, :title)",
                    [
                        "courseID" => $courseID,
                        "description" => $module['description'],
                        "title" => $module['title']
                    ]
                );
                $moduleId = $this->db->lastInsertId();

                if (isset($files['name'][$index]['resources'])) {
                    foreach ($files['name'][$index]['resources'] as $key => $fileName) {
                        $file = [
                            'name'     => $files['name'][$index]['resources'][$key],
                            'tmp_name' => $files['tmp_name'][$index]['resources'][$key],
                            'error'    => $files['error'][$index]['resources'][$key],
                        ];

                        try {
                            // Call uploadFile function for each file
                            $newFileName = $this->uploadFile($file, 'course_module_resource');
                            $this->db->query(
                                "INSERT INTO course_module_resource(module_id, course_id, resource_path)
                                VALUES(:module_id, :course_id, :resource_path)",
                                [
                                    "module_id" => $moduleId,
                                    "course_id" => $courseID,
                                    "resource_path" => $newFileName
                                ]
                            );
                        } catch (ValidationException $e) {
                            throw new ValidationException([
                                "file" => [$e]
                            ]);
                        }
                    }
                }
            }
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }

        unset($_SESSION['courseData']);
        unset($_SESSION['thumbnail']);
    }

    public function createCourse(array $formData)
    {
        $tutor_id = $_SESSION['user'];

        $this->db->query(
            "INSERT INTO courses(title, description, subject_id, grade_id, tutor_id, start_time, end_time, day, price, pricing_period, location, thumbnail_url)
                VALUES (:title, :description, :subject_id, :grade_id, :tutor_id, :start_time, :end_time, :day, :price, :pricing_period, :location, :thumbnail_url)",
            [
                "title" => $formData['title'],
                "description" => $formData['description'],
                "subject_id" => $formData['subject_id'],
                "grade_id" => $formData['grade_id'],
                "tutor_id" => $tutor_id,
                "start_time" => $formData['start_time'],
                "end_time" => $formData['end_time'],
                "day" => $formData['day'],
                "price" => $formData['price'],
                "pricing_period" => $formData['pricing_period'],
                "location" => $formData['location'],
                "thumbnail_url" => $formData['thumbnail_filename'],
            ]
        );
    }

    public function getMyCourses()
    {
        $myCourses = $this->db->query(
            "SELECT * FROM courses
            WHERE tutor_id = :tutor_id",
            ['tutor_id' => $_SESSION['user']]
        )->findAll();

        return $myCourses;
    }
    public function getMyCourseById(string $id)
    {
        return $this->db->query(
            "SELECT * FROM courses
            WHERE course_id = :id",
            [
                'id' => $id
            ]
        )->find();
    }

    public function getCourseById(string $id)
    {
        $course =  $this->db->query(
            "SELECT * FROM courses
            WHERE course_id = :id",
            [
                'id' => $id
            ]
        )->find();

        $isPaid = null;
        if (isset($_SESSION['user']) && $course['billing_type'] == 'onetime') {
            $isPaid = $this->isOneTimeCoursePaid($_SESSION['user'], $id);
        }
        $course['is_paid'] = $isPaid;
        return $course;
    }

    public function getCourseModuleList(string $courseId)
    {
        return $this->db->query(
            "SELECT 
            CM.module_id, 
            CM.title, 
            CM.description, 
            CM.course_id, 
            GROUP_CONCAT(CMR.resource_id ORDER BY CMR.resource_id SEPARATOR ',') AS resource_ids,
            GROUP_CONCAT(CMR.resource_path ORDER BY CMR.resource_id SEPARATOR ',') AS resource_paths
            FROM course_modules CM
            LEFT JOIN course_module_resource CMR 
                ON CM.module_id = CMR.module_id
            WHERE CM.course_id = :id
            GROUP BY CM.module_id;
            ",
            [
                'id' => $courseId
            ]
        )->findAll();
    }

    private function getCourseSubPeriodsAndModules(string $courseId)
    {

        $subPeriods = $this->db->query(
            "SELECT * FROM recurring_course_sub_periods
                WHERE course_id = :id
                ORDER BY start_datetime",
            [
                'id' => $courseId
            ]
        )->findAll();

        foreach ($subPeriods as &$period) {
            // Check if the user has paid for the course
            $isPaid = null;

            if (isset($_SESSION['user'])) {
                $isPaid = $this->isReuccringCourseSubPeriodPaid($_SESSION['user'], $courseId, $period['sub_period_id']);
            }
            $period['is_paid'] = $isPaid;

            $currentDateTime = date('Y-m-d H:i:s');
            $freeAccessStartDateTime = $period['free_access_start_datetime'];
            $freeAccessEndDateTime = $period['free_access_end_datetime'];
            $isFreeAccessPeriod = $freeAccessStartDateTime <= $currentDateTime && $freeAccessEndDateTime >= $currentDateTime;
            $period['is_free_access_period'] = $isFreeAccessPeriod;

            // Set modules for each sub period only if paid or in free access period
            if ($isPaid || $isFreeAccessPeriod) {
                $subPeriodModules = $this->db->query(
                    "SELECT * FROM course_modules
                        WHERE sub_period_id = :sub_period_id",
                    [
                        'sub_period_id' => $period['sub_period_id']
                    ]
                )->findAll();
                $period['modules'] = $subPeriodModules;
            } else {
                $period['modules'] = [];
            }
        }

        return $subPeriods;
    }

    public function getCurrentContentAndPastContent(string $courseId)
    {
        $allContent = $this->getCourseSubPeriodsAndModules($courseId);
        $currentContent = [];
        $pastContent = [];

        $currentDateTime = date('Y-m-d H:i:s');

        foreach ($allContent as $period) {
            if ($period['start_datetime'] > $currentDateTime) {
                continue; // Skip future periods
            }
            if ($period['end_datetime'] > $currentDateTime) {
                $currentContent[] = $period;
            } else {
                $pastContent[] = $period;
            }
        }

        return [
            'currentContent' => $currentContent,
            'pastContent' => $pastContent
        ];
    }

    public function getCourseModule(string $courseId, string $moduleId)
    {
        return $this->db->query(
            "SELECT * FROM course_modules WHERE module_id = :module_id AND course_id = :course_id",
            [
                "module_id" => $moduleId,
                "course_id" => $courseId
            ]
        )->find();
    }

    public function courseResourceList(int $courseId, int $moduleId)
    {
        return $this->db->query(
            "SELECT * FROM  course_module_resource WHERE course_id = :course_id AND module_id = :module_id",
            [
                "course_id" => $courseId,
                "module_id" => $moduleId
            ]
        )->findAll();
    }
    public function moduleResource(string $resourceId)
    {
        return $this->db->query(
            "SELECT * FROM  course_module_resource WHERE resource_id = :resource_id",
            [
                "resource_id" => $resourceId
            ]
        )->find();
    }

    public function readResource(array $resource)
    {
        $filePath = Paths::STORAGE_UPLOADS . '/course_module_resource/' . $resource['resource_path'];
        if (!file_exists($filePath)) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }
        header("Content-Disposition: attachment;filename={$resource['resource_path']}");
        readfile($filePath);
    }


    // search courses by teacher or course title
    public function searchCourse(int $length = 6, int $offset = 0)
    {
        // Fetch the search term from the GET request
        $searchTerm = $_GET['s'] ?? '';
        $searchBy = $_GET['f'] ?? '';
        $Searchlocation = $_GET['location'] ?? '';
        $searchTerm = trim($searchTerm);
        $params = [
            "term" => "%{$searchTerm}%",
        ];

        $locationClause = '';
        if (!empty($Searchlocation)) {
            $params["Searchlocation"] = $Searchlocation;
            if ($searchBy === "tutor") {
                $locationClause = "AND users.location = :Searchlocation";
            } else {
                $locationClause = "AND courses.location = :Searchlocation";
            }
        }

        if ($searchBy === "tutor") {
            $whereClause = "WHERE (users.first_name LIKE :term OR users.last_name LIKE :term) {$locationClause}";
        } else {

            $whereClause = "WHERE title LIKE :term {$locationClause}";
        }

        $courses = $this->db->query(
            "SELECT courses.*, users.first_name as first_name, users.last_name 
         FROM courses
         JOIN users ON users.user_id = courses.tutor_id
         {$whereClause}
         LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();

        $courseCount = $this->db->query(
            "SELECT COUNT(*) 
         FROM courses
         JOIN users ON users.user_id = courses.tutor_id
         {$whereClause}",
            $params
        )->count();

        return [$courses, $courseCount];
    }


    public function update(array $formData, int $id)
    {
        $this->db->query(
            "UPDATE courses
            SET title = :title,
            description = :description,
            subject_id = :subject_id,
            grade_id = :grade_id,
            start_time = :start_time,
            end_time = :end_time,
            day = :day,
            price = :price,
            pricing_period = :pricing_period,
            duration = :duration
            WHERE course_id = :course_id",
            [
                'course_id' => $id,
                'title' => $formData['title'],
                'description' => $formData['description'],
                'subject_id' => $formData['subject_id'],
                'grade_id' => $formData['grade_id'],
                'start_time' => $formData['start_time'],
                'end_time' => $formData['end_time'],
                'day' => $formData['day'],
                'price' => $formData['price'],
                'pricing_period' => $formData['pricing_period'],
                'duration' => $formData['duration'],

            ]
        );
    }

    public function delete(int $id)
    {
        $this->db->query(
            "DELETE FROM courses WHERE course_id = :id",
            [
                "id" => $id
            ]
        );
    }

    public function getReviews()
    {
        $userReview = $this->db->query(
            "SELECT * FROM course_review WHERE user_id = :user_id",
            [
                'user_id' => $_SESSION['user']
            ]
        )->findAll();
        return $userReview;
    }

    public function getReviewForcourse(string $courseId)
    {
        $userReview = $this->db->query(
            "SELECT c.*, CONCAT(u.first_name, ' ', u.last_name) AS name, u.profile_picture_url FROM course_review c 
            JOIN users u on c.user_id = u.user_id 
            WHERE course_id = :course_id",
            [
                'course_id' => $courseId,
            ]
        )->findAll();
        return $userReview;
    }

    public function getAllCourses()
    {
        return $this->db->query(
            "SELECT * FROM courses"
        )->findAll();
    }

    public function getCourseList()
    {
        $searchTerm = $_GET['s'] ?? '';
        $courses = $this->db->query(
            "SELECT * FROM courses WHERE title LIKE :term ",
            [
                "term" => "%{$searchTerm}%"
            ]
        )->findAll();

        return $courses;
    }

    public function getNoOfCourses()
    {
        return $this->db->query(
            "SELECT COUNT(*) FROM courses"
        )->count();
    }

    public function registeredCourses()
    {
        $courses = $this->db->query(
            "SELECT courses.* FROM courses
            JOIN students_courses SC ON courses.course_id = SC.course_id
            WHERE SC.student_id = :id AND pinned = 0",
            [
                "id" => $_SESSION['user']
            ]
        )->findAll();
        $pinnedCourses = $this->db->query(
            "SELECT courses.* FROM courses
            JOIN students_courses SC ON courses.course_id = SC.course_id
            WHERE SC.student_id = :id AND pinned = 1",
            [
                "id" => $_SESSION['user']
            ]
        )->findAll();

        return [$courses, $pinnedCourses];
    }

    public function getCourseParticipants(string $id)
    {
        $searchTerm = $_GET['s'] ?? '';
        return $this->db->query(
            "SELECT U.first_name, U.last_name, U.user_id, U.email, SC.* from users U
            JOIN students_courses SC ON U.user_id = SC.student_id
            WHERE SC.course_id = :id AND (U.first_name LIKE :term OR U.last_name LIKE :term)",
            [
                "id" => $id,
                "term" => "%{$searchTerm}%"
            ]
        )->findAll();
    }

    public function RemoveParticipant(string $courseId, string $userId)
    {
        $this->db->query(
            "DELETE FROM students_courses WHERE student_id = :std AND course_id = :course",
            [
                "std" => $userId,
                "course" => $courseId
            ]
        );
    }

    public function AddParticipant(string $courseId, string $email)
    {
        $userId = $this->db->query(
            "SELECT user_id FROM users
            WHERE email = :email",
            [
                "email" => $email
            ]
        )->find();

        if (!$userId) {
            throw new ValidationException(['email' => 'Invalid Email address']);
        } else {
            $this->db->query(
                "INSERT INTO students_courses(student_id, course_id)
                VALUES(:studentId, :courseId)",
                [
                    "courseId" => $courseId,
                    "studentId" => $userId['user_id']
                ]
            );
        }
    }

    public function uploadFile(array $file, string $dir)
    {
        $storageDir = Paths::STORAGE_UPLOADS . "/" . $dir;
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $baseName = pathinfo($file['name'], PATHINFO_FILENAME);
        // $fileName = uniqid("", true) . "." . $extention;

        $fileName = $file['name'];
        $storagePath = $storageDir . "/" . $fileName;

        // Ensure directory exists
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0777, true);
        }

        $counter = 1;
        while (file_exists($storagePath)) {
            $fileName = $baseName . "_" . $counter . "." . $extension;
            $storagePath = $storageDir . "/" . $fileName;
            $counter++;
        }
        if (!move_uploaded_file($file['tmp_name'], $storagePath)) {
            throw new ValidationException([
                "file" => ['Failed to upload.']
            ]);
        }

        return $fileName;
    }

    private function isOneTimeCoursePaid($userId, $courseId)
    {
        $paid = $this->db->query(
            "SELECT SUM(amount) as total_paid FROM payments
            WHERE user_id = :user_id AND course_id = :course_id",
            [
                "user_id" => $userId,
                "course_id" => $courseId
            ]
        )->find();

        $courseFee = $this->db->query(
            "SELECT price FROM courses
            WHERE course_id = :course_id",
            [
                "course_id" => $courseId
            ]
        )->find();

        $isPaid = $paid && $paid['total_paid'] >= $courseFee['price'];
        return $isPaid;
    }

    private function isReuccringCourseSubPeriodPaid($userId, $courseId, $subPeriodId)
    {
        $paid = $this->db->query(
            "SELECT SUM(amount) as total_paid FROM payments
            WHERE user_id = :user_id AND course_id = :course_id AND sub_period_id = :sub_period_id",
            [
                "user_id" => $userId,
                "course_id" => $courseId,
                "sub_period_id" => $subPeriodId
            ]
        )->find();

        $subPeriodFee = $this->db->query(
            "SELECT price FROM recurring_course_sub_periods
            WHERE sub_period_id = :sub_period_id",
            [
                "sub_period_id" => $subPeriodId
            ]
        )->find();

        $isPaid = $paid && $paid['total_paid'] >= $subPeriodFee['price'];
        return $isPaid;
    }
}
