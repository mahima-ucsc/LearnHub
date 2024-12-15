<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\UserService;

class UserController
{
    public function __construct(
        private TemplateEngine $templateEngine,
        private UserService $userService
    ) {}

    public function deleteUser(array $params)
    {
        if ($_SESSION['user_role'] != 'admin') {
            redirectTo('/denied');
        }
        $this->userService->delete((int)$params['user_id']);
        redirectTo('/admin-dashboard?tab=user-managment');
    }
}
