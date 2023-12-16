<?php

namespace Draszanicus\logic;

use Doctrine\DBAL\DriverManager;
class DB
{
    private static $conn;
    private $db;
    public function __construct($conn = "")
    {
        if(!empty($conn)){
            $this->db = self::$conn;
        }
    }
    public static function connect(){
        self::$conn = DriverManager::getConnection(DRASZANICUS_DB);
    }
    public static function get(){
        return new DB(self::$conn);
    }

    public function query($query){
        $stmt = $this->db->prepare($query);
        return $stmt->executeQuery()->fetchAllAssociative();
    }
}