<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Rules\{DateShouldNotBeFutureRule, DateShouldNotBePastRule, RequiredRule, EmailRule, InRule, MatchRule, MinRule, PhoneNumberRule, StartDateEndDateCompareRule, StartTimeEndTimeCompareRule, UrlRule, MaxRule};
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
        $this->validator->add('max', new MaxRule());
        $this->validator->add('in', new InRule());
        $this->validator->add('url', new UrlRule());
        $this->validator->add('match', new MatchRule());
        $this->validator->add('notFutureDate', new DateShouldNotBeFutureRule());
        $this->validator->add('notPastDate', new DateShouldNotBePastRule());
        $this->validator->add('phoneno', new PhoneNumberRule());
        $this->validator->add('dateCompare', new StartDateEndDateCompareRule());
        $this->validator->add('timeCompare', new StartTimeEndTimeCompareRule());
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            "first_name" => ["required"],
            "last_name" => ["required"],
            "email" => ["required", "email"],
            "date_of_birth" => ["required", "notFutureDate"],
            "password" => ["required", "min:8"],
            "confirmPassword" => ["required", "match:password"]
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
            "description" => ["required", "max:100"],
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
            "title" => ["required", "max:100"],
            "description" => ["required"],
            "subject" => ["required"],
            "grade" => ["required"],
            "location" => ["required"],
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

    public function validateUpdateProfileDetails(array $formData)
    {
        $rules = [
            "first_name" => ["required"],
            "last_name" => ["required"],
            "email" => ["required", "email"],
            "date_of_birth" => ["required", "notFutureDate"],
        ];

        if (!empty($formData['phone_no'])) {
            $rules["phone_no"] = ["phoneno"];
        }

        $this->validator->validate($formData, $rules);
    }

    public function validateResource(array $formData)
    {
        $rules = [
            "title" => ["required"],
            "description" => ["required"],
            "type" => ["required"],
            "category" => ["required"],


        ];
        // Validate the URL only if it is provided
        if (!empty($formData['resource_url'])) {
            $rules["resource_url"] = ["url"];
        }


        // Conditionally validate price if the resource is not free
        if (empty($formData['is_free']) || $formData['is_free'] == "0") {
            $rules["price"] = ["required", "min:0.99"];
        }

        $this->validator->validate($formData, $rules);
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

    public function validateCourseWithImage(array $formData, ?array $image)
    {
        $errors = [];

        try {
            $this->validateCourseData($formData);
        } catch (ValidationException $e) {
            $errors = $e->errors;
        }

        // Try to validate image
        try {
            $this->validateImg($image);
        } catch (ValidationException $e) {
            // Merge with any existing errors
            $errors = array_merge($errors, $e->errors);
        }

        // If we collected any errors, throw a combined validation exception
        if (!empty($errors)) {
            throw new ValidationException($errors);
        }
    }

    public function validateCourseData(array $formData)
    {
        $rules = [
            'courseTitle' => ['required'],
            'courseDescription' => ['required'],
            'subject' => ['required'],
            'grade' => ['required'],
            'courseStartTime' => ['required'],
            'courseEndTime' => ['required', 'timeCompare:courseStartTime'],
            'courseday' => ['required'],
            'courseType' => ['required', 'in:onetime,recurring'],
            'location' => ['required'],
        ];

        if (isset($formData['courseType'])) {
            if ($formData['courseType'] === 'onetime') {
                $rules['fullCoursePrice'] = ['required'];
            }
        }

        $this->validator->validate($formData, $rules);
    }

    public function validateModuleData(array $formData)
    {
        $rules = [
            "moduleTitle" => ['required'],
            "moduleDescription" => ['required'],
            "accessPeriod" => ['required']
        ];

        if (!empty($formData['moduleAccessPeriod']) && $formData['moduleAccessPeriod'] == 'on') {
            $rules['moduleAccessPeriodStartDate'] = ['required'];
            $rules['moduleAccessPeriodEndDate'] = ['required', 'dateCompare:moduleAccessPeriodStartDate'];
            $rules['price'] = ['required'];

            if (!empty($formData['moduleFreeTrial']) && $formData['moduleFreeTrial'] == "on") {
                $rules['moduleFreeTrialStartDate'] = ['required'];
                $rules['moduleFreeTrialEndDate'] = ['required', 'dateCompare:moduleFreeTrialStartDate'];
            }
        }

        $this->validator->validate($formData, $rules);
    }
}
