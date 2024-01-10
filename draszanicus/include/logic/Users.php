<?php

namespace Draszanicus\logic;

use Draszanicus\logic\DB;

class Users {
    public static function MemberCount($teamId) {
        $query = DB::get()->query()
            ->select('COUNT(*)')
            ->from('Users','u')
            ->innerJoin('u','UserToTeam','ut','u.id = ut.id_user')
            ->innerJoin('ut','Teams','t','ut.id_team = t.id')
            ->where('t.id = ?')
            ->setParameter(0, $teamId);
            $result = $query->execute()->fetchOne();
            return $result;
    }
    public static function register($login, $password,$email) {
        DB::insert('Users', [
            'username' => $login,
            'password' => $password,
            'email' => $email,
        ]);
    }
}