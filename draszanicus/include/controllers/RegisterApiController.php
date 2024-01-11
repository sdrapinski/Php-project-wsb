<?php

namespace Draszanicus\controllers;

use Draszanicus\common\Controller;
use Draszanicus\logic\DB;
use Draszanicus\logic\User;
use Draszanicus\logic\Users;
use Draszanicus\logic\View;
use Pecee\SimpleRouter\SimpleRouter;

class RegisterApiController extends Controller
{
    public function execute()
    {
       
        $login = $_POST["inputLogin"];
        $password = $_POST["inputPassword"];
        $email = $_POST["inputEmail"];
        $passwordconfirm = $_POST["inputPasswordAgain"];
        


        if(!empty($_POST['action'])){
           
            if($_POST['action'] == 'createUser'){
                
                if($passwordconfirm==$password && (strlen($password)>=8)
                 && !empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL) && !$this->checkIfUserExist($login,$email) ){
                    var_dump("dziala ify");

                    $user = Users::register($login, $password,$email);
                    header("Location: /");

                }
            }
        }else{
            header("Location: /");
        }

       
    }
    public function checkIfUserExist($login,$email){
        {
            $query = DB::get()->query()
                ->select('username')
                ->from('Users')
                ->where('username = ?')
                ->setParameter(0, $login);
               
    
                $result = $query->execute()->fetchOne();
    
                $outcome=$result ==0;

                $query = DB::get()->query()
                ->select('email')
                ->from('Users')
                ->where('email = ?')
                ->setParameter(0, $email);
                $result = $query->execute()->fetchOne();

                $outcome2 = $result == 0;

                if($outcome && $outcome2)
                {
                    return false;
                }
                return true;
        }
    }
}