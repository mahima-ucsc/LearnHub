<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class TeacherOnlyMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        if (empty($_SESSION['user']) || empty($_SESSION['user_role'])) {
            redirectTo('/login');
        }

        if ($_SESSION['user_role'] != "teacher") {
            redirectTo('/login');
        }

        $next();
    }
}
