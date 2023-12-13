<?php

namespace Draszanicus\logic;

use Draszanicus\common\controller;

class ControllerLoader
{
    public static function load(string $name): void{
        $controller = "Draszanicus\controllers\\" . $name . "Controller";
        $controller = new $controller;
        $controller->execute();
    }
}