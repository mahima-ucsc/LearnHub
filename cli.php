<?php

include __DIR__ . '/src/Framework/Database.php';
include __DIR__ . '/src/App/Config/AppConstants.php';

use App\Config\AppConstants;
use Framework\Database;

class DatabaseSetupTool
{
    private $db;
    private $options = [
        'force' => false,
        'create' => false,
        'seed' => false
    ];
    private $dbname;

    public function __construct(array $args)
    {
        $this->parseArguments($args);
        $this->dbname = AppConstants::DB_NAME;
    }

    private function parseArguments(array $args): void
    {
        foreach ($args as $arg) {
            if ($arg === '--help') {
                $this->showHelp();
                exit(0);
            }
            if ($arg === '--force') {
                $this->options['force'] = true;
            }
            if ($arg === '--create') {
                $this->options['create'] = true;
            }
            if ($arg === '--seed') {
                $this->options['seed'] = true;
            }
        }
    }

    private function showHelp(): void
    {
        echo "Usage: php cli.php [options]\n";
        echo "Options:\n";
        echo "  --help    Display this help message\n";
        echo "  --create  Create database schema using learnhub-database.sql\n";
        echo "  --seed    Seed database with sample data.\n";
        echo "  --force   Force database recreation (renames existing database if it exists)\n";
    }

    public function connect(): void
    {
        $this->db = new Database(AppConstants::DB_DRIVER, [
            'host' => AppConstants::DB_HOST,
            'port' => AppConstants::DB_PORT,
            'dbname' => null,
        ], AppConstants::DB_USER, AppConstants::DB_PASS);
    }

    public function setupDatabase(): void
    {

        if ($this->options['create']) {
            if ($this->databaseExists()) {
                $this->handleExistingDatabase();
            } else {
                $this->createDatabase();
            }

            $this->importSchema();
        } elseif ($this->options['seed']) {
            $this->seedDatabase();
        } else {
            echo "No action specified. Use --create or --seed.\n";
        }
    }

    private function databaseExists(): bool
    {
        $checkDbQuery = $this->db->connection->query(
            "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$this->dbname}'"
        );
        return $checkDbQuery->rowCount() > 0;
    }

    private function handleExistingDatabase(): void
    {
        if (!$this->options['force']) {
            echo "Database '{$this->dbname}' already exists. Use --force to rename existing and create new.\n";
            exit(1);
        }

        $timestamp = date('Ymd_His');
        $newDbName = $this->dbname . '_' . $timestamp;

        $this->db->connection->query("CREATE DATABASE `$newDbName`");
        $this->migrateExistingTables($newDbName);
        $this->db->connection->query("DROP DATABASE `{$this->dbname}`");

        $this->createDatabase();
        echo "Database renamed to '$newDbName' and new database '{$this->dbname}' created.\n";
    }

    private function migrateExistingTables(string $newDbName): void
    {
        $tables = $this->db->connection->query("SHOW TABLES FROM `{$this->dbname}`")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($tables as $table) {
            $this->db->connection->query("RENAME TABLE `{$this->dbname}`.`$table` TO `$newDbName`.`$table`");
        }
    }

    private function createDatabase(): void
    {
        $this->db->connection->query("CREATE DATABASE `{$this->dbname}`");
        echo "Database '{$this->dbname}' created.\n";
    }

    private function importSchema(): void
    {
        $this->db->connection->query("USE `{$this->dbname}`");

        $sql_file = file_get_contents("./learnhub-database.sql");
        if ($sql_file === false) {
            throw new Exception("Unable to read the schema SQL file.");
        }
        $this->db->connection->query($sql_file);
        echo "Database schema imported from 'learnhub-database.sql'.\n";
    }

    private function seedDatabase(): void
    {
        try {
            $this->db->connection->query("USE `{$this->dbname}`");

            // Begin transaction
            $this->db->connection->beginTransaction();

            $seed1 = file_get_contents("./seed/seed-users.sql");
            if ($seed1 === false) {
                throw new Exception("Unable to read seed-users.sql file.");
            }
            $this->db->connection->query($seed1);
            echo "Database seeded with users.\n";

            $seed2 = file_get_contents("./seed/seed-subjects.sql");
            if ($seed2 === false) {
                throw new Exception("Unable to read seed-subjects.sql file.");
            }
            $this->db->connection->query($seed2);
            echo "Database seeded with subjects.\n";

            $seed3 = file_get_contents("./seed/seed-courses.sql");
            if ($seed3 === false) {
                throw new Exception("Unable to read seed-courses.sql file.");
            }
            $this->db->connection->query($seed3);
            echo "Database seeded with courses.\n";

            $seed4 = file_get_contents("./seed/seed-modules.sql");
            if ($seed4 === false) {
                throw new Exception("Unable to read seed-modules.sql file.");
            }
            $this->db->connection->query($seed4);
            echo "Database seeded with modules.\n";

            $seed5 = file_get_contents("./seed/seed-payments.sql");
            if ($seed4 === false) {
                throw new Exception("Unable to read seed-payments.sql file.");
            }
            $this->db->connection->query($seed5);
            echo "Database seeded with payments.\n";

            // Commit the transaction if everything succeeded
            $this->db->connection->commit();
            echo "All seeding completed successfully.\n";
        } catch (Exception $e) {
            // Roll back the transaction if anything failed
            $this->db->connection->rollBack();
            throw new Exception("Seeding failed: " . $e->getMessage());
        }
    }
}

try {
    $tool = new DatabaseSetupTool($argv);
    $tool->connect();
    $tool->setupDatabase();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage() . "\n";
    exit(1);
}
