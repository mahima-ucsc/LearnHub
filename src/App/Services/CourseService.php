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
            "INSERT INTO courses(title, description, subject_id, grade_id, tutor_id, start_time, end_time, day, price, pricing_period, duration)
            VALUES (:title, :description, :subject_id, :grade_id, :tutor_id, :start_time, :end_time, :day, :price, :pricing_period, :duration)",
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
                "duration" => $formData['duration']
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
    public function getAllCourses()
    {
        return $this->db->query(
            "SELECT * FROM courses"
        )->findAll();
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
}
