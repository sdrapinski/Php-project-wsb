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
    
    $info = 'def';
    $view = new View();
    $teams = self::getTeams(1);
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
            $this->createTeam();
        }
        else if($_POST['action'] == 'createPost'){
            $info = 'createPost';
            $ButtonTeamHightlight = $_POST['teamIdInput'];
            $this->createPost();
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
   /// team
   public function createTeam()
   {
        
        if(!empty($_POST['teamName']) && !empty($_POST['teamName']) && !empty($_POST['teamName'])){
            $teamName = $_POST['teamName'] ; 
            $teamDescription = $_POST['teamDescription'] ; 
            $userId = 1; 
            
     
           Team::createTeam($teamName, $teamDescription, $userId);
        }
      
   }


   public  function getTeams (int $user_id){
       $userGroups =  Team::getUserTeams($user_id);
       return $userGroups;
   }

   // Posts
   public  function getPosts (int $id){
    $PostsList =  Posts::getPostsFromTeam($id);
    return $PostsList;
    }

    public function createPost()
    {
         
         if(!empty($_POST['postText'])){
             $postText = $_POST['postText'] ; 
             $teamId = $_POST['teamIdInput'];
             $userId = 1; 
             
      
             Posts::createPost($teamId, $userId, $postText);
         }
       
    }

  
}