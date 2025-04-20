<?php

declare(strict_types=1);

namespace App\Services;

use App\Config\AppConstants;
use Exception;
use Framework\Database;
use App\Config\Paths;
use Framework\Exceptions\ValidationException;

class CourseService
{
    public function __construct(
        private Database $db,
        private PaymentService $paymentService,
        private FileService $fileService,
    ) {}

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

    /**
     * @deprecated
     * This function is deprecated.
     * It was used to save course data before developing the payment function.
     */
    // public function createCourse(array $formData)
    // {
    //     $tutor_id = $_SESSION['user'];

    //     $this->db->query(
    //         "INSERT INTO courses(title, description, subject_id, grade_id, tutor_id, start_time, end_time, day, price, pricing_period, location, thumbnail_url)
    //             VALUES (:title, :description, :subject_id, :grade_id, :tutor_id, :start_time, :end_time, :day, :price, :pricing_period, :location, :thumbnail_url)",
    //         [
    //             "title" => $formData['title'],
    //             "description" => $formData['description'],
    //             "subject_id" => $formData['subject_id'],
    //             "grade_id" => $formData['grade_id'],
    //             "tutor_id" => $tutor_id,
    //             "start_time" => $formData['start_time'],
    //             "end_time" => $formData['end_time'],
    //             "day" => $formData['day'],
    //             "price" => $formData['price'],
    //             "pricing_period" => $formData['pricing_period'],
    //             "location" => $formData['location'],
    //             "thumbnail_url" => $formData['thumbnail_filename'],
    //         ]
    //     );
    // }

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
            $isPaid = $this->paymentService->isOneTimeCoursePaid($_SESSION['user'], $id);
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
                $isPaid = $this->paymentService->isRecurringCourseSubPeriodPaid($_SESSION['user'], $courseId, $period['sub_period_id']);
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
    public function searchCourse(int $length = 9, int $offset = 0)
    {
        // Get all search parameters
        $searchTerm = trim($_GET['s'] ?? '');
        $subject = $_GET['subject'] ?? 'all';
        $price = $_GET['price'] ?? 'all';
        $type = $_GET['type'] ?? 'all';
        $location = $_GET['location'] ?? 'all';
        $rating = $_GET['rating'] ?? 'all';
        $sort = $_GET['sort'] ?? '';

        // Initialize arrays for WHERE clauses and parameters
        $whereConditions = [];
        $params = [];

        // Add search term condition (searching in name and course title)
        if (!empty($searchTerm)) {
            $whereConditions[] = "(u.first_name LIKE :term OR u.last_name LIKE :term OR c.title LIKE :term)";
            $params["term"] = "%{$searchTerm}%";
        }

        // Add location condition
        if ($location !== 'all') {
            $whereConditions[] = "c.location LIKE :location";
            $params["location"] = "%{$location}%";
        }

        // Add subject condition
        if ($subject !== 'all') {
            $whereConditions[] = "c.subject_id = :subject";
            $params["subject"] = $subject;
        }

        // Add price range condition
        // if ($price !== 'all') {
        //     switch ($price) {
        //         case 'free':
        //             $whereConditions[] = "c.price = 0";
        //             break;
        //         case 'paid':
        //             $whereConditions[] = "c.price > 0";
        //             break;
        //         case 'under10':
        //             $whereConditions[] = "c.price > 0 AND c.price <= 10";
        //             break;
        //         case 'under20':
        //             $whereConditions[] = "c.price > 0 AND c.price <= 20";
        //             break;
        //         case 'over20':
        //             $whereConditions[] = "c.price > 20";
        //             break;
        //     }
        // }

        // Add course type condition
        if ($type !== 'all') {
            $whereConditions[] = "c.billing_type = :type";
            $params["type"] = $type;
        }

        // Add rating condition
        // if ($rating !== 'all') {
        //     $whereConditions[] = "c.rating >= :rating";
        //     $params["rating"] = $rating;
        // }

        // Combine all conditions with AND
        $whereClause = !empty($whereConditions) ? "WHERE " . implode(" AND ", $whereConditions) : "";

        // Add sorting
        $orderClause = "";
        switch ($sort) {
            case 'newest':
                $orderClause = "ORDER BY c.published_date DESC";
                break;
            case 'oldest':
                $orderClause = "ORDER BY c.published_date ASC";
                break;
            case 'price_low':
                $orderClause = "ORDER BY c.price ASC";
                break;
            case 'price_high':
                $orderClause = "ORDER BY c.price DESC";
                break;
        }

        // Build and execute query
        $courses = $this->db->query(
            "SELECT 
        c.*,
        u.first_name as first_name,
        u.last_name,
        s.subject_title AS subject
        FROM courses c
        JOIN users u ON u.user_id = c.tutor_id
        JOIN subjects s ON s.subject_id = c.subject_id
        {$whereClause}
        {$orderClause}
        LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();

        // Get total count for pagination
        $courseCount = $this->db->query(
            "SELECT 
        COUNT(*)
        FROM courses c
        JOIN users u ON u.user_id = c.tutor_id
        {$whereClause}",
            $params
        )->count();

        return [$courses, $courseCount];
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
        $participants = $this->db->query(
            "SELECT DISTINCT
            u.user_id,
            CONCAT(u.first_name, ' ', u.last_name) AS username,
            u.email
            FROM users u
            JOIN course_payments cp ON u.user_id = cp.user_id
            WHERE cp.course_id = :id 
            AND(
            u.first_name LIKE :term 
            OR u.last_name LIKE :term 
            OR CONCAT(u.first_name, ' ', u.last_name) LIKE :term
            );",
            [
                "id" => $id,
                "term" => "%{$searchTerm}%"
            ]
        )->findAll();
        return $participants;
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

    public function getGrades()
    {
        $subjects = $this->db->query(
            "SELECT * FROM grades"
        )->findAll();

        return $subjects;
    }


    /**
     * Creates a new course with associated modules, subscription periods, and resources.
     * 
     * This method handles the creation of both one-time and recurring payment courses with their
     * respective modules. For recurring courses, it also creates subscription periods with pricing 
     * and optional free trial periods. Course resources (attachments) are uploaded and linked to 
     * their respective modules.
     * 
     * The entire process is wrapped in a transaction to ensure data integrity.
     *
     * @param array $courseData An associative array containing course details
     * 
     * @param array $files Array of file data for course resources/attachments
     * 
     */
    public function createCourseWithModules(array $courseData, array $files)
    {
        $this->db->beginTransaction();
        try {
            // 1. Insert course data
            $this->db->query(
                "INSERT INTO courses(
                title, 
                description, 
                subject_id, 
                grade_id, 
                tutor_id, 
                start_time, 
                end_time, 
                day, 
                billing_type,
                price,
                location, 
                thumbnail_url
            ) VALUES (
                :title, 
                :description, 
                :subject_id, 
                :grade_id, 
                :tutor_id, 
                :start_time, 
                :end_time, 
                :day, 
                :billing_type,
                :price,
                :location, 
                :thumbnail_url
            )",
                [
                    "title" => $courseData['title'],
                    "description" => $courseData['description'],
                    "subject_id" => $courseData['subject_id'],
                    "grade_id" => $courseData['grade_id'],
                    "tutor_id" => $courseData['tutor_id'],
                    "start_time" => $courseData['start_time'],
                    "end_time" => $courseData['end_time'],
                    "day" => $courseData['day'],
                    "billing_type" => $courseData['billing_type'],
                    "price" => $courseData['billing_type'] === 'onetime' ? $courseData['price'] : null,
                    "location" => $courseData['location'],
                    "thumbnail_url" => $courseData['thumbnail_url'],
                ]
            );

            $courseId = $this->db->lastInsertId();
            $moduleId = $this->createModule($courseId, $courseData['billing_type'], $courseData['modules']);
            $this->db->commit();
            return $courseId;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log('Failed to create course: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Creates new course modules
     * 
     * @param $isCreateModule is used to check whether the function is invoked when creating a course 
     * or adding a new module to a existing course.
     * 
     * Default value, $isCreateModule = 0 means function is invoked when creating a course
     * 
     * $isCreateModule = 1 means function is invoked when adding a new module to a existing course. In
     * this case, function commit changes to the database. Otherwise not.
     * 
     */

    public function createModule(string $courseId, string $type, array $modules, int $isCreateModule = 0)
    {
        $this->db->beginTransaction();

        try {
            if ($type === 'recurring') {

                // For each module, create a subscription period
                foreach ($modules as $module) {
                    $this->db->query(
                        "INSERT INTO recurring_course_sub_periods(
                        course_id, 
                        start_datetime, 
                        end_datetime, 
                        price,
                        free_access_start_datetime,
                        free_access_end_datetime
                    ) VALUES (
                        :course_id, 
                        :start_datetime, 
                        :end_datetime, 
                        :price,
                        :free_access_start_datetime,
                        :free_access_end_datetime
                    )",
                        [
                            "course_id" => $courseId,
                            "start_datetime" => $module['start_date'],
                            "end_datetime" => $module['end_date'],
                            "price" => $module['price'],
                            "free_access_start_datetime" => isset($module['has_free_trial']) && $module['has_free_trial'] ?
                                $module['free_trial_start_date'] . ' 00:00:00' : null,
                            "free_access_end_datetime" => isset($module['has_free_trial']) && $module['has_free_trial'] ?
                                $module['free_trial_end_date'] . ' 23:59:59' : null
                        ]
                    );

                    $subPeriodId = $this->db->lastInsertId();
                    error_log("***********Sub period id created");
                    error_log($subPeriodId);

                    // Create module for this subscription period
                    $this->db->query(
                        "INSERT INTO course_modules(
                        course_id, 
                        sub_period_id,
                        title, 
                        description
                    ) VALUES (
                        :course_id, 
                        :sub_period_id,
                        :title, 
                        :description
                    )",
                        [
                            "course_id" => $courseId,
                            "sub_period_id" => $subPeriodId,
                            "title" => $module['title'],
                            "description" => $module['description']
                        ]
                    );

                    $moduleId = $this->db->lastInsertId();
                    error_log("***********module id created");

                    // Upload and insert module resources if any
                    if (isset($module['attachments']) && !empty($module['attachments'])) {
                        foreach ($module['attachments'] as $attachment) {
                            if ($attachment['error'] === 0) {
                                try {
                                    $newFileName = $this->uploadFile($attachment, 'course_module_resource');
                                    $this->db->query(
                                        "INSERT INTO course_module_resource(
                                        module_id, 
                                        course_id, 
                                        resource_path
                                    ) VALUES (
                                        :module_id, 
                                        :course_id, 
                                        :resource_path
                                    )",
                                        [
                                            "module_id" => $moduleId,
                                            "course_id" => $courseId,
                                            "resource_path" => $newFileName
                                        ]
                                    );
                                } catch (ValidationException $e) {
                                    // Log the error but continue with the rest of the resources
                                    error_log('Failed to upload resource: ' . $e->getMessage());
                                }
                            }
                        }
                    }
                }
            } else {
                // If it's a onetime course insert module and resources 
                foreach ($modules as $module) {
                    $this->db->query(
                        "INSERT INTO course_modules(
                        course_id, 
                        title, 
                        description
                    ) VALUES (
                        :course_id, 
                        :title, 
                        :description
                    )",
                        [
                            "course_id" => $courseId,
                            "title" => $module['title'],
                            "description" => $module['description']
                        ]
                    );

                    $moduleId = $this->db->lastInsertId();

                    // Upload and insert module resources if any
                    if (isset($module['attachments']) && !empty($module['attachments'])) {
                        foreach ($module['attachments'] as $attachment) {
                            if ($attachment['error'] === 0) {
                                try {
                                    $newFileName = $this->uploadFile($attachment, 'course_module_resource');
                                    $this->db->query(
                                        "INSERT INTO course_module_resource(
                                        module_id, 
                                        course_id, 
                                        resource_path
                                    ) VALUES (
                                        :module_id, 
                                        :course_id, 
                                        :resource_path
                                    )",
                                        [
                                            "module_id" => $moduleId,
                                            "course_id" => $courseId,
                                            "resource_path" => $newFileName
                                        ]
                                    );
                                } catch (ValidationException $e) {
                                    // Log the error but continue with the rest of the resources
                                    error_log('Failed to upload resource: ' . $e->getMessage());
                                }
                            }
                        }
                    }
                }
            }
            if ($isCreateModule) {
                $this->db->commit();
            }
            return $moduleId;
        } catch (Exception $e) {
            error_log('Failed to create course module: ' . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    public function update(array $course, array $formData, int $id)
    {
        $params = [
            'course_id' => $id,
            'title' => $formData['courseTitle'],
            'description' => $formData['courseDescription'],
            'subject_id' => $formData['subject'],
            'grade_id' => $formData['grade'],
            'start_time' => $formData['courseStartTime'],
            'end_time' => $formData['courseEndTime'],
            'day' => $formData['courseday'],
            'price' => $formData['price'],
        ];

        $sql = "UPDATE courses
                SET title = :title,
                description = :description,
                subject_id = :subject_id,
                grade_id = :grade_id,
                start_time = :start_time,
                end_time = :end_time,
                day = :day,
                price = :price";

        $courseThumbnail = $_FILES['courseThumbnail'] ?? null;
        if ($courseThumbnail['name']) {
            $thumbnailFileName = $this->fileService->uploadFile(Paths::RELATIVE_COURSE_THUMBNAIL_UPLOADS, $courseThumbnail);
            unlink(Paths::STORAGE_UPLOADS . "/" . Paths::RELATIVE_COURSE_THUMBNAIL_UPLOADS . "/" . $course['thumbnail_url']);
            $sql .= ", thumbnail_url = :thumbnail_url";
            $params['thumbnail_url'] = $thumbnailFileName;
        }

        $sql .= " WHERE course_id = :course_id";

        $this->db->query($sql, $params);
    }

    public function getLocations()
    {
        return $this->db->query(
            "SELECT DISTINCT(location)
            FROM courses"
        )->findAll();
    }

    public function getTeacherCourses(int $id)
    {
        try {
            return $this->db->query(
                "SELECT * FROM courses
                WHERE tutor_id = :id",
                [
                    'id' => $id
                ]
            )->findAll();
        } catch (Exception $e) {
            error_log('Failed to fetch teacher courses: ' . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    public function getStudentCourses(string $id)
    {
        try {
            return $this->db->query(
                "SELECT DISTINCT c.*,
                CONCAT(u.first_name, ' ', u.last_name) AS teacher,
                s.subject_title AS subject
                FROM courses c
                JOIN course_payments cp ON cp.course_id = c.course_id
                JOIN users u ON u.user_id = c.tutor_id
                JOIN subjects s ON c.subject_id = s.subject_id
                WHERE cp.user_id = :id",
                [
                    'id' => $id
                ]
            )->findAll();
        } catch (Exception $e) {

            error_log('Failed to fetch student courses: ' . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    /**
     * Gets the count of courses grouped by subject.
     * 
     * This function retrieves the number of courses for each subject from the database,
     * orders them by course count in descending order, and optionally limits the results.
     * 
     * @param int $limit Optional. The maximum number of records to return. If 0, returns all records.
     * @return array An array of objects containing subject_id, subject title, and course count.
     * @throws Exception If database query fails, logs error and redirects to error page.
     */
    public function getCourseCountBySubject(int $limit = 0)
    {

        try {
            if ($limit != 0) {
                $limitClause = "LIMIT " . $limit;
            }
            return $this->db->query(
                "SELECT
                s.subject_id,
                s.subject_title AS subject,
                COUNT(c.course_id) AS course_count
                FROM subjects s
                JOIN courses c ON c.subject_id = s.subject_id
                GROUP BY s.subject_id
                ORDER BY course_count DESC
                {$limitClause} "
            )->findAll();
        } catch (Exception $e) {
            error_log("Failed fetch course count by subject" . $e->getMessage());
            redirectTo('server-error');
        }
    }

    public function deleteModule(string $courseId, string $moduleId)
    {
        try {
            $this->db->query(
                "DELETE FROM course_modules
                WHERE course_id = :courseId
                AND module_id = :moduleId",
                [
                    "courseId" => $courseId,
                    "moduleId" => $moduleId
                ]
            );
            redirectTo($_SERVER['HTTP_REFERER']);
        } catch (Exception $e) {
            error_log("Failed to delete course module: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }
}
