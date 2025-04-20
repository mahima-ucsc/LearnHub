<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{UserService, ValidatorService};

class UserController
{
    public function __construct(
        private TemplateEngine $templateEngine,
        private UserService $userService,
        private ValidatorService $validatorService,
    ) {}

    public function deleteUser(array $params)
    {
        if ($_SESSION['user_role'] != 'admin') {
            redirectTo('/denied');
        }
        $this->userService->delete((int)$params['user_id']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function addUser()
    {
        $this->userService->isEmailTaken($_POST['email']);
        $this->userService->addUser($_POST);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function updateProfile()
    {
        $this->validatorService->validateUpdateProfileDetails($_POST);
        $this->userService->canChangeEmail($_POST['email']);
        $this->userService->updateProfile($_POST);
        redirectTo('/settings');
    }

    public function updatePassword()
    {
        $this->userService->updatePassword($_POST);
        redirectTo('/settings');
    }
}
