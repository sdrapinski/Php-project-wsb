<?php
use Pecee\SimpleRouter\SimpleRouter;
use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;
use Draszanicus\controllers;

SimpleRouter::get('/', function() {
    $home = new controllers\HomeController();
    return $home->getMessage();
});