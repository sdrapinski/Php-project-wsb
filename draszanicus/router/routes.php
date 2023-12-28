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
SimpleRouter::post('/', function() {
    ControllerLoader::load("Home");
});
SimpleRouter::post("/{action}", function ($action){
    ControllerLoader::load("Home");
});
