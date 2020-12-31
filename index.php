<?php 
session_start();

//dependências
require_once("vendor/autoload.php");

//name space

$app = new \Slim\Slim(); 

$app->config('debug', true);

require_once("app-user.php");
require_once("app-admin.php");
require_once("functions.php");






$app->run();

 ?>