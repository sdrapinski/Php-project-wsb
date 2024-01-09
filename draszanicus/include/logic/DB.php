<?php

namespace Draszanicus\logic;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

class DB
{
    private static $conn;
    private $db;

    private function __construct($conn)
    {
        $this->db = $conn;
    }

    /**
     * @throws Exception
     */
    public static function connect(): Exception|string
    {
        try {
            self::$conn = DriverManager::getConnection(DRASZANICUS_DB);
        } catch (Exception $exception) {
            return $exception;
        }
        return "fine";
    }

    public static function get(): self
    {
        if (!self::$conn) {
            self::connect();
        }

        return new self(self::$conn);
    }

    public function query()
    {
        return $this->db->createQueryBuilder();
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }

    public function fetchAssociative($query, $params = [])
    {
        $stmt = $this->db->executeQuery($query, $params);
    
        return $stmt->fetchAllAssociative();
    }
    
    
    
}
