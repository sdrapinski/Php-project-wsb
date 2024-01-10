<?php
namespace Draszanicus\controllers;
use Draszanicus\logic\DB;
use Draszanicus\logic\Team;
use Draszanicus\logic\Posts;

use Draszanicus\common\Controller;
use Draszanicus\logic\View;

class HomeController extends Controller {
   public function execute()
   {
     

       $view = new View();
       $teams = self::getTeams();
       $view->assign("teams", $teams);
       if (!empty($teams)) {
        $view->assign("posts", self::getPosts(reset($teams)['id']));
        } else {
        $view->assign("posts", []); 
        }
       $view->setTemplate("home/Home.tpl");

   }

   public  function getTeams (){
       $userGroups =  Team::getUserTeams('user1');
       return $userGroups;
   }
   public  function getPosts (int $id){
    $PostsList =  Posts::getPostsFromTeam($id);
    return $PostsList;
    }
  
}