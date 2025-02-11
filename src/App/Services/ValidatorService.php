<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\{RequiredRule, EmailRule, InRule, MatchRule, MinRule, UrlRule};
use Framework\Validator;
use Framework\Exceptions\ValidationException;

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->validator->add('required', new RequiredRule());
        $this->validator->add('email', new EmailRule());
        $this->validator->add('min', new MinRule());
        $this->validator->add('in', new InRule());
        $this->validator->add('url', new UrlRule());
        $this->validator->add('match', new MatchRule());
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            "first_name" => ["required"],
            "last_name" => ["required"],
            "email" => ["required", "email"],
            "date_of_birth" => ["required"],
            "password" => ["required"],
            "confirmPassword" => ["required", "match:password"],
        ]);
    }

    public function validateLogin(array $formData)
    {
        $this->validator->validate($formData, [
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);
    }

    public function validateCourse(array $formData)
    {
        $this->validator->validate($formData, [
            "title" => ["required"],
            "description" => ["required"],
            "subject_id" => ["required"],
            "grade_id" => ["required"],
            "start_time" => ["required"],
            "end_time" => ["required"],
            "day" => ["required"],
            "price" => ["required"],
            "pricing_period" => ["required"],
            "location" => ["required"],
        ]);
    }

    public function validateCourseRequest(array $formData)
    {
        $this->validator->validate($formData, [
            "requestTitle" => ["required"],
            "requestDescription" => ["required"],
            "subject_id" => ["required"],
        ]);
    }

    public function validateCourseRequestComment(array $formData)
    {
        $this->validator->validate($formData, [
            "comment" => ["required"],
        ]);
    }
    public function validateContactForm(array $formData)
    {
        $this->validator->validate($formData, [
            "name" => ["required"],
            "email" => ["required", "email"],
            "message" => ["required"],
        ]);
    }

    public function validateImg(?array $file)
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new ValidationException([
                "img" => ['Failed to upload file.']
            ]);
        }

        $maxSize = 10 * 1024 * 1024;

        if ($file['size'] > $maxSize) {
            throw new ValidationException([
                "img" => ['File size is too large. Max file size is 10MB.']
            ]);
        }

        $mimeType = $file['type'];
        if (!preg_match('/^image\/.*/', $mimeType)) {
            throw new ValidationException([
                "img" => ['Invalid file type. Only image files are allowed.']
            ]);
        }
    }
    public function validateFile(?array $file)
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new ValidationException([
                "file" => ['Failed to upload file.']
            ]);
        }

        $maxSize = 50 * 1024 * 1024;

        if ($file['size'] > $maxSize) {
            throw new ValidationException([
                "file" => ['File size is too large. Max file size is 50MB.']
            ]);
        }

        // $mimeType = $file['type'];
        // if (!preg_match('/^image\/.*/', $mimeType)) {
        //     throw new ValidationException([
        //         "img" => ['Invalid file type. Only image files are allowed.']
        //     ]);
        // }
    }
}
