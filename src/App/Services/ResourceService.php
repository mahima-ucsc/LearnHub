<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use App\Config\Paths;
use Exception;

class ResourceService
{
    public function __construct(private Database $db) {}

    public function create(array $formData, array $files)
    {

        $filePath = null;

        // Handle file upload
        if (!empty($files['resource_file']['name'])) {
            $fileService = new FileService($this->db);
            $filePath = $fileService->uploadFile('resources', $files['resource_file']);
        }

        // Insert resource data into the database
        $this->db->query(
            "INSERT INTO shared_resources
            (title, description, category, resource_type, is_free, price, resource_url, resource_path, user_id)
            VALUES(:title, :description, :category, :resource_type, :is_free, :price, :resource_url, :resource_path, :user_id)",
            [
                "title" => $formData['title'],
                "description" => $formData['description'],
                "resource_type" => $formData['type'],
                "category" => $formData['category'],
                "is_free" => $formData['is_free'] == "on" ? 1 : 0,
                "price" => $formData['price'] ? $formData['price'] : 0,
                "resource_url" => $formData['resource_url'],
                "resource_path" => $filePath,
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
    public function getPendingResources()
    {
        return $this->db->query(
            "SELECT sr.*, CONCAT(u.first_name, ' ', u.last_name) as username FROM shared_resources sr
            JOIN users u ON u.user_id = sr.user_id
            WHERE sr.status = 'pending'"
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

    public function getResourceByIdDownload(int $resourceId): ?array
    {
        return $this->db->query(
            "SELECT * FROM shared_resources WHERE resource_id = :resource_id",
            ['resource_id' => $resourceId]
        )->find();
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

    public function getFilteredResources(array $filters): array
    {
        $query = "SELECT sr.*, CONCAT(u.first_name, ' ', u.last_name) as username FROM shared_resources sr
            JOIN users u ON u.user_id = sr.user_id WHERE 1=1";
        $params = [];

        if ($filters['type'] !== 'all') {
            $query .= " AND resource_type = :type";
            $params['type'] = $filters['type'];
        }

        if ($filters['category'] !== 'all') {
            $query .= " AND category = :category";
            $params['category'] = $filters['category'];
        }

        if ($filters['price'] !== 'all') {
            $query .= " AND is_free = :price";
            $params['price'] = $filters['price'];
        }

        $query .= " AND title LIKE :searchTerm";
        $params['searchTerm'] = "%{$filters['s']}%";

        return $this->db->query($query, $params)->findAll();
    }

    public function approveResource(string $id)
    {
        try {
            $this->db->query(
                "UPDATE shared_resources
                SET status = 'approved'
                WHERE resource_id = :id",
                [
                    "id" => $id
                ]
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function rejectResource(string $id)
    {
        try {
            $this->db->query(
                "UPDATE shared_resources
                SET status = 'rejected'
                WHERE resource_id = :id",
                [
                    "id" => $id
                ]
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function deleteResourceAdmin(string $id)
    {
        try {
            $this->db->query(
                "DELETE FROM shared_resources
                WHERE resource_id = :id",
                [
                    "id" => $id
                ]
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function searchResource(int $limit, int $offset)
    {
        $searchTerm = $_GET['s'] ?? '';
        $subject = $_GET['subject'] ?? 'all';
        $type = $_GET['type'] ?? 'all';
        $price = $_GET['price'] ?? 'all';
        $sort = $_GET['sort'] ?? '';

        $status = 'approved';
        if ($_SESSION['user_role'] == 'admin') {
            $status = $_GET['status'] ?? 'all';
        }

        $whereConditions = [];
        $params = [];

        if ($status !== 'all') {
            $whereConditions[] = "sr.status = :status";
            $params["status"] = $status;
        }
        if (!empty($searchTerm)) {
            $whereConditions[] = "(sr.title LIKE :term OR sr.description LIKE :term OR u.first_name LIKE :term OR u.last_name LIKE :term OR CONCAT(u.first_name , ' ', u.last_name) LIKE :term)";
            $params['term'] = "%{$searchTerm}%";
        }

        if ($subject !== 'all') {
            $whereConditions[] = "sr.subject_id = :subject";
            $params["subject"] = $subject;
        }

        if ($price !== 'all') {
            $whereConditions[] = "sr.price = :price";
            $params["price"] = $price;
        }

        $whereClause = !empty($whereConditions) ? "WHERE " . implode(" AND ", $whereConditions) : "";
        $orderClause = "";

        switch ($sort) {
            case 'newest':
                $orderClause = "ORDER BY sr.created_date DESC";
                break;
            case 'oldest':
                $orderClause = "ORDER BY sr.created_date ASC";
                break;
            case 'price_low':
                $orderClause = "ORDER BY sr.price ASC";
                break;
            case 'price_high':
                $orderClause = "ORDER BY sr.price DESC";
                break;
        }

        $resources = $this->db->query(
            "SELECT sr.*, CONCAT(u.first_name, ' ', u.last_name) as username FROM shared_resources sr
            JOIN users u ON u.user_id = sr.user_id
            {$whereClause}
            {$orderClause}
            LIMIT {$limit} OFFSET {$offset}",
            $params
        )->findAll();
        $resourceCount = $this->db->query(
            "SELECT COUNT(*) FROM shared_resources sr
            JOIN users u ON u.user_id = sr.user_id
            {$whereClause}",
            $params
        )->count();

        return [$resources, $resourceCount];
    }
}
