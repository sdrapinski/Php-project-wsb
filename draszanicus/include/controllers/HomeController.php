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
    if(empty($_GET['action'])){
        $info = 'def-empty';
    }
    if(!empty($_POST['action'])){
        if($_POST['action'] == 'createTeam'){
            $info = 'createTeam';
            $this->createTeam();
        }
        else if($_POST['action'] == 'createPost'){
            $info = 'createPost';
            $this->createPost();
        }
    }
    if(empty($_POST['action'])){
        $info = 'def-post-empty';
    }

    
    $view = new View();
    $teams = self::getTeams(1);
    $view->assign("teams", $teams);
    $view->assign("info",$info);
    if (!empty($teams)) {
     $view->assign("posts", self::getPosts(reset($teams)['id']));
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
             $teamId = 1;
             $userId = 1; 
             
      
             Posts::createPost($teamId, $userId, $postText);
         }
       
    }

  
}