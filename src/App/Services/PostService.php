<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;

class PostService
{
    public function __construct(private Database $db) {}

    public function getAllPosts()
    {
        $this->db->query(
            "SELECT * FROM posts_requests"
        )->findAll();
    }

    public function getMyPost()
    {
        $this->db->query(
            "SELECT * FROM posts_requests
            WHERE user_id = :user_id",
            [
                'user_id' => $_SESSION['user']
            ]
        )->findAll();
    }

    public function getPost(string $id)
    {
        $this->db->query(
            "SELECT * FROM posts_requests
            WHERE post_req_id = :post_req_id",
            [
                'post_req_id' => $id
            ]
        )->findAll();
    }

    public function delete(int $id)
    {
        $this->db->query(
            "DELETE FROM posts_requests WHERE post_req_id = :id AND user_id = :user_id",
            [
                "post_req_id" => $id,
                "user_id" => $_SESSION['user']
            ]
        );
    }

    public function update(array $formData, int $id)
    {
        $this->db->query(
            "UPDATE posts_requests
            SET description = :description,
            title = :title,
            location = :location,
            price = :price
            WHERE post_req_id = :id AND user_id = :user_id",
            [
                "description" => $formData['description'],
                "title" => $formData['title'],
                "price" => $formData['price'],
                'location' => $formData['location'],
                "post_req_id" => $id,
                "user_id" => $_SESSION['user']
            ]
        );
    }
}
