<?php
namespace Draszanicus\controllers;

use Draszanicus\common\Controller;
use Draszanicus\logic\View;
use Draszanicus\logic\DB;
use Draszanicus\logic\User;

class ProfileController extends Controller
{
    private array $userData;
    public function execute()
    {
        $this->userData = User::getUser();
        $userId = array_key_exists("id", $this->userData) ? (int)$this->userData["id"] : 0  ;
        

        $view = new View();

        $view->assign("username", $this->userData['username'] ?? '');
        $view->assign("currentEmail", $this->userData['email'] ?? '');
        $view->assign("currentGroups", $this->getUserTeams($userId));
        $error_info = "";
     

        if (!empty($_POST['action'])) {
            if ($_POST['action'] == "change-username") {
              
                
               $error_info =  $this->changeUsername($userId);
                $view->assign("error_info",$error_info);
                $view->assign("username", $this->userData['username'] ?? '');
                $view->setTemplate("Settings/Profile.tpl");

            }        
            elseif ($_POST['action'] == "change-password") {
                
               $error_info =  $this->changePassword($userId);
                $view->assign("error_info",$error_info);
                
                $view->setTemplate("Settings/Profile.tpl");

            } elseif ($_POST['action'] == "change-email") {
               $error_info =  $this->changeEmail($userId);
                $view->assign("error_info",$error_info);
                $view->assign("currentEmail", $this->userData['email'] ?? '');
                $view->setTemplate("Settings/Profile.tpl");
            }
        } else
        {
            $view->assign("error_info",$error_info);
            $view->setTemplate("Settings/Profile.tpl"); 
        }

        User::saveUser($this->userData);

        

    }

    public function changeEmail($userId)
    {
        $newEmail = $_POST['newEmail']; 

        if(!empty($newEmail) && filter_var($newEmail,FILTER_VALIDATE_EMAIL)){
            if(!$this->checkEmail($newEmail)){
                $this->updateUserEmail($userId, $newEmail);
                $this->userData["email"] = $newEmail;
                return "";
            }
            return "This email already exist";
          
        }else{
            return "Please insert correct email type";
        }

        

       
    }

    public function changePassword($userId)
    {
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if( !empty($confirmPassword) && !empty($newPassword) && strlen($newPassword) >=8 && $confirmPassword == $newPassword){
            $this->updateUserPassword($userId, $newPassword);
            $this->userData["password"] = $newPassword;
            return "";
         
           
        }else{
           return "Wrong Passoword parameters. </br> Password should have 8 letters and match with confirm password";
        
        }
       
       

        
    }

    public function changeUsername($userId)
    {
        $newUsername = $_POST['newUsername'];
       
        if(!empty($newUsername)){
            if(!($this->checkUsername($newUsername)))
            {
                $this->updateUsername($userId, $newUsername);
                $this->userData["username"] = $newUsername;
                 return "";
            }
            return "This username already exist";
            
        }
        else{
            return "Username cant be empty";
        }
    
       


    
        
    }
    
    private function checkUsername($username)
    {
        $query = DB::get()->query()
            ->select('username')
            ->from('Users')
            ->where('username = ?')
            ->setParameter(0, $username);
           

            $result = $query->execute()->fetchOne();

            return $result > 0;
    }

    private function checkEmail($email)
    {
        $query = DB::get()->query()
            ->select('email')
            ->from('Users')
            ->where('email = ?')
            ->setParameter(0, $email);
           

            $result = $query->execute()->fetchOne();

            return $result > 0;
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
