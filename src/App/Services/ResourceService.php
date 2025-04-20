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

    public function getResourcesByUser(int $userId)
    {
        return $this->db->query(
            "SELECT sr.*, CONCAT(u.first_name, ' ', u.last_name) as username FROM shared_resources sr
            JOIN users u ON u.user_id = sr.user_id
            WHERE sr.user_id = :user_id",
            ["user_id" => $userId]
        )->findAll();
    }

    public function deleteResource(int $resourceId, int $userId): bool
    {
        $query = "DELETE FROM shared_resources WHERE resource_id = :resource_id AND user_id = :user_id";
        $result = $this->db->query($query, [
            'resource_id' => $resourceId,
            'user_id' => $userId
        ]);

        return $result->rowCount() > 0; // Return true if a row was deleted
    }

    public function getResourceById(int $resourceId, int $userId): ?array
    {
        return $this->db->query(
            "SELECT * FROM shared_resources WHERE resource_id = :resource_id AND user_id = :user_id",
            [
                'resource_id' => $resourceId,
                'user_id' => $userId
            ]
        )->find();
    }

    public function updateResource(int $resourceId, int $userId, array $formData): bool
    {
        $query = "UPDATE shared_resources 
              SET title = :title, description = :description, category = :category, resource_type = :resource_type, price = :price, resource_url = :resource_url 
              WHERE resource_id = :resource_id AND user_id = :user_id";

        $this->db->query($query, [
            'title' => $formData['title'],
            'description' => $formData['description'],
            'category' => $formData['category'],
            'resource_type' => $formData['type'],
            'price' => $formData['price'],
            'resource_id' => $resourceId,
            'user_id' => $userId,
            'resource_url' => $formData['resource_url'],

        ]);

        return $this->db->rowCount() > 0;
    }
}
