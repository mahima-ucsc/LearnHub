<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;


class ContactController
{
    public function __construct(private TemplateEngine $view) {}

    public function submitContactForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate the POST data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['msg']);

        // Store the data in the database
        $contact = new Contact();
        $contact->save([
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);

        // Redirect or return a response
        header('Location: /thank-you');
        exit;
        }
    }
}
