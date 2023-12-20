<?php

namespace Draszanicus\logic;

use Draszanicus\logic\DB;

class Posts {
    public static function getPostsFromTeam(int $team_id){
        return DB::get()->query()
        ->select('p.description','u.username')
        ->from('Posts','p')
        ->innerJoin('p','Teams','t','p.id_team = t.id')
        ->innerJoin('p','Users','u','p.id_user = u.id')
        ->where('t.id = ?')
        ->setParameter(0,$team_id)
        ->execute()
        ->fetchAll();


    }

}