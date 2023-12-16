<?php

namespace Draszanicus\logic;

use Doctrine\DBAL\DriverManager;
class DB
{
    public static $db;

    public static function connect(){
        self::$db = DriverManager::getConnection(DRASZANICUS_DB);

//        $qb = self::$db->createQueryBuilder();
//
//        $qb->select('*')
//            ->from('users');
//
//        $query = $qb->executeQuery();
//        $user = $query->fetchAssociative();
//        var_dump($user);
//        exit();
    }
}