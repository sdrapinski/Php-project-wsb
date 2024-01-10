<?php
namespace Draszanicus\controllers;

use Draszanicus\common\Controller;
use Draszanicus\logic\View;
use Draszanicus\logic\DB;

class ProfileController extends Controller
{
    
    private $userId;

    public function __construct()
    {
        // Pobierz identyfikator użytkownika z sesji
        session_start();
        $this->userId = 2;
    }


    public function execute()
    {
        $userData = $this->getUserData($this->userId);

        $view = new View();

        $view->assign("username", $userData['username'] ?? '');
        $view->assign("currentEmail", $userData['email'] ?? '');
        $view->assign("currentGroups", $this->getUserTeams($this->userId));
        $view->assign("Userek", 'CEGLASTY');
        $view->assign("Password", 'CEGLASTY');
        $view->assign("changeEmail", 'CEGLASTY');

        if (!empty($_POST['action'])) {
                if ($_POST['action'] == "change-username") {
                $this->changeUsername();
                $view->assign("Userek", 'test');
                $view->setTemplate("Settings/Profile.tpl");
            }        
            elseif ($_POST['action'] == "change-password") {
                $this->changePassword();
                $view->assign("Password", 'teste');
                $view->setTemplate("Settings/Profile.tpl");

            } elseif ($_POST['action'] == "change-email") {
                $this->changeEmail();
                $view->assign("changeEmail", 'testerer');
                $view->setTemplate("Settings/Profile.tpl");
            }
        } else
        {
            $view->setTemplate("Settings/Profile.tpl"); 
        }

        

    }

    public function changeEmail()
    {
        $newEmail = $_POST['newEmail']; 
        $this->updateUserEmail(2, $newEmail);

        $this->redirectToProfile();
    }

    public function changePassword()
    {
        $newPassword = $_POST['newPassword'];
        $this->updateUserPassword(2, $newPassword);

        $this->redirectToProfile();
    }

    public function changeUsername()
    {
        $newUsername = $_POST['newUsername'];
        $currentUsername = $_POST['currentUsername'];
    
        $this->updateUsername(2, $newUsername);
    
        $this->redirectToProfile();
    }
    
    
    

    private function redirectToProfile()
    {
        header('Location: /profile');
        exit();
    }

    private function getUserData($userId)
    {
        $userDataQuery = DB::get()->query()
            ->select('username', 'email')
            ->from('Users')
            ->where('id = ?')
            ->setParameter(0, $userId)
            ->execute()
            ->fetchAssociative();

        return $userDataQuery;
    }

    private function getUserTeams($userId)
    {
        if ($userId !== null) {
            return DB::get()->query()
                ->select('t.id', 't.name', 't.description')
                ->from('Teams', 't')
                ->innerJoin('t', 'UserToTeam', 'ut', 't.id = ut.id_team')
                ->innerJoin('ut', 'Users', 'u', 'ut.id_user = u.id')
                ->where('u.id = ?')
                ->setParameter(0, $userId)
                ->execute()
                ->fetchAllAssociative();
        } else {
            return [];
        }
    }
    

    private function updateUserEmail($userId, $newEmail)
    {
        return DB::get()->query()
            ->update('Users')
            ->set('email', '?')
            ->where('id = ?')
            ->setParameter(0, $newEmail)
            ->setParameter(1, $userId)
            ->execute();
    }

    private function updateUserPassword($userId, $newPassword)
    {
        return DB::get()->query()
            ->update('Users')
            ->set('password', '?')
            ->where('id = ?')
            ->setParameter(0, $newPassword)
            ->setParameter(1, $userId)
            ->execute();
    }

    private function updateUsername($userId, $newUsername)
    {
        return DB::get()->query()
                ->update('Users')
                ->set('username', '?')
                ->where('id = ?')
                ->setParameter(0, $newUsername)
                ->setParameter(1, $userId)
                ->execute();
    }
    

    public function routeAction($action)
    {
        if (method_exists($this, $action)) {
            $this->$action();
        } else {
            echo "Nieprawidłowa akcja";
        }
    }
}
