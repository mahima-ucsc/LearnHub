<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class AuthController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userService,
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
        $this->userService->create($_POST);
        redirectTo('/interest');
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

        if ($_SESSION['user_role'] === "admin") {
            redirectTo('/admin-dashboard');
        } else if ($_SESSION['user_role'] === 'teacher') {
            redirectTo('/dashboard');
        } else {
            redirectTo('/profile');
        }
    }

    public function logout()
    {
        $this->userService->logout();
        redirectTo('/login');
    }
}
