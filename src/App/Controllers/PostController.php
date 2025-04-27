<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\CourseRequestService;
use App\Services\{SubjectService, CourseService};
use App\Services\ValidatorService;
use Framework\TemplateEngine;

class PostController
{

    public function __construct(
        private TemplateEngine $view,
        private SubjectService $subjectService,
        private CourseRequestService $courseRequestService,
        private ValidatorService $validatorService,
        private CourseService $courseService
    ) {}

    public function requestDetails(array $params)
    {
        $requestId = $params["id"];

        $request = $this->courseRequestService->getCourseReuqestById($requestId);
        $comments = $this->courseRequestService->getCommentsByRequestId($requestId);

        echo $this->view->render('post/single_course_request.php', [
            "title" => "Course Request",
            "requestId" => $requestId,
            "request" => $request,
            "comments" => $comments,
        ]);
    }

    public function courseRequest()
    {
        $courseRequests = $this->courseRequestService->getCourseRequestsforView();
        echo $this->view->render('post/course_requests.php', [
            "title" => "Course Requests",
            "courseRequests" => $courseRequests
        ]);
    }
    public function CourseRequestView()
    {
        $searchTerm = trim($_GET['s'] ?? '');
        $subject = $_GET['subject'] ?? 'all';
        $grade = $_GET['grade'] ?? 'all';
        $sort = $_GET['sort'] ?? 'recent';

        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 6;
        $offset = ($page - 1) * $length;

        [$courseRequests, $requestCount] =
            $this->courseRequestService->getApprovedCourseRequests($length, $offset, $searchTerm, $subject, $grade, $sort);

        $lastPage = ceil($requestCount / $length);
        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLinks = array_map(
            (fn($searchTerm, $subject, $grade, $sort) => fn($pageNum) => http_build_query([
                'p' => $pageNum,
                's' =>  $searchTerm,
                'subject' => $subject,
                'grade' => $grade,
                'sort' => $sort
            ]))(
                $searchTerm,
                $subject,
                $grade,
                $sort
            ),
            $pages
        );

        $subjects = $this->subjectService->getSubjects();
        $grades = $this->courseService->getGrades();

        echo $this->view->render('post/course_requests.php', [
            "title" => "Course Requests",
            "courseRequests" => $courseRequests,
            'subjects' => $subjects,
            'grades' => $grades,
            'requestCount' => $requestCount,
            "currentPage" => $page,
            "previousPageQuery" => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm,
                'subject' => $subject,
                'grade' => $grade,
                'sort' => $sort
            ]),
            'lastPage' => $lastPage,
            "nextPageQuery" => http_build_query([
                'p' => $page + 1,
                's' => $searchTerm,
                'subject' => $subject,
                'grade' => $grade,
                'sort' => $sort
            ]),
            "pageLinks" => $pageLinks,
            'filter_s' => $searchTerm,
            'filter_subject' => $subject,
            'filter_grade' => $grade,
            'filter_sort' => $sort
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
        $grades = $this->courseService->getGrades();
        echo $this->view->render('post/create.php', [
            'title' => 'Create Course Request',
            'subjects' => $subjects,
            'grades' => $grades
        ]);
    }

    public function editCourseRequestView(array $params)
    {
        $subjects = $this->subjectService->getSubjects();
        $grades = $this->courseService->getGrades();
        $request = $this->courseRequestService->getCourseReuqestById($params['request_id']);
        if ($request['user_id'] != $_SESSION['user']) {
            redirectTo('/unauthorized-access');
        }
        echo $this->view->render('post/edit.php', [
            'title' => 'Update Course Request',
            'subjects' => $subjects,
            'request' => $request,
            'grades' => $grades
        ]);
    }

    public function updateCourseRequest(array $params)
    {
        $requestId = $params['request_id'];
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
        $this->validatorService->validateCourseRequest($_POST);
        $this->courseRequestService->create($_POST);
        redirectTo('/course/request');
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

    public function managmentView()
    {
        $posts = $this->courseRequestService->getUserCourseRequest((int)$_SESSION['user']);
        // dd($posts);
        echo $this->view->render("/post/user_course_request.php", [
            "title" => "Post Managment",
            "posts" => $posts
        ]);
    }

    public function getCourseRequestsOfLoggedInUserView()
    {
        $searchTerm = trim($_GET['s'] ?? '');
        $subject = $_GET['subject'] ?? 'all';
        $grade = $_GET['grade'] ?? 'all';
        $sort = $_GET['sort'] ?? 'recent';

        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 6;
        $offset = ($page - 1) * $length;

        [$courseRequests, $requestCount] =
            $this->courseRequestService->getUserCourseRequests(
                $length,
                $offset,
                (string) $_SESSION['user'],
                $searchTerm,
                $subject,
                $grade,
                $sort
            );

        $lastPage = ceil($requestCount / $length);
        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLinks = array_map(
            (fn($searchTerm, $subject, $grade, $sort) => fn($pageNum) => http_build_query([
                'p' => $pageNum,
                's' =>  $searchTerm,
                'subject' => $subject,
                'grade' => $grade,
                'sort' => $sort
            ]))(
                $searchTerm,
                $subject,
                $grade,
                $sort
            ),
            $pages
        );

        $subjects = $this->subjectService->getSubjects();
        $grades = $this->courseService->getGrades();

        echo $this->view->render('post/my_course_requests.php', [
            "title" => "Course Requests",
            "courseRequests" => $courseRequests,
            'subjects' => $subjects,
            'grades' => $grades,
            'requestCount' => $requestCount,
            "currentPage" => $page,
            "previousPageQuery" => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm,
                'subject' => $subject,
                'grade' => $grade,
                'sort' => $sort
            ]),
            'lastPage' => $lastPage,
            "nextPageQuery" => http_build_query([
                'p' => $page + 1,
                's' => $searchTerm,
                'subject' => $subject,
                'grade' => $grade,
                'sort' => $sort
            ]),
            "pageLinks" => $pageLinks,
            'filter_s' => $searchTerm,
            'filter_subject' => $subject,
            'filter_grade' => $grade,
            'filter_sort' => $sort
        ]);
    }
}
