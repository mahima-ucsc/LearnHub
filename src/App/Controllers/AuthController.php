<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use Framework\Exceptions\ValidationException;
use App\Services\{ValidatorService, UserService, SubjectService};

class AuthController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userService,
        private SubjectService $SubjectService,
    ) {}

    public function registerView()
    {
        echo $this->view->render("register.php", [
            "title" => "Register"
        ]);
    }
    public function registerRoleView()
    {
        echo $this->view->render("choose_role.php", [
            "title" => "RegisterRole"
        ]);
    }

    public function chooseRole()
    {
        $role = $_POST['role'];
        $_SESSION['temp_role'] = $role;
        redirectTo("/register/create-account");
    }

    public function register()
    {
        $this->validatorService->validateRegister($_POST);
        $this->userService->isEmailTaken($_POST['email']);
        $this->userService->sendVerificationCode($_POST['email']);
        $_SESSION['tempUser'] = $_POST;
        redirectTo('register/verification');
    }

    public function verificationView()
    {
        echo $this->view->render("register_varification.php", [
            "title" => "Verification"
        ]);
    }

    public function verifyuser()
    {
        $currentTime = time();
        // check OTP has expired
        if (!isset($_SESSION['otp_expiry']) || $currentTime > $_SESSION['otp_expiry']) {
            throw new ValidationException(['verificationCode' => ['Verification code expired. please resend new one.']]);
            unset($_SESSION['otp_hash'], $_SESSION['otp_expiry']);
        }
        // verify the pin
        if (password_verify($_POST['verificationCode'], $_SESSION['otp_hash'])) {
            $this->userService->create($_SESSION['tempUser']);
            if ($_SESSION['user_role'] == "student") {
                redirectTo('/interest');
            }
            if ($_SESSION['user_role'] == "teacher") {
                $tutorId = $_SESSION['user'];
                redirectTo("/tutor/{$tutorId}/create_profile");
            } else {
                redirectTo("/");
            }
            unset($_SESSION['otp_hash'], $_SESSION['otp_expiry']);
        } else {
            // trow error for incorrect OTP
            throw new ValidationException(['verificationCode' => ['Invalid verification code']]);
        }
    }

    public function resendOtp()
    {
        $this->userService->sendVerificationCode($_SESSION['tempUser']['email']);
        redirectTo('register/verification');
    }

    public function loginView()
    {
        echo $this->view->render("login.php", [
            "title" => "Login"
        ]);
    }

    public function login()
    {
        $this->validatorService->validateLogin($_POST);
        $this->userService->login($_POST);

        redirectTo('/dashboard');
    }

    public function logout()
    {
        $this->userService->logout();
        redirectTo('/login');
    }

    public function createTutorProfileView()
    {
        $subjects = $this->SubjectService->getSubjects();
        echo $this->view->render(
            "User/Tutor/create_tutor_profile.php",
            [
                "title" => "creat your profile",
                'subjects' => $subjects,
            ]
        );
    }

    public function updateTutorProfileView($params)
    {
        $subjects = $this->SubjectService->getSubjects();
        $tutorBasic = $this->userService->getTutorbasic($params['tutor-id']);
        $tutorSubjects = $this->userService->getTutorSubjects($params['tutor-id']);
        $tutorEducations = $this->userService->getTutorEducations($params['tutor-id']);
        $tutorAvailablities = $this->userService->getTutorAvailability($params['tutor-id']);
        // dd($tutorAvailablities);
        echo $this->view->render(
            "User/Tutor/update_tutor_profile.php",
            [
                "title" => "creat your profile",
                'subjects' => $subjects,
                'tutorBasic' => $tutorBasic,
                'tutorSubjects' => $tutorSubjects,
                'tutorEducations' => $tutorEducations,
                'tutorAvailablities' => $tutorAvailablities,
            ]
        );
    }


    public function createTutorProfile()
    {
        $this->userService->createTutorProfile($_POST);
        redirectTo("/dashboard");
    }

    public function updateTutorProfile()
    {
        $this->userService->updateTutorProfile($_POST);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function deleteTutorExperience($params)
    {
        $this->userService->deleteTutorExperienceByIDs($params['tutor_id'], $params['subject_id']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }
}
