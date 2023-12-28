<?php

namespace Draszanicus\logic;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

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
    /**
     * @throws Exception
     */
    public static function connect(): Exception|string
    {
        try{
            self::$conn = DriverManager::getConnection(DRASZANICUS_DB);
        }catch (Exception $exception){
            return $exception;
        }
        return "fine";
    }
    public static function get(): DB
    {
        return new DB(self::$conn);
    }

    public function query(){
        return $this->db->createQueryBuilder();
    }
    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }
}