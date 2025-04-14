<?php

declare(strict_types=1);

namespace App\Config;

class AppConstants
{
    public const APP_ENV = 'development';
    public const DB_DRIVER = 'mysql';
    public const DB_HOST = 'localhost';
    public const DB_PORT = 3312;
    public const DB_NAME = 'learnhubnew';
    public const DB_USER = 'learnhub';
    public const DB_PASS = 'learnhub123';

    // Log Folder
    public const LOG_FOLDER = __DIR__ . '/../../../logs/';

    // PayHere
    public const PAYHERE_MERCHANT_ID = '121XXXX';
    public const PAYHERE_MERCHANT_SECRET = '4sdXXXXXXXXXXXXXXXXXXXXXXXXX';
    public const PAYHERE_AUTHORIZATION_API_URL = 'https://sandbox.payhere.lk/merchant/v1/oauth/token';
    public const PAYHERE_RETRIEVAL_API_URL = 'https://sandbox.payhere.lk/merchant/v1/payment/search?order_id=';
    public const PAYHERE_AUTHORIZATION_CODE = 'base64(AppID:AppSecret)';
    // Payment Statuses
    public const PAYMENT_STATUS_SUCCESS = 2;
    public const PAYMENT_STATUS_PENDING = 0;
    public const PAYMENT_STATUS_CANCELED = -1;
    public const PAYMENT_STATUS_FAILED = -2;
    public const PAYMENT_STATUS_CHARGEDBACK = -3;
    // PayHere Course Payment URLs
    public const COURSE_PAYMENT_RETURN_URL = 'http://learnhub.local';
    public const COURSE_PAYMENT_CANCEL_URL = 'http://learnhub.local';
    public const COURSE_PAYMENT_RELATIVE_NOTIFY_URL = '/payment/notify';
    public const COURSE_PAYMENT_NOTIFY_URL = 'https://7017-192-248-16-125.ngrok-free.app' . self::COURSE_PAYMENT_RELATIVE_NOTIFY_URL;
}
