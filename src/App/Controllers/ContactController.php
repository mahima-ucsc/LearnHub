<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ContactService, ValidatorService};
use Framework\Container;

class ContactController
{
    public function __construct(
        private TemplateEngine $view,
        private ContactService $ContactService,
        private ValidatorService $validatorService
    ) {}

    //hadle submission
    public function submitContactForm()
    {
        dd($_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'message' => trim($_POST['message'])
            ];
            //validate form data
            $errors = $this->validatorService->validateContactForm($data);

            if (empty($errors)) {
                $to = 'dinukasahan2020@gmail.com';
                $subject = 'contact form submission';
                $message = "name: {$data['name']}\nEmail: {$data['email']}\nMessage: {$data['message']}";
                $from = $data['email'];

                $success = $this->ContactService->sendMail($to, $subject, $message, $from);
                if ($success) {
                    // Redirect to a success page or show a success message
                    $_SESSION['success_message'] = "Message sent successfully.";
                    exit;
                } else {
                    // Display an error if email sending fails
                    $_SESSION['error_message'] = "Failed to send the message. Please try again later.";
                }
                redirectTo($_SERVER['HTTP_REFERER']);
            }
        }
    }
}
