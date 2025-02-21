<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{UserService, ValidatorService};
use Framework\Container;

class ContactController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {}

    public function contact()
    {
        echo $this->view->render('contact.php', [
            "title" => "contact-us"
        ]);
    }

    //hadle submission
    public function submitContactForm()
    {
        // dd('submitContactForm');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'message' => trim($_POST['message'])
            ];
            //validate form data
            $errors = $this->validatorService->validateContactForm($data);
            $this->userService->sendContactMail($data);
            redirectTo('/contact/successfull');
        }
    }

    public function successfull()
    {
        echo $this->view->render('contact_success.php', [
            "title" => "contact-success"
        ]);
    }
}
