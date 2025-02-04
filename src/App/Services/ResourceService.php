<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use App\Config\Paths;
use Framework\Exceptions\ValidationException;

class ResourceService
{
    public  function __construct(private Database $db) {}

    public function create(array $formData)
    {
        $student_id = $_SESSION['user'];
        // $attachment_link = $_SESSION['resource'];

        $this->db->query(
            "INSERT INTO resources(title, description, type, price, user_id, attachment_link)
                VALUES (:title, :description, :type, :price, :user_id, :attachment_link)",
            [
                "title" => $formData['title'],
                "description" => $formData['description'],
                "type" => $formData['type'],
                "price" => $formData['price'] ?? NULL,
                "user_id" => $student_id,
                "attachment_link" => "test"

            ]
        );
    }

    public function delete(int $id)
    {
        $this->db->query(
            "DELETE FROM resources WHERE resource_id = :id AND user_id = :user_id",
            [
                "id" => $id,
                "user_id" => $_SESSION['user']
            ]
        );
    }

    public function getAllResources()
    {
        return $this->db->query(
            "SELECT r.*, u.first_name, u.last_name 
             FROM resources r
             JOIN users u ON r.user_id = u.user_id
             ORDER BY r.resource_id DESC"
        )->findAll();
    }

    public function getMyResources()
    {
        return $this->db->query(
            "SELECT r.*, u.first_name, u.last_name 
             FROM resources r
             JOIN users u ON r.user_id = u.user_id 
             WHERE r.user_id = :user_id
             ORDER BY r.resource_id DESC",
            [
                'user_id' => $_SESSION['user']
            ]
        )->findAll();
    }
}
