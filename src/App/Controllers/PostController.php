<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\CourseRequestService;
use App\Services\SubjectService;
use App\Services\ValidatorService;
use Framework\TemplateEngine;

class PostController
{

    public function __construct(
        private TemplateEngine $view,
        private SubjectService $subjectService,
        private CourseRequestService $courseRequestService,
        private ValidatorService $validatorService
    ) {}

    public function requestDetails(array $params)
    {
        $requestId = $params["id"];

        $request = $this->courseRequestService->getCourseReuqestById($requestId);
        $comments = $this->courseRequestService->getCommentsByRequestId($requestId);

        echo $this->view->render('post/courseRequestDetails.php', [
            "title" => "Course Request",
            "requestId" => $requestId,
            "request" => $request,
            "comments" => $comments,
        ]);
    }

    public function courseRequest()
    {
        $courseRequests = $this->courseRequestService->getCourseRequestsforView();
        echo $this->view->render('post/CourseRequests.php', [
            "title" => "Course Requests",
            "courseRequests" => $courseRequests
        ]);
    }
    public function approvedCourseRequestView()
    {
        $courseRequests = $this->courseRequestService->getApprovedCourseRequests();
        echo $this->view->render('post/CourseRequests.php', [
            "title" => "Course Requests",
            "courseRequests" => $courseRequests
        ]);
    }

    public function approveCourseRequest()
    {
        header('Content-Type: application/json');

        $input = file_get_contents('php://input');
        $req = json_decode($input, true);
        $postId = $req['postId'];
        $this->courseRequestService->approveCourseRequestById($postId);
        $data = [
            'success' => true,
            'message' => 'Post approved successfully'
        ];
        echo json_encode($data);
    }

    public function rejectCourseRequest()
    {

        header('Content-Type: application/json');

        $input = file_get_contents('php://input');
        $req = json_decode($input, true);
        $postId = $req['postId'];
        $this->courseRequestService->rejectCourseRequestById($postId);
        $data = [
            'success' => true,
            'message' => 'Post rejected successfully'
        ];
        echo json_encode($data);
    }

    public function createCourseRequestView()
    {
        $subjects = $this->subjectService->getSubjects();
        echo $this->view->render('post/create.php', [
            'title' => 'Create Course Request',
            'subjects' => $subjects
        ]);
    }

    public function updateCourseRequestView(array $params)
    {
        $subjects = $this->subjectService->getSubjects();
        $request = $this->courseRequestService->getCourseReuqestById($params['id']);
        echo $this->view->render('post/updateCourseRequest.php', [
            'title' => 'Update Course Request',
            'subjects' => $subjects,
            'oldRequestData' => $request
        ]);
    }

    public function updateCourseRequest(array $params)
    {
        $requestId = $params['id'];
        $this->validatorService->validateCourseRequest($_POST);
        $this->courseRequestService->updateCourseRequestById($_POST, $requestId);
        redirectTo('/course/request/' . $requestId);
    }

    public function updateComment(array $params)
    {
        $this->validatorService->validateCourseRequestComment($_POST);
        $this->courseRequestService->updateCommentById($_POST, $params["requestId"], $params["commentId"]);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function createCourseRequest()
    {
        $rawData = file_get_contents('php://input');

        // Decode the JSON data into a PHP array/object
        $data = json_decode($rawData, true);


        header('Content-Type: text/plain'); // To make the output readable in browser or API tool
        // $this->validatorService->validateCourseRequest($_POST);
        $this->courseRequestService->create($data);
        // redirectTo('/course/request');

        $res = [
            'success' => true,
            'message' => 'Post approved successfully'
        ];
        echo json_encode($data);
    }

    public function createComment(array $params)
    {
        $this->validatorService->validateCourseRequestComment($_POST);
        $this->courseRequestService->createComment($_POST, $params['id']);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function deleteCourseRequest(array $params)
    {
        $this->courseRequestService->deleteCourseRequestById($params["id"]);
        redirectTo($_SERVER['HTTP_REFERER']);
    }
    public function deleteComment(array $params)
    {
        $this->courseRequestService->deleteCommentById($params["requestId"], $params["commentId"]);
        redirectTo($_SERVER['HTTP_REFERER']);
    }
}
