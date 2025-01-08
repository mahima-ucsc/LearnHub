<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class NotificationController
{

    public function __construct(
        private TemplateEngine $view,
    ) {}

    public function getTestNotification()
    {

        echo $this->view->renderJson([
            "testKey1" => "Test Value 1",
            "testKey2" => "Test Value 2",
        ]);
    }
}
