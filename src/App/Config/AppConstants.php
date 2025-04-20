<?php

declare(strict_types=1);

namespace App\Config;

class AppConstants
{
    public const APP_TIMEZONE = 'Asia/Colombo';
    public const APP_ENV = 'development';
    public const DB_DRIVER = 'mysql';
    public const DB_HOST = 'localhost';
    public const DB_PORT = 3306;
    public const DB_NAME = 'learnhubnew';
    public const DB_USER = 'phpmyadmin';
    public const DB_PASS = 'phpmyadmin';

    // Log Folder
    public const LOG_FOLDER = __DIR__ . '/../../../logs/';

    // PayHere
    public const PAYHERE_MERCHANT_ID = '121XXXX';
    public const PAYHERE_MERCHANT_SECRET = '4sdXXXXXXXXXXXXXXXXXXXXXXXXX';
    public const PAYHERE_AUTHORIZATION_API_URL = 'https://sandbox.payhere.lk/merchant/v1/oauth/token';
    public const PAYHERE_RETRIEVAL_API_URL = 'https://sandbox.payhere.lk/merchant/v1/payment/search?order_id=';
    public const PAYHERE_AUTHORIZATION_CODE = 'base64(AppID:AppSecret)';
    // Payment Statuses - PayHere Checkout API
    /**
     * PayHere retrieval API and checkout API use different status codes.
     * This implementation uses a mapping of status codes, aligning with 
     * the checkout API status codes for internal logic consistency.
     */
    public const PAYMENT_STATUS_SUCCESS = 2;
    public const PAYMENT_STATUS_PENDING = 0;
    public const PAYMENT_STATUS_CANCELED = -1;
    public const PAYMENT_STATUS_FAILED = -2;
    public const PAYMENT_STATUS_CHARGEDBACK = -3;
    public const PAYMENT_STATUS_NOT_FOUND = -4; // This status is not used in the Checkout API but is used only in internal logic
    // Mapping of Retrieval API payment statuses to Checkout API payment statuses
    public const RETRIEVAL_API_TO_CHECKOUT_API_STATUS_MAP = [
        0 => self::PAYMENT_STATUS_PENDING,       // Payment pending
        1 => self::PAYMENT_STATUS_SUCCESS,       // Payment successful
        -1 => self::PAYMENT_STATUS_NOT_FOUND,     // No records found
        -2 => self::PAYMENT_STATUS_FAILED,       // Payment declined
    ];
    // PayHere Course Payment URLs
    public const COURSE_PAYMENT_RETURN_URL = 'http://learnhub.local';
    public const COURSE_PAYMENT_CANCEL_URL = 'http://learnhub.local';
    public const COURSE_PAYMENT_RELATIVE_NOTIFY_URL = '/payment/notify';
    public const COURSE_PAYMENT_NOTIFY_URL = 'https://7017-192-248-16-125.ngrok-free.app' . self::COURSE_PAYMENT_RELATIVE_NOTIFY_URL;
}
