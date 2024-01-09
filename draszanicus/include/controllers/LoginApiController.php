<?php

namespace Draszanicus\controllers;

use Draszanicus\common\Controller;
use Draszanicus\logic\User;
use Draszanicus\logic\View;
use Pecee\SimpleRouter\SimpleRouter;

class LoginApiController extends Controller
{
    public function execute()
    {
        $login = $_POST["inputLogin"];
        $password = $_POST["inputPassword"];

        $user = User::login($login, $password);

        if($user !== "fail" && !empty($user)){
            User::saveUser(reset($user));
            $view = new View();
            $view->setTemplate("../common/NavPanel.tpl");
        }
        else{
            echo json_encode("fail");
        }
    }
}