<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

use App\Services\{AssignmentService, CourseService};
use PDO;

class AssignmentController
{
    public function __construct(
        private TemplateEngine $view,
        private AssignmentService $assignmentService,
        private CourseService $courseService
    ) {}

    public function createAssignmentView()
    {
        echo $this->view->render("Assignment/create.php", [
            "title" => "Create Assignment"
        ]);
    }
    public function createAssignment(array $params)
    {
        $assignmentId = $this->assignmentService->create($_POST, $params['courseId'], $_FILES);
        if ($assignmentId) {
            redirectTo("/courses/{$params['courseId']}/assignment/{$assignmentId}");
        }
    }
    public function review(array $param)
    {
        $courseId = $param["courseId"];
        $assignmentId = $param["assignment_id"];
        $submissions = $this->assignmentService->getSubmission($courseId, $assignmentId);
        echo $this->view->render("Assignment/review.php", [
            "title" => "Review Assignment",
            "submissions" => $submissions
        ]);
    }
    public function assignmentView(array $params)
    {
        $course = $this->courseService->getCourseById($params['courseId']);
        $assignment = $this->assignmentService->getAssignment($params['assignment_id']);
        $resources = $this->assignmentService->getAssignmentResource($assignment['assignment_id']);
        $submission = $this->assignmentService->getUserSubmission();
        // dd($assignment);
        echo $this->view->render("Assignment/assignment_view.php", [
            "title" => $assignment['title'],
            "assignment" => $assignment,
            'resources' => $resources,
            'course' => $course,
            'submission' => $submission
        ]);
    }

    public function getResource(array $params)
    {
        $assignment = $this->assignmentService->getAssignment($params['assignment_id']);
        if (empty($assignment)) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }

        $resource = $this->assignmentService->getResourceById($params['resource_id']);
        if (empty($assignment)) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }

        if ($resource['assignment_id'] !== $assignment['assignment_id']) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }

        $this->assignmentService->readResource($resource);
    }

    public function editAssignment(array $params)
    {
        $assignment = $this->assignmentService->getAssignment($params['assignment_id']);
        $resources = $this->assignmentService->getAssignmentResource((int)$params['assignment_id']);
        $title =  "Edit - " . $assignment['title'];
        echo $this->view->render("Assignment/edit.php", [
            "title" => $title,
            "assignment" => $assignment,
            "resources" => $resources,
        ]);
    }
    public function updateAssignment(array $params)
    {
        $this->assignmentService->update($_POST, $params['courseId'], $params['assignment_id'], $_FILES);
    }


    public function submitAssignment(array $params)
    {
        $this->assignmentService->submitAssignment($params['courseId'], $params['assignment_id'], $_FILES);
        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function getSubmissionFile(array $params)
    {
        $submission = $this->assignmentService->getSubmissionById($params['submission_id']);
        if (empty($submission)) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }

        $attachment = $this->assignmentService->getSubmissionAttachment($params['attachment_id']);
        if (empty($attachment)) {
            redirectTo($_SERVER['HTTP_REFERER']);
        }

        $this->assignmentService->readAttachment($attachment);
    }

    public function submit()
    {

        try {
            // Validate required POST data
            if (!isset($_POST['submission_id']) || !isset($_POST['feedback']) || !isset($_POST['grade'])) {
                echo json_encode(['success' => false, 'message' => 'Missing required data']);
                return;
            }

            $res = $this->assignmentService->submissionReview($_POST['submission_id'], $_POST['feedback'], (int)$_POST['grade']);
            echo json_encode(['success' => true, 'data' => $res]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function removeSubmissionFile(array $param)
    {
        $this->assignmentService->removeSubmissionFile($param['submission_id'], $param['attachment_id']);
    }
}
