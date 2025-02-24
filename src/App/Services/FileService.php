<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use App\Config\Paths;
use Framework\Exceptions\ValidationException;

class FileService
{
    public  function __construct(private Database $db) {}

    /**
     * This function is used only for thumbnail upload when creating new courses of old flow.
     * This should be removed.
     * 
     * @deprecated
     */
    public function upload(string $dir, array $file)
    {
        $storageDir = Paths::STORAGE_UPLOADS . "/" . $dir;
        $existFile = '';
        if (isset($_SESSION['thumbnail'])) {
            $existFile = $storageDir . "/" . $_SESSION['thumbnail'];
        }

        if (!file_exists($existFile)) {

            $extention = pathinfo($file['name'], PATHINFO_EXTENSION);

            $fileName = uniqid("", true) . "." . $extention;

            $storagePath = $storageDir . "/" . $fileName;

            // Create directory to store file if not already exist
            if (!is_dir($storageDir)) {
                mkdir($storageDir, 0777, true);
            }
            if (!move_uploaded_file($file['tmp_name'], $storagePath)) {
                throw new ValidationException([
                    "img" => ['Failed to upload.']
                ]);
            }
            $_SESSION['thumbnail'] = $fileName;
        }
    }

    public function uploadFile(string $dir, array $file)
    {
        $storageDir = Paths::STORAGE_UPLOADS . "/" . $dir;
        $extention = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = str_replace('.', '-', uniqid("", true)) . "." . $extention;
        $storagePath = $storageDir . "/" . $fileName;
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0777, true);
        }
        if (!move_uploaded_file($file['tmp_name'], $storagePath)) {
            throw new ValidationException([
                "file" => ['Failed to upload.']
            ]);
        }

        return $fileName;
    }
}
