<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\ResourceService;


class ResourceController
{
    public function __construct(private TemplateEngine $view, private ResourceService $resourceService) {}

    public function resource()
    {
        $resouces = $this->resourceService->getResources();
        // dd($resouces);
        echo $this->view->render('Resource/resource.php', [
            'title' => 'Resource',
            'resources' => $resouces
        ]);
    }
    public function createView()
    {
        echo $this->view->render('Resource/create.php', [
            'title' => 'Resource'
        ]);
    }

    public function create()
    {
        // dd($_POST);
        $this->resourceService->create($_POST, $_FILES);
    }
    public function myResources()
    {
        $userId = $_SESSION['user'];
        $resources = $this->resourceService->getResourcesByUser($userId);

        echo $this->view->render('Resource/my_resources.php', [
            'title' => 'My Resources',
            'resources' => $resources
        ]);
    }

    public function deleteResource(array $params)
    {
        $resourceId = (int)$params['resource_id'];

        // Ensure the resource belongs to the logged-in user
        $userId = $_SESSION['user']; // Assuming user_id is stored in the session
        $isDeleted = $this->resourceService->deleteResource($resourceId, $userId);

        if ($isDeleted) {
            redirectTo('/resource/my-resources'); // Redirect to the resources page
        } else {
            echo "Failed to delete the resource.";
        }
    }

    public function editView(array $params)
    {
        $resourceId = (int)$params['resource_id'];
        $userId = $_SESSION['user']; // Assuming user_id is stored in the session

        $resource = $this->resourceService->getResourceById($resourceId, $userId);

        if (!$resource) {
            echo "Resource not found.";
            return;
        }

        echo $this->view->render('Resource/edit.php', [
            'title' => 'Edit Resource',
            'resource' => $resource
        ]);
    }

    public function updateResource(array $params)
    {
        $resourceId = (int)$params['resource_id'];
        $userId = $_SESSION['user']; // Assuming user_id is stored in the session

        $isUpdated = $this->resourceService->updateResource($resourceId, $userId, $_POST);

        if ($isUpdated) {
            redirectTo('/resource/my-resources'); // Redirect to the resources page
        } else {
            echo "Failed to update the resource.";
        }
    }
}
