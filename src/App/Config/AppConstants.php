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

    // PayHere
    public const PAYHERE_MERCHANT_ID = '121XXXX';
    public const PAYHERE_MERCHANT_SECRET = '4sdXXXXXXXXXXXXXXXXXXXXXXXXX';
    // Payment Statuses
    public const PAYMENT_STATUS_SUCCESS = 2;
    public const PAYMENT_STATUS_PENDING = 0;
    public const PAYMENT_STATUS_CANCELED = -1;
    public const PAYMENT_STATUS_FAILED = -2;
    public const PAYMENT_STATUS_CHARGEDBACK = -3;
}
