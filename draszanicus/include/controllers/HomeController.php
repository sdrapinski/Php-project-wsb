<?php
namespace Draszanicus\controllers;

use Draszanicus\common\Controller;
use Draszanicus\logic\DB;
use Draszanicus\logic\Team;
use Draszanicus\logic\Posts;
use Draszanicus\logic\User;
use Draszanicus\logic\View;

class HomeController extends Controller {
   public function execute()
   {

    $info = 'def';
    $view = new View();
    $user = User::getUser();
    $user_id = !empty($user) ?? $user["id"];
    $teams = self::getTeams($user_id);
    $ButtonTeamHightlight = reset($teams)['id'];
    if(!empty($_GET['action'])){
        if($_GET['action'] == 'switchTeam'){

            $info = $_GET['teamId'];
            $ButtonTeamHightlight = $_GET['teamId'];
        }
    }
    if(!empty($_POST['action'])){
        if($_POST['action'] == 'createTeam'){
            $info = 'createTeam';
            $this->createTeam($user_id);
            header("Location: /");
        }
        else if($_POST['action'] == 'createPost'){
            $info = 'createPost';
            $ButtonTeamHightlight = $_POST['teamIdInput'];
            $this->createPost($user_id);

        }
    }





    $view->assign("teams", $teams);
    $view->assign("teamButton", $ButtonTeamHightlight);
    $view->assign("info",$info);
    if (!empty($teams)) {
        if(!empty($_GET['action']) && $_GET['action'] == 'switchTeam'){
            $view->assign("teamId", $_GET['teamId']);
            $view->assign("posts", self::getPosts($_GET['teamId']));

        }else if(!empty($_POST['action'])&& $_POST['action'] == 'createPost'){
            $view->assign("posts", self::getPosts($_POST['teamIdInput']));
        }
        else{
            $view->assign("posts", self::getPosts(reset($teams)['id']));
        }

     } else {
     $view->assign("posts", []);
     }
    $view->setTemplate("home/Home.tpl");



   }
}