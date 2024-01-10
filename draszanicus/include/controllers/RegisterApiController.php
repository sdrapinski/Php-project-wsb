<?php

namespace Draszanicus\controllers;

use Draszanicus\common\Controller;
use Draszanicus\logic\User;
use Draszanicus\logic\View;
use Pecee\SimpleRouter\SimpleRouter;

class RegisterApiController extends Controller
{
    public function execute()
    {
        $view->setTemplate("../common/register.tpl");
        $login = $_POST["inputLogin"];
        $password = $_POST["inputPassword"];
        $email = $_POST["inputEmail"];
        $passwordconfirm = $_POST["inputPasswordAgain"];
        $user = Users::register($login, $password,$email);

        if(!empty($user)&& $passwordconfirm==$password && (strlen($password)>=8) && !empty($newEmail) && filter_var($newEmail,FILTER_VALIDATE_EMAIL) && Botting($login,$email) ){
            User::saveUser(reset($user));
            $view = new View();
            $view->setTemplate("../common/NavPanel.tpl");
        }
        else{
            echo json_encode("fail");
        }
    }
    public function Botting($login,$email){
        {
            $query = DB::get()->query()
                ->select('username')
                ->from('Users')
                ->where('username = ?')
                ->setParameter(0, $login);
               
    
                $result = $query->execute()->fetchOne();
    
                $outcome=$result > 0;
                $query = DB::get()->query()
                ->select('email')
                ->from('Users')
                ->where('email = ?')
                ->setParameter(0, $email);
                $result = $query->execute()->fetchOne();
                if($outcome==$result > 0 && $outcome==TRUE)
                {
                    return $result > 0;
                }
                return FALSE;
        }
    }
}