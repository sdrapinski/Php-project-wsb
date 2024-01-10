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
        ->orderBy('p.id','DESC')
        ->setParameter(0,$team_id)
        ->execute()
        ->fetchAll();


    }
    public static function createPost(int $team_id, int $user_id, string $description)
    {
      

        $result = DB::get()->query()
        ->insert('Posts')
        ->values([
            'id_team' => '?',
            'id_user' => '?',
            'description' => '?',
        ])
        ->setParameter(0, $team_id)
        ->setParameter(1, $user_id)
        ->setParameter(2, $description)
        ->execute();

        return $result;
    }

}