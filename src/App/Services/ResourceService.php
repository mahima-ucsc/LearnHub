<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use App\Config\Paths;


class ResourceService
{
    public function __construct(private Database $db) {}

    public function create(array $formData, array $files)
    {
        if (!empty($files)) {
            // TODO: Save file
        }

        $this->db->query(
            "INSERT INTO shared_resources
            (title, description, category, resource_type, is_free, price, resource_url, user_id)
            VALUES(:title, :description, :category, :resource_type, :is_free, :price, :resource_url, :user_id)",
            [
                "title" => $formData['title'],
                "description" => $formData['description'],
                "resource_type" => $formData['type'],
                "category" => $formData['category'],
                "is_free" => $formData['is_free'] == "on" ? 1 : 0,
                "price" => $formData['price'] ? $formData['price'] : 0,
                "resource_url" => $formData['resource_url'],
                "user_id" => $_SESSION['user']
            ]
        );
    }

    public function getResources()
    {
        return $this->db->query(
            "SELECT sr.*, CONCAT(u.first_name, ' ', u.last_name) as username FROM shared_resources sr
            JOIN users u ON u.user_id = sr.user_id"
        )->findAll();
    }
}
