<?php

namespace Draszanicus\controllers;

use Draszanicus\logic\DB;
use Draszanicus\logic\Team;
use Draszanicus\logic\User;
use Draszanicus\logic\Users;

use Draszanicus\common\Controller;
use Draszanicus\logic\View;

class SearchController extends Controller
{
    public function execute()
    {
        $user = User::getUser();
        $userId = array_key_exists("id", $user) ? (int)$user["id"] : 0  ;
       
        $teams = [];
        $view = new View();
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'Search') {
            $searchTerm = $_POST['search'];
            $teams = Team::TeamsSearched($searchTerm);
           

        }
      
       
        
        

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Leave']) && !empty($userId)) {
            $teamid = $_POST['Leave'];
            Team::LeaveTeam($userId, $teamid);
            header("Location: /");
        }
        
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Join'])&& !empty($userId)) {
            $teamid = $_POST['Join'];
            if (!Team::isUserJoined($userId, $teamid)) {
                Team::JoinTeam($userId, $teamid);
                header("Location: /home/switchTeam?action=switchTeam&teamId=". $teamid);
             

            }
        }
       

        if (!empty($teams)) {
            foreach ($teams as &$team) {
                $team['isJoined'] = Team::isUserJoined($userId, $team['id']);
                $team['MemberCount'] = Users::MemberCount($team['id']);
            }
            $view->assign("teams", $teams);
            
        } else {
            $view->assign("teams", []);
            $view->assign("MemberCount", []);
           
        }
        $userGroups = Team::getUserTeams($userId);
        $view->assign("userGroups", $userGroups);
        $view->setTemplate("Searchout/SearchOut.tpl");

    }
}