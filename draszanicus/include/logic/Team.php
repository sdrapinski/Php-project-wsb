<?php

namespace Draszanicus\logic;

use Draszanicus\logic\DB;

class Team {
    public static function getUserTeams(string $username){
        return DB::get()->query()
        ->select('t.id','t.name','t.description')
        ->from('Teams','t')
        ->innerJoin('t','UserToTeam','ut','t.id = ut.id_team')
        ->innerJoin('ut','Users','u','ut.id_user = u.id')
        ->where('u.username = ?')
        ->setParameter(0,$username)
        ->execute()
        ->fetchAll();


    }

    public static function createTeam(string $name, string $description, int $user_id){

    }
}