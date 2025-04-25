<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\{
    CsrfGuardMiddleware,
    CsrfTokenMiddleware,
    FlashMiddleware,
    SessionMiddleware,
    TemplateDataMiddleware,
    ValidationExceptionMiddleware,
    ServerErrorMiddleware
};

function registerMiddleware(App $app)
{
    $app->addMiddleware(CsrfGuardMiddleware::class);
    $app->addMiddleware(CsrfTokenMiddleware::class);
    $app->addMiddleware(TemplateDataMiddleware::class);
    $app->addMiddleware(FlashMiddleware::class);
    $app->addMiddleware(SessionMiddleware::class);

    /*
    * Error handling middleware should be added last, ensuring it executes first.
    * This allows it to wrap other middleware in a try-catch block, catching any exceptions thrown by them.
    * If an error occurs, the error handling middleware can handle it in the catch block.
    */

    $app->addMiddleware(ValidationExceptionMiddleware::class);
    $app->addMiddleware(ServerErrorMiddleware::class);
}
