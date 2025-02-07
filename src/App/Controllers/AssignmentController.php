<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

use App\Services\{AssignmentService};
use PDO;

class AssignmentController
{
    public function __construct(
        private TemplateEngine $view,
        private AssignmentService $assignmentService
    ) {}

    public function createAssignmentView()
    {
        echo $this->view->render("Assignment/create.php", [
            "title" => "Create Assignment"
        ]);
    }
    public function createAssignment(array $params)
    {
        $this->assignmentService->create($_POST, $params['courseId'], $_FILES);
    }
    public function submitAssignment()
    {
        echo $this->view->render("Assignment/assingment.php", [
            "title" => "Submit Assignment"
        ]);
    }
    public function review()
    {
        echo $this->view->render("Assignment/review.php", [
            "title" => "Review Assignment"
        ]);
    }
    public function assignmentView(array $params)
    {
        $assignment = $this->assignmentService->getAssignment($params['assignment_id']);
        $resources = $this->assignmentService->getAssignmentResource($assignment['assignment_id']);
        echo $this->view->render("Assignment/assignment.php", [
            "title" => $assignment['title'],
            "assignment" => $assignment,
            'resources' => $resources
        ]);
    }
    public function getData(array $params)
    {
        $assignment = $this->assignmentService->getAssignment($params['assignment_id']);
        echo json_encode($assignment);
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
}
