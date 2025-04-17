<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;

class NotificationMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        if (empty($_SESSION['user'])) {
            http_response_code(401);
            echo 'Unauthorized';
            exit;
        }

        $next();
    }
}
