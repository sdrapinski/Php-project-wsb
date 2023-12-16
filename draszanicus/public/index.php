<?php

use Draszanicus\logic\ControllerLoader;
use Draszanicus\logic\DB;

require_once realpath("../vendor/autoload.php");
require_once realpath("../config/config.php");
DB::connect();
require_once ROOT_PATH . "/router/router.php";