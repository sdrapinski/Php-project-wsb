<?php

namespace Draszanicus\controllers;

use Draszanicus\common\Controller;
use Draszanicus\logic\DB;
use Draszanicus\logic\View;

class ProfileController extends Controller
{
    public function execute()
    {


        // Tutaj dodaj logikę pobierania danych użytkownika z bazy danych
        $username = "ExampleUser"; // Przykładowa nazwa użytkownika
        $currentEmail = "example@example.com"; // Przykładowy aktualny adres e-mail
        $currentGroups = "Group1, Group2"; // Przykładowe grupy do których użytkownik należy

        // Przekazanie danych do widoku
        $view = new View();
     
        $view->assign("username", $username);
        $view->assign("currentEmail", $currentEmail);
        $view->assign("currentGroups", $currentGroups);

        if(empty($_GET['action']))
        {
            $view->setTemplate("Settings/Profile.tpl");
        }
        else if(($_GET['action']) == "change-username")
        {
            $view->setTemplate("Settings/ChangeUsername.tpl");
        }
        else if(($_GET['action']) == "change-password")
        {
            $view->setTemplate("Settings/ChangePassword.tpl");
        }
        else if(($_GET['action']) == "change-email")
        {
            $view->setTemplate("Settings/ChangeEmail.tpl");
        }
    }

    public function changeEmail()
    {
        // Logika zmiany adresu e-mail
        // ...

        // Przekieruj użytkownika z powrotem do profilu lub innej strony
        header('Location: /profile');
        exit();
    }

    public function changePassword()
    {
        // Logika zmiany hasła
        // ...

        // Przekieruj użytkownika z powrotem do profilu lub innej strony
        header('Location: /profile');
        exit();
    }

    public function changeUsername()
    {
        // Logika zmiany nazwy użytkownika
        // ...

        // Przekieruj użytkownika z powrotem do profilu lub innej strony
        header('Location: /profile');
        exit();
    }
    public function routeAction($action)
{
    // Dynamiczne wywołanie metody na podstawie akcji
    if (method_exists($this, $action)) {
        $this->$action();
    } else {
        // Obsługa błędu, jeśli metoda nie istnieje
        echo "Nieprawidłowa akcja";
    }
}
}
