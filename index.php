<?php 
session_start();

//dependências
require_once("vendor/autoload.php");

//name space
use \Slim\slim;

$app = new \Slim\Slim(); 

$app->config('debug', true);

require_once("site.php");


$app->run();

 ?>