<?php
namespace Draszanicus\controllers;

use Draszanicus\common\Controller;
use Draszanicus\logic\View;

class HomeController extends Controller {
   public function execute()
   {
       $view = new View();
       $view->assign("msg", "Welcome!");
       $view->setTemplate("home/Home.tpl");
   }
}