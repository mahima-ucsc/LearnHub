<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\AdvertisementService;

class AdvertisementController
{
    public function __construct(private TemplateEngine $view, private AdvertisementService $advertisementService) {}

    public function createView()
    {
        echo $this->view->render(
            "Advertisement/create.php",
            [
                'title' => "Create Advertisement"
            ]
        );
    }

    public function create()
    {
        $this->advertisementService->create($_POST, $_FILES);
    }
    public function approve()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $adId = $data['adId'] ?? null;
        $success = $this->advertisementService->approve($adId);
        $data = [
            "success" => $success,
            "data" => $adId
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public function reject()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $adId = $data['adId'] ?? null;
        $success = $this->advertisementService->reject($adId);
        $data = [
            "success" => $success,
            "data" => $adId
        ];

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
