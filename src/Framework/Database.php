<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException;
use PDOStatement;
use ReturnTypeWillChange;

class Database
{
    public PDO $connection;
    private PDOStatement $stmt;

    public function __construct(string $driver, array $config, string $username, string $password)
    {
        $config = http_build_query(data: $config, arg_separator: ';');

        $dsn = "{$driver}:{$config}";

        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function query(string $query, array $params = [])
    {
        try {
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->stmt = $this->connection->prepare($query);
            $this->stmt->execute($params);

            return $this;
        } catch (PDOException $e) {
            // Log the error with query details for debugging
            error_log("Database error: " . $e->getMessage());

            // Re-throw the exception so it can be caught by the calling method
            throw $e;
        }
    }

    public function count()
    {
        return $this->stmt->fetchColumn();
    }

    public function find()
    {
        return $this->stmt->fetch();
    }
    public function findAll()
    {
        return $this->stmt->fetchAll();
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }
    public function commit()
    {
        return $this->connection->commit();
    }
    public function rollback()
    {
        return $this->connection->rollBack();
    }
}
