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
}
