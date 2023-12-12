<?php
namespace Draszanicus\controllers;

class HomeController{
    private string $message;
    public function __construct() {
        $this->message = "0";
    }
    public function getMessage(){
        return $this->message;
    }
}