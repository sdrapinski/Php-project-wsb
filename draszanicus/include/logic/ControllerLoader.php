<?php

namespace Draszanicus\logic;

use Draszanicus\common\Controller;

class ControllerLoader
{
    public static function load(string $name, string $action = 'execute'): void
    {
        $controller = "Draszanicus\controllers\\" . $name . "Controller";
        
        // Sprawdź, czy klasa kontrolera istnieje
        if (class_exists($controller)) {
            $controllerInstance = new $controller;

            // Sprawdź, czy akcja istnieje w kontrolerze
            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->$action();
            } else {
                // Jeśli akcja nie istnieje, wywołaj domyślnie 'execute'
                $controllerInstance->execute();
            }
        } else {
            // Jeśli klasa kontrolera nie istnieje, wyświetl błąd
            echo "Nieprawidłowa klasa kontrolera";
        }
    }
}
