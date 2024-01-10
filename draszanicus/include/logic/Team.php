<?php

namespace Draszanicus\logic;

use Draszanicus\logic\DB;

class Team {
    public static function getUserTeams(int $id){
        return DB::get()->query()
        ->select('t.id','t.name','t.description')
        ->from('Teams','t')
        ->innerJoin('t','UserToTeam','ut','t.id = ut.id_team')
        ->innerJoin('ut','Users','u','ut.id_user = u.id')
        ->where('u.id = ?')
        ->setParameter(0,$id)
        ->execute()
        ->fetchAll();


    }

    public static function createTeam(string $name, string $description, int $user_id){
        
      

        $result = DB::get()->query()
            ->insert('Teams')
            ->values([
                'name' => '?',
                'description' => '?',
                'author_id' => '?',
            ])
            ->setParameter(0, $name)
            ->setParameter(1, $description)
            ->setParameter(2, $user_id)
            ->execute();
          

        if ($result) {
            
            $teamId = DB::get()->getLastInsertId();

            
            $userToTeamData = [
                'id_user' => $user_id,
                'id_team' => $teamId,
            ];

            DB::get()->query()
                ->insert('UserToTeam')
                ->values([
                    'id_user' => '?',
                    'id_team' => '?',
                ])
                ->setParameter(0, $user_id)
                ->setParameter(1, $teamId)
                ->execute();
                

            return $teamId; 
        }

        return false; 
    }
}