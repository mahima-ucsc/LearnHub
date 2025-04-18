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
}
