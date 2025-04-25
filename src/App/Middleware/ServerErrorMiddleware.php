<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use RuntimeException;

class ServerErrorMiddleware implements MiddlewareInterface
{
    public function process(callable $next)
    {
        try {
            $next();
        } catch (RuntimeException $e) {
            redirectTo('/server-error');
        }
    }
}
