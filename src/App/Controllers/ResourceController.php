<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\ResourceService;


class ResourceController
{
    public function __construct(
        private TemplateEngine $view,
        private ResourceService $resourceService
    ) {}

    public function resource()
    {
        $resources = $this->resourceService->getAllResources();
        echo $this->view->render('Resource/resource.php', [
            'title' => 'Resource',
            'resources' => $resources
        ]);
    }

    public function resourceCreateView()
    {
        echo $this->view->render('Resource/resource_create.php', [
            'title' => 'Create Resource'
        ]);
    }

    public function myResources()
    {
        $resources = $this->resourceService->getMyResources();
        echo $this->view->render('Resource/my_resources.php', [
            'title' => 'My Resources',
            'resources' => $resources
        ]);
    }

    public function saveResource()
    {
        $this->resourceService->create($_POST);
        redirectTo("/resource/my-resources");
    }

    public function deleteResource(array $params)
    {

        $this->resourceService->delete((int)$params['resource']);
        redirectTo('/resource/my-resources');
    }


    public function editView(array $params)
    {
        $resource = $this->resourceService->getResourceById((int)$params['id']);

        if (!$resource) {
            redirectTo('/resource/my-resources');
        }

        echo $this->view->render('Resource/edit_resource.php', [
            'title' => 'Edit Resource',
            'resource' => $resource
        ]);
    }

    public function edit(array $params)
    {
        $formData = $_POST;
        $id = (int)$params['id'];

        // Handle file upload if exists
        // if (!empty($_FILES['fileUpload']['name'])) {
        //     $fileData = $_FILES['fileUpload'];
        //     // $attachmentLink = $this->handleFileUpload($fileData);
        //     // $formData['attachment_link'] = $attachmentLink;
        // }

        // Set price to NULL if type is FREE
        if ($formData['type'] === '1') {
            $formData['price'] = NULL;
        }

        $this->resourceService->update($id, $formData);
        redirectTo('/resource/my-resources');
    }
}
