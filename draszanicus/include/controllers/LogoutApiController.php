<?php

namespace Draszanicus\controllers;

use Draszanicus\common\Controller;
use Draszanicus\logic\User;
use Draszanicus\logic\View;
use Pecee\SimpleRouter\SimpleRouter;

class LogoutApiController extends Controller
{
    public function execute()
    {
        $file = file_exists($_SESSION["path"]);

        if($file){
            unlink($_SESSION["path"]);
        }

        header("Location: /");
    }
}