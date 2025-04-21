<?php

declare(strict_types=1);

namespace App\Config;

class Paths
{
    public const VIEW = __DIR__ . "/../views";
    public const SOURCE = __DIR__ . "/../../";

    public const PUBLIC_FOLDER = __DIR__ . '/../../../public';
    public const UPLOAD_FOLDER_RELATIVE_TO_PUBLIC = '/storage/uploads';
    public const STORAGE_UPLOADS = self::PUBLIC_FOLDER . self::UPLOAD_FOLDER_RELATIVE_TO_PUBLIC;
    // realtive paths to uploads
    public const RELATIVE_COURSE_THUMBNAIL_UPLOADS = 'courses/thumbnails';
    public const RELATIVE_MODULE_ATTACHMENT_UPLOADS = 'courses/modules/attachments';
    public const RELATIVE_USER_PROFILE_PICTURE_UPLOADS = 'profile-pictures';
}
