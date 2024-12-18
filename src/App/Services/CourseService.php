<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class CourseService
{
    public function __construct(private Database $db) {}

    public function create(array $formData)
    {
        $tutor_id = $_SESSION['user'];
        $this->db->query(
            "INSERT INTO courses(title, description, subject_id, grade_id, tutor_id, start_time, end_time, day, price, pricing_period, location, thumbnail)
            VALUES (:title, :description, :subject_id, :grade_id, :tutor_id, :start_time, :end_time, :day, :price, :pricing_period, :location, :thumbnail)",
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
                "thumbnail" => "thumbnail"
            ]
        );
    }

    public function getMyCourses()
    {
        $myCourses = $this->db->query(
            "SELECT * FROM courses
            WHERE tutor_id = :user_id",
            ['user_id' => $_SESSION['user']]
        )->findAll();

        return $myCourses;
    }
    public function getMyCourseById(string $id)
    {
        return $this->db->query(
            "SELECT * FROM courses
            WHERE tutor_id = :user_id AND course_id = :id",
            [
                'user_id' => $_SESSION['user'],
                'id' => $id
            ]
        )->find();
    }

    public function getByCourseId(string $id)
    {
        return $this->db->query(
            "SELECT * FROM courses
            WHERE course_id = :id",
            [
                'id' => $id
            ]
        )->find();
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
            "DELETE FROM courses WHERE course_id = :id AND tutor_id = :user_id",
            [
                "id" => $id,
                "user_id" => $_SESSION['user']
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

    public function getAllCourses()
    {
        return $this->db->query(
            "SELECT * FROM courses"
        )->findAll();
    }

    public function getNoOfCourses()
    {
        return $this->db->query(
            "SELECT COUNT(*) FROM courses"
        )->count();
    }

    public function registeredCourses()
    {
        return $this->db->query(
            "SELECT courses.* FROM courses
            JOIN students_courses SC ON courses.course_id = SC.course_id
            WHERE SC.student_id = :id",
            [
                "id" => $_SESSION['user']
            ]
        )->findAll();
    }
}
