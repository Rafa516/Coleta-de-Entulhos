<?php 
session_start();

//dependências
require_once("models/autoload.php");

//name space

$app = new \Slim\Slim(); 

$app->config('debug', true);

require_once("controller/app-user.php");
require_once("controller/app-admin.php");
require_once("controller/app-admin-marker.php");
require_once("controller/app-admin-informations.php");
require_once("controller/app-admin-collects.php");
require_once("controller/app-user-marker.php");
require_once("controller/app-user-informations.php");
require_once("controller/app-user-collects.php");
require_once("controller/functions.php");






$app->run();

 ?>