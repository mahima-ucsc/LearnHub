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
}
