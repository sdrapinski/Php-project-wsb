<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('ROOT_PATH', $_ENV['ROOT_PATH']);
define('HOST_PROTOCOL', $_ENV['HOST_PROTOCOL']);
define('HOST_SUBDOMAIN', $_ENV['HOST_SUBDOMAIN']);
const WWW_R = HOST_PROTOCOL . "://" . HOST_SUBDOMAIN;

require_once ROOT_PATH . "/config/errorConfig.php";