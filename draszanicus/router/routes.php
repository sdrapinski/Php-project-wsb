<?php
use Pecee\SimpleRouter\SimpleRouter;
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;
use \Draszanicus\logic\ControllerLoader;

SimpleRouter::get('/', function() {
    ControllerLoader::load("Home");
});

SimpleRouter::get('/profile', function() {
    ControllerLoader::load("Profile");
});

SimpleRouter::match(['get','post'],"/{action}", function ($action){
    ControllerLoader::load("Home");
});

SimpleRouter::match(['get','post'], "/profile/{action}", function ($action){
    ControllerLoader::load("Profile");
});
