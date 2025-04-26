<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use App\Config\Paths;
use Exception;
use Framework\Exceptions\ValidationException;

class AdvertisementService
{
    public function __construct(private Database $db) {}

    public function create(array $formData, array $thumbnail)
    {
        $this->db->beginTransaction();
        $thumbnail_url = $this->uploadFile($thumbnail['thumbnail'], 'advertisement/thumbnail');

        try {
            $this->db->query(
                "INSERT INTO advertisement(description, package, discount, remark, thumbnail_url, course_id, user_id)
                VALUES(:description, :package, :discount, :remark, :thumbnail_url, :course_id, :user_id)",
                [
                    "description" => $formData['description'],
                    "package" => $formData['package'],
                    "discount" => $formData['discount'],
                    "remark" => $formData['remark'],
                    "thumbnail_url" => $thumbnail_url,
                    "course_id" => $formData['courseId'],
                    "user_id" => $_SESSION['user']
                ]
            );
            $advertisementId = $this->db->lastInsertId();
            foreach ($formData['features'] as $feature) {
                $this->db->query(
                    "INSERT INTO advertisement_feature(advertisement_id, feature)
                    VALUE (:advertisement_id, :feature)",
                    [
                        "advertisement_id" => $advertisementId,
                        "feature" => $feature
                    ]
                );
            }
            $this->db->commit();
            redirectTo('/payment/advertisement/' . $advertisementId);
        } catch (Exception $e) {
            $filePath = Paths::STORAGE_UPLOADS . '/advertisement/thumbnail/' . $thumbnail_url;
            if (file_exists($filePath)) {
                unlink($filePath);
                error_log("File cleanup during error: " . $thumbnail_url);
            }
            error_log("Advertisement creation error: " . $e->getMessage());
            $this->db->rollBack();
            throw $e;
        }
    }

    public function uploadFile(array $file, string $dir)
    {

        $storageDir = Paths::STORAGE_UPLOADS . "/" . $dir;
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $baseName = pathinfo($file['name'], PATHINFO_FILENAME);
        // $fileName = uniqid("", true) . "." . $extention;

        $fileName = $file['name'];
        $storagePath = $storageDir . "/" . $fileName;

        // Ensure directory exists
        if (!is_dir($storageDir)) {
            mkdir($storageDir, 0777, true);
        }

        $counter = 1;
        while (file_exists($storagePath)) {
            $fileName = $baseName . "_" . $counter . "." . $extension;
            $storagePath = $storageDir . "/" . $fileName;
            $counter++;
        }
        if (!move_uploaded_file($file['tmp_name'], $storagePath)) {
            throw new ValidationException([
                "file" => ['Failed to upload.']
            ]);
        }

        return $fileName;
    }

    public function getApprovedAds()
    {
        $ads = $this->db->query(
            "SELECT a.*, 
            CONCAT(u.first_name, ' ', u.last_name) as user_name, 
            c.course_id, c.title, c.price
            FROM advertisement a
            JOIN courses c ON a.course_id = c.course_id
            JOIN users u ON a.user_id = u.user_id
            JOIN advertisement_feature f ON f.advertisement_id = a.advertisement_id
            WHERE a.status = 'approved'
            GROUP BY a.advertisement_id"
        )->findAll();

        $features = $this->db->query(
            "SELECT * FROM advertisement_feature"
        )->findAll();

        // Add feature to the $ads based on advertisement_id
        $features_by_ad_id = [];

        foreach ($features as $feature) {
            $ad_id = $feature['advertisement_id'];
            if (!isset($features_by_ad_id[$ad_id])) {
                $features_by_ad_id[$ad_id] = [];
            }
            $features_by_ad_id[$ad_id][] = $feature['feature'];
        }

        foreach ($ads as &$ad) {
            $ad_id = $ad['advertisement_id'];
            $ad['features'] = $features_by_ad_id[$ad_id] ?? [];
        }
        return $ads;
    }

