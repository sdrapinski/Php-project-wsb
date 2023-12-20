<?php
namespace Draszanicus\controllers;
use Draszanicus\logic\DB;
use Draszanicus\common\Controller;
use Draszanicus\logic\View;

class HomeController extends Controller {
   public function execute()
   {
       $view = new View();
       $view->assign("msg", "siema!");
       $view->setTemplate("home/Home.tpl");
   }
}