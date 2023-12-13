<?php
namespace Draszanicus\controllers;

use Draszanicus\common\controller;
use Draszanicus\logic\View;

class HomeController extends controller {
   public function execute()
   {
       $view = new View();
       $view->assign("msg", "Hello World!");
       $view->setTemplate("home/Home.tpl");
   }
}