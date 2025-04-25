<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config\Paths;
use Framework\TemplateEngine;
use App\Services\ResourceService;
use App\Services\ValidatorService;

use Error;
use Exception;

class ResourceController
{
    public function __construct(private TemplateEngine $view, private ResourceService $resourceService,  private ValidatorService $validatorService) {}

    // public function resource()
    // {

    //     $page = (int) ($_GET['p'] ?? 1);
    //     $itemsPerPage = 6;
    //     $offset = ($page - 1) * $itemsPerPage;

    //     // Get search parameters
    //     $searchParams = [
    //         's' => $_GET['s'] ?? '',
    //         'subject' => $_GET['subject'] ?? 'all',
    //         'type' => $_GET['type'] ?? 'all',
    //         'category' => $_GET['category'] ?? 'all',
    //         'price' => $_GET['price'] ?? 'all',
    //         'sort' => $_GET['sort'] ?? '',
    //     ];

    //     [$resouces, $resourceCount] = $this->resourceService->searchResource(
    //         $itemsPerPage,
    //         $offset
    //     );

    //     $pagination = generatePagination($resourceCount, $page, $itemsPerPage, $searchParams);

    //     echo $this->view->render('Resource/resource.php', [
    //         'title' => 'Resource',
    //         'resources' => $resouces,
    //         'pagination' => $pagination,
    //         'resourceCount' => $resourceCount
    //     ]);
    // }
    public function listResources()
    {
        $page = (int) ($_GET['p'] ?? 1);
        $itemsPerPage = 6;
        $offset = ($page - 1) * $itemsPerPage;

        $filters = [
            's' => $_GET['s'] ?? '',
            'type' => $_GET['type'] ?? 'all',
            'category' => $_GET['category'] ?? 'all',
            'price' => $_GET['price'] ?? 'all',

        ];

        $resources = $this->resourceService->getFilteredResources($filters);
        $resourceCount = count($resources);

        $pagination = generatePagination($resourceCount, $page, $itemsPerPage, $filters);


        echo $this->view->render('Resource/resource.php', [
            'title' => 'Resource',
            'resources' => $resources,
            'resourceCount' => $resourceCount,
            'pagination' => $pagination,
        ]);
    }

    public function createView()
    {
        echo $this->view->render('Resource/create.php', [
            'title' => 'Resource'
        ]);
    }



    public function createResource()
    {

        // Validate the form data
        $this->validatorService->validateResource($_POST);

        // Process the resource creation
        $this->resourceService->create($_POST, $_FILES);

        // Redirect to the success page
        redirectTo('/resource/my-resources');
    }
    public function myResources()
    {
        $userId = $_SESSION['user'];
        $resources = $this->resourceService->getResourcesByUser((int)$userId);

        echo $this->view->render('Resource/my_resources.php', [
            'title' => 'My Resources',
            'resources' => $resources
        ]);
    }

    public function deleteResource(array $params)
    {
        $resourceId = (int)$params['resource_id'];

        // Ensure the resource belongs to the logged-in user
        $userId = (int)$_SESSION['user']; // Assuming user_id is stored in the session
        $isDeleted = $this->resourceService->deleteResource($resourceId, $userId);

        if ($isDeleted) {
            redirectTo($_SERVER['HTTP_REFERER']); // Redirect to the resources page
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

    public function approveResource(array $params)
    {

        try {
            $this->resourceService->approveResource((string)$params['resource_id']);
            redirectTo('/resource-managment');
        } catch (Exception $e) {
            error_log("Error approving resource: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }
    public function rejectResource(array $params)
    {

        try {
            $this->resourceService->rejectResource((string)$params['resource_id']);
            redirectTo('/resource-managment');
        } catch (Exception $e) {
            error_log("Error approving resource: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }
    public function deleteResourceAdmin(array $params)
    {

        try {
            $this->resourceService->deleteResourceAdmin((string)$params['resource_id']);
            redirectTo('/resource-managment');
        } catch (Exception $e) {
            error_log("Error approving resource: " . $e->getMessage());
            redirectTo('/server-error');
        }
    }

    public function downloadResource(array $params)
    {
        $resourceId = (int)$params['resource_id'];
        $resource = $this->resourceService->getResourceByIdDownload($resourceId);

        if (!$resource || $resource['is_free'] != 1) {
            // Redirect back if the resource is not free or doesn't exist
            redirectTo('/resource');
        }

        $filePath = Paths::STORAGE_UPLOADS . '/resources/' . $resource['resource_path'];

        if (!file_exists($filePath)) {
            echo "File not found.";
            return;
        }

        // Set headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        // Read the file and output it
        readfile($filePath);
        exit;
    }
}
