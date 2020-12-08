<?php 
session_start();

//dependências
require_once("vendor/autoload.php");

//name space
use \Slim\slim;

$app = new \Slim\Slim(); 

$app->config('debug', true);

require_once("user-site.php");
require_once("admin-site.php");
require_once("functions.php");


$app->run();

 ?>