    public function getAdvertisements()
    {
        $ads = $this->db->query(
            "SELECT a.*, 
            CONCAT(u.first_name, ' ', u.last_name) as user_name, 
            c.course_id, c.title, c.price
            FROM advertisement a
            JOIN courses c ON a.course_id = c.course_id
            JOIN users u ON a.user_id = u.user_id
            JOIN advertisement_feature f ON f.advertisement_id = a.advertisement_id
            GROUP BY a.advertisement_id"
        )->findAll();

        $features = $this->db->query(
            "SELECT * FROM advertisement_feature"
        )->findAll();

        // Add feature to the $ads based on advertisement_id
        $features_by_ad_id = [];

        foreach ($features as $feature) {
            $ad_id = $feature['advertisement_id'];
            if (!isset($features_by_ad_id[$ad_id])) {
                $features_by_ad_id[$ad_id] = [];
            }
            $features_by_ad_id[$ad_id][] = $feature['feature'];
        }

        foreach ($ads as &$ad) {
            $ad_id = $ad['advertisement_id'];
            $ad['features'] = $features_by_ad_id[$ad_id] ?? [];
        }
        return $ads;
    }
    public function getTeacherAdvertisements(string $userId)
    {
        $ads = $this->db->query(
            "SELECT a.*, 
            CONCAT(u.first_name, ' ', u.last_name) as user_name, 
            c.course_id, c.title, c.price
            FROM advertisement a
            JOIN courses c ON a.course_id = c.course_id
            JOIN users u ON a.user_id = u.user_id
            JOIN advertisement_feature f ON f.advertisement_id = a.advertisement_id
            WHERE a.user_id = :id
            GROUP BY a.advertisement_id",
            [
                'id' => $userId
            ]
        )->findAll();

        $features = $this->db->query(
            "SELECT * FROM advertisement_feature"
        )->findAll();

        // Add feature to the $ads based on advertisement_id
        $features_by_ad_id = [];

        foreach ($features as $feature) {
            $ad_id = $feature['advertisement_id'];
            if (!isset($features_by_ad_id[$ad_id])) {
                $features_by_ad_id[$ad_id] = [];
            }
            $features_by_ad_id[$ad_id][] = $feature['feature'];
        }

        foreach ($ads as &$ad) {
            $ad_id = $ad['advertisement_id'];
            $ad['features'] = $features_by_ad_id[$ad_id] ?? [];
        }
        return $ads;
    }

    public function getAdvertisement(string $id)
    {
        return $this->db->query(
            "SELECT * FROM advertisement WHERE advertisement_id = :id",
            [
                'id' => $id
            ]
        )->find();
    }
    public function approve($id)
    {
        $advertisement = $this->getAdvertisement($id);
        $package = $advertisement['package'];
        switch (strtolower($package)) {
            case 'basic':
                $endDate = date('Y-m-d H:i:s', strtotime('+7 days'));
                break;
            case 'standard':
                $endDate = date('Y-m-d H:i:s', strtotime('+14 days'));
                break;
            case 'gold':
                $endDate = date('Y-m-d H:i:s', strtotime('+30 days'));
                break;
            default:
                $endDate = date('Y-m-d H:i:s');
        }
        try {
            $this->db->query(
                "UPDATE advertisement 
                SET status = 'approved',
                end_date = :endDate
                WHERE advertisement_id = :id",
                [
                    'id' => $id,
                    'endDate' => $endDate
                ]
            );
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function reject($id)
    {
        try {
            $this->db->query(
                "UPDATE advertisement 
                SET status = 'rejected'
                WHERE advertisement_id = :id",
                [
                    'id' => $id
                ]
            );
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteAd(string $id)
    {
        $this->db->query(
            "DELETE FROM advertisement
            WHERE advertisement_id = :id",
            [
                "id" => $id
            ]
        );
    }
}
