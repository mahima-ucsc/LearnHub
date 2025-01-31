<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class AssignmentController
{
    public function __construct(private TemplateEngine $view) {}

    public function createAssignment()
    {
        echo $this->view->render("Assignment/create.php", [
            "title" => "Create Assignment"
        ]);
    }
    public function submitAssignment()
    {
        echo $this->view->render("Assignment/assingment.php", [
            "title" => "Create Assignment"
        ]);
    }
    public function review()
    {
        echo $this->view->render("Assignment/review.php", [
            "title" => "Create Assignment"
        ]);
    }
}
