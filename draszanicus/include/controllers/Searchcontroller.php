<?php
namespace Draszanicus\controllers;
use Draszanicus\logic\DB;
use Draszanicus\logic\Team;
use Draszanicus\logic\Users;

use Draszanicus\common\Controller;
use Draszanicus\logic\View;
class SearchController extends Controller {
    public function execute()
    {
       $view = new View();
       if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'Search') {
            $searchTerm = $_POST['search'];
            $teams = Team::TeamsSearched($searchTerm);
                       
       }
       if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Leave'])) {
            $teamid=$_POST['Leave'];
            $userid ="1";
            Team::LeaveTeam($userid,$teamid);
       }
       if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Join'])) {
        $teamid=$_POST['Join'];
        if(!Team::isUserJoined(1, $teamid)){
            $userid ="1";
            Team::JoinTeam($userid,$teamid);
        }
        }
       
       if (!empty($teams)) {
        foreach ($teams as &$team) {
            $team['isJoined'] = Team::isUserJoined(1, $team['id']);
            $team['MemberCount']= Users::MemberCount($team['id']);
        }
        $view->assign("teams", $teams);
        }else{
        $view->assign("teams", []);
        $view->assign("MemberCount", []);
        }
        $userGroups =  Team::getUserTeams('user1');
        $view->assign("userGroups", $userGroups);
        $view->setTemplate("Searchout/SearchOut.tpl");
  
    }
 }