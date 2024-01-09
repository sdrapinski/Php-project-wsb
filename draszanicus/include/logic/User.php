<?php

namespace Draszanicus\logic;

class User
{
    public static function login($username, $password){
        try{
            return DB::get()->query()
                ->select("*")
                ->from("Users")
                    ->where("username = ?", "password = ?")
                    ->setParameter(0, $username)
                    ->setParameter(1, $password)
                ->execute()
                ->fetchAll();
        }catch (\Exception){
            return "fail";
        }
    }

    public static function saveUser($user):void{
        function parseIni($array):string {
            $ini_str = "[Ustawienia]\n";
            foreach ($array as $key => $value) {
                $ini_str .= "$key = \"$value\"" . PHP_EOL;
            }
            return $ini_str;
        }
        $path = ROOT_PATH . "/sess/" . session_id() . "_" . $user["id"] . ".ini";
        $iniFileContent = parseIni($user);
        file_put_contents($path, $iniFileContent);
        $_SESSION['path'] = $path;
    }

    public static function getUser(): array{
        return !empty($_SESSION['path']) && file_exists($_SESSION['path']) ? parse_ini_file($_SESSION['path']) : [];
    }
}