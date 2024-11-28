<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
    public function __construct(private Database $db) {}

    public function getUserProfile()
    {
        $userDetails = $this->db->query(
            "SELECT * FROM users
            WHERE user_id = :userId",
            ['userId' => $_SESSION['user']]
        )->find();

        unset($userDetails['password']);

        return $userDetails;
    }

    public function getUserDetailsById(string $id)
    {
        $userDetails = $this->db->query(
            "SELECT * FROM users
            WHERE user_id = :userId",
            ['userId' => $id]
        )->find();

        unset($userDetails['password']);

        return $userDetails;
    }

    public function isEmailTaken(string $email)
    {
        $emailCount =  $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email",
            [
                'email' => $email
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => 'Email taken']);
        }
    }

    public function create(array $formData)
    {
        $password = password_hash($formData['password'], PASSWORD_BCRYPT, ["const" => 12]);

        $this->db->query(
            "INSERT INTO users(first_name, last_name, email, date_of_birth, password, user_role) 
            VALUES (:first_name, :last_name, :email, :date_of_birth, :password, :user_role)",
            [
                "first_name" => $formData['first_name'],
                "last_name" => $formData['last_name'],
                "date_of_birth" => $formData['date_of_birth'],
                "email" => $formData['email'],
                "user_role" => $_SESSION['temp_role'],
                "password" => $password,
            ]
        );
        session_regenerate_id();
        $_SESSION['user'] = $this->db->lastInsertId();
        $_SESSION['user_role'] = $_SESSION['temp_role'];
        unset($_SESSION['temp_role']);
    }

    public function login(array $formData)
    {
        $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $formData['email']
        ])->find();
        if ($user === false) {
            throw new ValidationException(['password' => ['Invalid Email address or Password. Please try again.']]);
        }

        $passwordMatch = password_verify($formData['password'], $user['password']);
        if (!$passwordMatch) {
            throw new ValidationException(['password' => ['Invalid Email address or Password. Please try again.']]);
        }

        session_regenerate_id();
        $_SESSION['user'] = $user['user_id'];
        $_SESSION['user_role'] = $user['user_role'];
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['user_role']);
        session_regenerate_id();
    }

    public function getAllUsers()
    {
        $users = $this->db->query(
            "SELECT * FROM users"
        )->findAll();

        return $users;
    }
}
