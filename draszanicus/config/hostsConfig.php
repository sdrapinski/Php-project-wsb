<?php

$config = parse_ini_file("draszanicus.ini");

define('HOST_PROTOCOL', $config['HOST_PROTOCOL']);
define('HOST_SUBDOMAIN', $config['HOST_SUBDOMAIN']);
const WWW_R = HOST_PROTOCOL . "://" . HOST_SUBDOMAIN;