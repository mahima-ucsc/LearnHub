<?php

include __DIR__ . '/src/Framework/Database.php';
include __DIR__ . '/src/App/Config/AppConstants.php';

use App\Config\AppConstants;
use Framework\Database;

// Check for arguments
$force = false;
foreach ($argv as $arg) {
    if ($arg === '--help') {
        echo "Usage: php cli.php [options]\n";
        echo "Options:\n";
        echo "  --help    Display this help message\n";
        echo "  --force   Force database recreation (renames existing database if it exists)\n";
        exit(0);
    }
    if ($arg === '--force') {
        $force = true;
    }
}

try {
    $db = new Database(AppConstants::DB_DRIVER, [
        'host' => AppConstants::DB_HOST,
        'port' => AppConstants::DB_PORT,
        'dbname' => null,
    ], AppConstants::DB_USER, AppConstants::DB_PASS);

    $isNewDatabase = false;

    $dbname = AppConstants::DB_NAME;
    $checkDbQuery = $db->connection->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");

    if ($checkDbQuery->rowCount() > 0) {
        if (!$force) {
            echo "Database '$dbname' already exists. Use --force to rename existing and create new.\n";
            exit(1);
        }

        $timestamp = date('Ymd_His');
        $newDbName = $dbname . '_' . $timestamp;
        $db->connection->query("CREATE DATABASE `$newDbName`");
        $tables = $db->connection->query("SHOW TABLES FROM `$dbname`")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($tables as $table) {
            $db->connection->query("RENAME TABLE `$dbname`.`$table` TO `$newDbName`.`$table`");
        }
        $db->connection->query("DROP DATABASE `$dbname`");
        $db->connection->query("CREATE DATABASE `$dbname`");
        echo "Database renamed to '$newDbName' and new database '$dbname' created.\n";
        $isNewDatabase = true;
    } else {
        $db->connection->query("CREATE DATABASE `$dbname`");
        echo "Database '$dbname' created.\n";
        $isNewDatabase = true;
    }

    if ($isNewDatabase) {
        $db->connection->query("USE `$dbname`");
        $sql_file = file_get_contents("./learnhub-database.sql");
        if ($sql_file === false) {
            throw new Exception("Unable to read the SQL file.");
        }
        $db->connection->query($sql_file);
        echo "Database schema imported from 'learnhub-database.sql'.\n";
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage() . "\n";
    exit(1);
}
