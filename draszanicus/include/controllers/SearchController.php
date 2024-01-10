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
        $userId = $user["id"];

        $view = new View();
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['action']) && $_POST['action'] === 'Search') {
            $searchTerm = $_POST['search'];
            $teams = Team::TeamsSearched($searchTerm);

        }
        if (empty($userId) && !empty($teams)) {
            foreach ($teams as &$team) {
                $team['MemberCount'] = Users::MemberCount($team['id']);
            }
            $view->assign("teams", $teams);
            $view->setTemplate("Searchout/SearchOut.tpl");
            exit();
        } else if (empty($userId)) {
            $view->assign("teams", []);
            $view->assign("MemberCount", []);
            $view->setTemplate("Searchout/SearchOut.tpl");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Leave'])) {
            $teamid = $_POST['Leave'];
            Team::LeaveTeam($userId, $teamid);
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['Join'])) {
            $teamid = $_POST['Join'];
            if (!Team::isUserJoined($userId, $teamid)) {
                Team::JoinTeam($userId, $teamid);
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
        $userGroups = Team::getUserTeams('user1');
        $view->assign("userGroups", $userGroups);
        $view->setTemplate("Searchout/SearchOut.tpl");

    }
}