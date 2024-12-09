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
    public function getCourse(string $id)
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
    public function getAllCourses(int $length = 6, int $offset = 0)
    {
        $searchTerm = addcslashes($_GET['s'] ?? '', '-_/');
        $searchTerm = trim($searchTerm);
        $params = [
            "title" => "%{$searchTerm}%"
        ];

        $courses = $this->db->query(
            "SELECT * FROM courses WHERE title LIKE :title
            LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();

        $courseCount = $this->db->query(
            "SELECT COUNT(*) FROM courses WHERE title LIKE :title",
            $params
        )->count();

        return [$courses, $courseCount];
    }

    public function getAllCoursesByTutor(int $length = 6, int $offset = 0)
    {
        // Fetch the search term from the GET request
        $searchTerm = $_GET['s'] ?? '';
        $searchTerm = trim($searchTerm);
        $params = [
            "name" => "%{$searchTerm}%",
        ];

        // Use a JOIN to find courses directly based on tutor details
        $courses = $this->db->query(
            "SELECT courses.* 
         FROM courses
         JOIN users ON users.user_id = courses.tutor_id
         WHERE users.first_name LIKE :name OR users.last_name LIKE :name
         LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();

        $courseCount = $this->db->query(
            "SELECT COUNT(*) 
         FROM courses
         JOIN users ON users.user_id = courses.tutor_id
         WHERE users.first_name LIKE :name OR users.last_name LIKE :name",
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
}
