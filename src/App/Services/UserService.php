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

    public function getTutorProfile(string $tutorId)
    {
        $tutorDetails = $this->db->query(
            "SELECT * FROM view_tutor_full_profile WHERE user_id = :tutor_id;",
            ['tutor_id' => $tutorId]
        )->find();
        if ($tutorDetails['profile_picture_url'] !== null) {
            $tutorDetails['profile_picture_url'] =
                Paths::UPLOAD_FOLDER_RELATIVE_TO_PUBLIC . "/" .
                Paths::RELATIVE_USER_PROFILE_PICTURE_UPLOADS .
                '/' . $tutorDetails['profile_picture_url'];
        }

        unset($tutorDetails['password']);
        return $tutorDetails;
    }

    public function getUserDetailsById(string $id)
    {
        $userDetails = $this->db->query(
            "SELECT * FROM users
            WHERE user_id = :userId",
            ['userId' => $id]
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

    public function getUsers(int $limit = 10, int $offset = 0)
    {
        $searchTerm = $_GET['s'] ?? '';
        $role = $_GET['role'] ?? '';

        $params['term'] = "%{$searchTerm}%";

        if ($role != 'all') {
            $filterRole = "AND user_role = :role";
            $params['role'] = $role;
        }
        $query = "SELECT * FROM users 
            WHERE first_name LIKE :term 
            OR last_name LIKE :term
            OR CONCAT(first_name, ' ', last_name) LIKE :term
            {$filterRole}
            LIMIT {$limit} OFFSET {$offset}";
        // dd($query);
        dd($params);
        $userData = $this->db->query(
            "SELECT * FROM users 
            WHERE first_name LIKE :term 
            OR last_name LIKE :term
            OR CONCAT(first_name, ' ', last_name) LIKE :term
            {$filterRole}
            LIMIT {$limit} OFFSET {$offset}",
            $params
        )->findAll();
        $count = $this->db->query(
            "SELECT COUNT(user_id) FROM users 
            WHERE first_name LIKE :term 
            OR last_name LIKE :term
            OR CONCAT(first_name, ' ', last_name) LIKE :term
            {$filterRole}",
            $params
        )->count();

        // Remove user  password from the array
        foreach ($userData as &$user) {
            unset($user['password']);
        }
        unset($user);

        return [$userData, $count];
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
        $verificationCode = generateRadomString(6);
        $HVcode = password_hash((string)$verificationCode, PASSWORD_BCRYPT, ["const" => 12]);
        $_SESSION['otp_hash'] = $HVcode;
        $_SESSION['otp_expiry'] = time() + 300;

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
            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                        color: #333333;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        border: 1px solid #e0e0e0;
                        border-radius: 5px;
                    }
                    .header {
                        text-align: center;
                        padding: 10px;
                        background-color: #ffc400;
                        color: white;
                        border-radius: 4px;
                    }
                    .content {
                        padding: 20px 10px;
                    }
                    .verification-code {
                        font-size: 28px;
                        font-weight: bold;
                        text-align: center;
                        letter-spacing: 5px;
                        margin: 20px 0;
                        color: #ffc400;
                        padding: 10px;
                        background-color: #f5f5f5;
                        border-radius: 4px;
                        border-left: 4px solid #ffc400;
                    }
                    .footer {
                        font-size: 12px;
                        color: #888888;
                        text-align: center;
                        margin-top: 20px;
                        border-top: 1px solid #e0e0e0;
                        padding-top: 15px;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h2>LearnHub</h2>
                    </div>
                    <div class="content">
                        <p>Hello,</p>
                        <p>Thank you for using LearnHub. Your verification code is:</p>
                        
                        <div class="verification-code">' . $verificationCode . '</div>
                        
                        <p>This code will expire in 5 minutes for security reasons.</p>
                        <p>If you did not request this code, please ignore this email.</p>
                    </div>
                    <div class="footer">
                        <p>&copy; ' . date('Y') . ' LearnHub. All rights reserved.</p>
                        <p>If you need help, contact <a href="mailto:learnhubnet@gmail.com" style="color: #ffc400;">learnhubnet@gmail.com</a></p>
                    </div>
                </div>
            </body>
            </html>';

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

    public function createTutorProfile($formData)
    {
        // dd($formData);
        $tutorId = $_SESSION['user'];
        $this->db->beginTransaction();

        try {
            // insert basic info
            $this->db->query(
                "INSERT INTO TutorProfiles (tutor_id, title, bio)
                VALUES (:tutor_id, :title, :bio);",
                [
                    'tutor_id' => $tutorId,
                    'title' => !empty($formData['title']) ? $formData['title'] : null,
                    'bio' => !empty($formData['bio']) ? $formData['bio'] : null,
                ]
            );

            // insert subjects
            if (isset($formData['subjects']) && is_array($formData['subjects'])) {
                foreach ($formData['subjects'] as $subject) {
                    $this->db->query(
                        "INSERT INTO TutorSubjects (tutor_id, subject_id, years_experience)
                    VALUES (:tutor_id, :subject_id, :years_experience);",
                        [
                            'tutor_id' => $tutorId,
                            'subject_id' => $subject['subject_id'],
                            'years_experience' => $subject['years_experience'],
                        ]
                    );
                }
            }

            // insert education details
            if (isset($formData['educations']) && is_array($formData['educations'])) {
                foreach ($formData['educations'] as $education) {
                    $this->db->query(
                        "INSERT INTO TutorEducation (tutor_id, degree, institution, field_of_study, start_date, end_date)
                        VALUES (:tutor_id, :degree, :institution, :field_of_study, :start_date, :end_date);",
                        [
                            'tutor_id' => $tutorId,
                            'degree' => $education['degree'],
                            'institution' => $education['institution'],
                            'field_of_study' => $education['field_of_study'],
                            'start_date' => $education['start_date'],
                            'end_date' => $education['end_date'],
                        ]
                    );
                }
            }

            // insert available time slots
            if (isset($formData['availability']) && is_array($formData['availability'])) {
                foreach ($formData['availability'] as $timeSlot) {
                    $this->db->query(
                        "INSERT INTO TutorAvailability (tutor_id, day_of_week, start_time, end_time, is_recurring)
                        VALUES (:tutor_id, :day_of_week, :start_time, :end_time, :is_recurring);",
                        [
                            'tutor_id' => $tutorId,
                            'day_of_week' => $timeSlot['day_of_week'],
                            'start_time' => $timeSlot['start_time'],
                            'end_time' => $timeSlot['end_time'],
                            'is_recurring' => $timeSlot['is_recurring'] === 'on' ? 1 : 0,
                        ]
                    );
                }
            }

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
            error_log("Failed to create tutor profile: " . $e->getMessage());
        }
    }

    public function updateTutorProfile($formData)
    {
        // dd($formData);
        $tutorId = $_SESSION['user'];
        $this->db->beginTransaction();

        try {
            // update basic info
            $this->db->query(
                "UPDATE TutorProfiles 
                SET title = :title, bio = :bio 
                WHERE tutor_id = :tutor_id;",
                [
                    'tutor_id' => $tutorId,
                    'title' => !empty($formData['title']) ? $formData['title'] : null,
                    'bio' => !empty($formData['bio']) ? $formData['bio'] : null,
                ]
            );

            // insert subjects
            if (isset($formData['subjects']) && is_array($formData['subjects'])) {
                foreach ($formData['subjects'] as $subject) {

                    if ((string)$subject['is_new'] === '0') {
                        // Update years_experience if subject exists
                        $this->db->query(
                            "UPDATE TutorSubjects 
                            SET years_experience = :years_experience
                            WHERE tutor_id = :tutor_id AND subject_id = :subject_id",
                            [
                                'tutor_id' => $tutorId,
                                'subject_id' => $subject['subject_id'],
                                'years_experience' => $subject['years_experience'],
                            ]
                        );
                    } else {
                        // Insert new subject if it doesn't exist
                        $this->db->query(
                            "INSERT INTO TutorSubjects (tutor_id, subject_id, years_experience)
                            VALUES (:tutor_id, :subject_id, :years_experience);",
                            [
                                'tutor_id' => $tutorId,
                                'subject_id' => $subject['subject_id'],
                                'years_experience' => $subject['years_experience'],
                            ]
                        );
                    }
                }
            }

            // insert education details
            if (isset($formData['educations']) && is_array($formData['educations'])) {
                foreach ($formData['educations'] as $education) {
                    if ($education['is_new'] === '0') {
                        // update education if exists
                        $this->db->query(
                            "UPDATE TutorEducation 
                            SET degree = :degree, institution = :institution, field_of_study = :field_of_study, start_date = :start_date, end_date = :end_date
                            WHERE tutor_id = :tutor_id AND education_id = :education_id",
                            [
                                'tutor_id' => $tutorId,
                                'degree' => $education['degree'],
                                'institution' => $education['institution'],
                                'field_of_study' => $education['field_of_study'],
                                'start_date' => $education['start_date'],
                                'end_date' => $education['end_date'],
                                'education_id' => $education['education_id'],
                            ]
                        );
                    } else {
                        $this->db->query(
                            "INSERT INTO TutorEducation (tutor_id, degree, institution, field_of_study, start_date, end_date)
                        VALUES (:tutor_id, :degree, :institution, :field_of_study, :start_date, :end_date);",
                            [
                                'tutor_id' => $tutorId,
                                'degree' => $education['degree'],
                                'institution' => $education['institution'],
                                'field_of_study' => $education['field_of_study'],
                                'start_date' => $education['start_date'],
                                'end_date' => $education['end_date'],
                            ]
                        );
                    }
                }
            }

            // insert available time slots
            if (isset($formData['availability']) && is_array($formData['availability'])) {
                foreach ($formData['availability'] as $timeSlot) {
                    if ($timeSlot['is_new'] === '0') {
                        $this->db->query(
                            "UPDATE TutorAvailability
                            SET day_of_week = :day_of_week, start_time = :start_time, end_time = :end_time, is_recurring = :is_recurring
                            WHERE tutor_id = :tutor_id AND availability_id = :availability_id;",
                            [
                                'tutor_id' => $tutorId,
                                'day_of_week' => $timeSlot['day_of_week'],
                                'start_time' => $timeSlot['start_time'],
                                'end_time' => $timeSlot['end_time'],
                                'is_recurring' => $timeSlot['is_recurring'] === 'on' ? 1 : 0,
                                'availability_id' => $timeSlot['availability_id'],
                            ]
                        );
                    } else {
                        $this->db->query(
                            "INSERT INTO TutorAvailability (tutor_id, day_of_week, start_time, end_time, is_recurring)
                            VALUES (:tutor_id, :day_of_week, :start_time, :end_time, :is_recurring);",
                            [
                                'tutor_id' => $tutorId,
                                'day_of_week' => $timeSlot['day_of_week'],
                                'start_time' => $timeSlot['start_time'],
                                'end_time' => $timeSlot['end_time'],
                                'is_recurring' => $timeSlot['is_recurring'] === 'on' ? 1 : 0,
                            ]
                        );
                    }
                }
            }

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollback();
            error_log("Failed to create tutor profile: " . $e->getMessage());
        }
    }




    public function saveUserInterest(array $interest)
    {
        try {
            $userId = $_SESSION['user'];
            foreach ($interest as $i) {
                $this->db->query(
                    "INSERT INTO user_interest(
                    user_id,
                    subject_id
                    ) VALUES(
                    :user_id,
                    :subject_id
                    )",
                    [
                        "user_id" => $userId,
                        "subject_id" => $i
                    ]
                );
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    // get tutor profile data
    public function getTutorbasic(string $tutorId)
    {
        return $this->db->query(
            "SELECT * FROM TutorProfiles
            WHERE tutor_id = :tutor_id",
            [
                'tutor_id' => $tutorId,
            ]
        )->find();
    }

    public function getTutorSubjects(string $tutorId)
    {
        return $this->db->query(
            "SELECT ts.*, s.subject_title FROM TutorSubjects ts 
            JOIN subjects s ON ts.subject_id = s.subject_id
            WHERE tutor_id = :tutor_id",
            [
                'tutor_id' => $tutorId,
            ]
        )->findAll();
    }

    public function getTutorEducations(string $tutorId)
    {
        return $this->db->query(
            "SELECT * FROM TutorEducation 
            WHERE tutor_id = :tutor_id",
            [
                'tutor_id' => $tutorId,
            ]
        )->findAll();
    }

    public function getTutorAvailability(string $tutorId)
    {
        return $this->db->query(
            "SELECT * FROM TutorAvailability 
            WHERE tutor_id = :tutor_id",
            [
                'tutor_id' => $tutorId,
            ]
        )->findAll();
    }
}
