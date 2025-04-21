<?php

declare(strict_types=1);

namespace App\Services;

use App\Config\Paths;
use App\views\components\Alert;
use Framework\Database;
use Framework\Exceptions\ValidationException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class UserService
{
    public function __construct(
        private Database $db,
        private FileService $fileService
    ) {}

    public function getUserProfile()
    {
        $userDetails = $this->db->query(
            "SELECT * FROM users
            WHERE user_id = :userId",
            ['userId' => $_SESSION['user']]
        )->find();
        if ($userDetails['profile_picture_url'] !== null) {
            $userDetails['profile_picture_url'] =
                Paths::UPLOAD_FOLDER_RELATIVE_TO_PUBLIC . "/" .
                Paths::RELATIVE_USER_PROFILE_PICTURE_UPLOADS .
                '/' . $userDetails['profile_picture_url'];
        }

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
            throw new ValidationException(['email' => ['This email address is already in use. Please try a different one.']]);
        }
    }
    public function canChangeEmail(string $email)
    {
        $emailCount =  $this->db->query(
            "SELECT COUNT(*) FROM users WHERE email = :email AND user_id != :user",
            [
                'email' => $email,
                'user' => $_SESSION['user']
            ]
        )->count();

        if ($emailCount > 0) {
            throw new ValidationException(['email' => ['This email address is already in use. Please try a different one.']]);
        }
    }

    public function create(array $formData)
    {
        $password = password_hash($formData['password'], PASSWORD_BCRYPT, ["const" => 12]);

        $this->db->query(
            "INSERT INTO users(first_name, last_name, email, date_of_birth, password, user_role, is_verified) 
            VALUES (:first_name, :last_name, :email, :date_of_birth, :password, :user_role, :is_verified)",
            [
                "first_name" => $formData['first_name'],
                "last_name" => $formData['last_name'],
                "date_of_birth" => $formData['date_of_birth'],
                "email" => $formData['email'],
                "user_role" => $_SESSION['temp_role'],
                "password" => $password,
                "is_verified" => 1,
            ]
        );

        session_regenerate_id();
        $_SESSION['user'] = $this->db->lastInsertId();
        $_SESSION['user_role'] = $_SESSION['temp_role'];
        unset($_SESSION['temp_role']);
        unset($_SESSION['tempUser']);
        unset($_SESSION['otp_hash']);
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
        $this->db->query(
            "UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE user_id = :id",
            [
                "id" => $user['user_id']
            ]
        );

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

    public function delete(int $id)
    {
        $this->db->query(
            "DELETE FROM users WHERE user_id =:id",
            [
                'id' => $id
            ]
        );
    }

    // Function to add new user for admin
    public function addUser(array $formData)
    {
        $password = password_hash($formData['password'], PASSWORD_BCRYPT, ["const" => 12]);
        $this->db->query(
            "INSERT INTO users(first_name, last_name, email, date_of_birth, password, user_role) 
            VALUES (:first_name, :last_name, :email, :date_of_birth, :password, :user_role)",
            [
                "first_name" => $formData['first_name'],
                "last_name" => $formData['last_name'],
                "date_of_birth" => date('Y-m-d'), // Set today as default
                "email" => $formData['email'],
                "user_role" => $formData['user_role'],
                "password" => $password,
            ]
        );
    }

    public function getUsers()
    {
        $searchTerm = $_GET['s'] ?? '';
        $userData = $this->db->query(
            "SELECT * FROM users WHERE first_name LIKE :term OR last_name LIKE :term",
            [
                "term" => "%{$searchTerm}%"
            ]
        )->findAll();

        // Remove user  password from the array
        foreach ($userData as &$user) {
            unset($user['password']);
        }
        unset($user);

        return $userData;
    }

    public function getUserCount()
    {
        try {
            $students =  $this->db->query(
                "SELECT COUNT(*) FROM users WHERE user_role = 'student'"
            )->count();

            $teachers = $this->db->query(
                "SELECT COUNT(*) FROM users WHERE user_role = 'teacher'"
            )->count();
            $admin = $this->db->query(
                "SELECT COUNT(*) FROM users WHERE user_role = 'admin'"
            )->count();

            $count = [
                'students' => $students,
                'teachers' => $teachers,
                'admin' => $admin
            ];

            return $count;
        } catch (Exception $e) {
            error_log("Failed to fetch user count: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    public function updateProfile(array $formData)
    {
        $this->db->query(
            "UPDATE users 
            SET first_name = :fname, last_name = :lname, description = :description, email = :email,
            phone_no = :phone_no, date_of_birth = :dob, location = :location
            WHERE user_id = :user_id",
            [
                "fname" => $formData['first_name'],
                "lname" => $formData['last_name'],
                "description" => $formData['description'],
                "email" => $formData['email'],
                "phone_no" => $formData['phone_no'],
                "dob" => $formData['date_of_birth'],
                "location" => $formData['location'],
                "user_id" => $_SESSION['user']
            ]
        );
    }

    public function updateProfilePicture(array $file)
    {
        $fileName =  $this->fileService->uploadFile(Paths::RELATIVE_USER_PROFILE_PICTURE_UPLOADS, $file);

        $this->db->query(
            "UPDATE users SET profile_picture_url = :profile_picture_url WHERE user_id = :user_id",
            [
                'profile_picture_url' => $fileName,
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function updatePassword(array $formData)
    {
        $user = $this->db->query("SELECT * FROM users WHERE user_id = :user_id", [
            'user_id' => $_SESSION['user']
        ])->find();

        $passwordMatch = password_verify($formData['currentPassword'], $user['password']);
        if (!$passwordMatch) {
            throw new ValidationException(['password' => ['Invalid Password']]);
        }

        if (!$formData['newPassword']) {
            throw new ValidationException(['newPassword' => ['This field cannot be empty']]);
        }
        if (!$formData['confirmPassword']) {
            throw new ValidationException(['confirmPassword' => ['This field cannot be empty']]);
        }

        if ($formData['newPassword'] === $formData['confirmPassword']) {
            $password = password_hash($formData['newPassword'], PASSWORD_BCRYPT, ["const" => 12]);
            $this->db->query(
                "UPDATE users SET password = :password
                WHERE user_id = :user_id",
                [
                    "user_id" => $_SESSION['user'],
                    "password" => $password
                ]
            );
        } else {
            throw new ValidationException(['notMatch' => ['Passwords does not match']]);
        }
    }

    public function sendVerificationCode(string $email)
    {
        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        $verificationCode = random_int(100000, 999999);

        $HVcode = password_hash((string)$verificationCode, PASSWORD_BCRYPT, ["const" => 12]);
        $_SESSION['otp_hash'] = $HVcode;
        // dd([$verificationCode, $HVcode, $email]);

        try {
            // server settings
            $mail->isSMTP(); //set mailer to use smtp
            $mail->Host = 'smtp.gmail.com'; //specify main and backup server
            $mail->SMTPAuth = true; //enable smtp authentication
            $mail->Username = 'learnhubnet@gmail.com'; //smtp username
            $mail->Password = 'fops kigv zank yhse'; // smtp password that is google app password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // recipients
            // sender (server mail)
            $mail->setFrom('learnhubnet@gmail.com', 'LearnHub-community');
            // receiver (client mail)
            $mail->addAddress($email, "client");


            // email content 
            $mail->isHTML(true);
            $mail->Subject = 'email verification';
            $mail->Body = 'the verificaiton code is : ' . $verificationCode;

            $mail->send();
            echo 'verfication mail sent successfully';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function sendContactMail($data)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'learnhubnet@gmail.com';
            $mail->Password = 'fops kigv zank yhse';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Email configuration
            $mail->setFrom('learnhubnet@gmail.com', 'LearnHub Community');
            $mail->addAddress('learnhubnet@gmail.com', 'LearnHub Support');
            $mail->addReplyTo($data['email'], $data['name']);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Message from ' . ($data['name'] ?? 'Unknown');

            // Safely access the subject key
            $mailBody = "
                <h2>New Contact Message</h2>
                <p><strong>From:</strong> " . htmlspecialchars($data['name'] ?? 'Unknown') . "</p>
                <p><strong>Email:</strong> " . htmlspecialchars($data['email'] ?? 'Unknown') . "</p>
                <p><strong>Subject:</strong> " . htmlspecialchars($data['subject'] ?? 'No Subject') . "</p>
                <hr>
                <h3>Message:</h3>
                <p>" . nl2br(htmlspecialchars($data['message'] ?? 'No Message')) . "</p>
            ";

            $mail->Body = $mailBody;
            $mail->AltBody = strip_tags($mailBody); // Plain text version

            $mail->send();
            return true;
        } catch (Exception $e) {
            throw new ValidationException(['email' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
        }
    }
}
