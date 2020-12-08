<?php

use \Projeto\Page;
use \Projeto\Model\User;

//------------------ROTA DA PÁGINA DE LOGIN--------------------------------//

$app->get('/', function() {  

	
	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login-user",[
		'error'=>user::getError(),
		'profileMsg'=>User::getSuccess(),
		'errorRegister'=>User::getErrorRegister(),
	]);

});

//------------------ROTA  DO FORMULÁRIO DE REGISTRO--------------------------------//
$app->post("/register", function(){

	if (User::checkEmailExist($_POST['email']) === true) {

		User::setErrorRegister("Este endereço de e-mail já está sendo usado por outro usuário.");
		header("Location: /");
		exit;

	}

	$user = new User();

	$user->setData([
		'inadmin'=>0,
		'login'=>$_POST['email'],
		'person'=>$_POST['person'],
		'email'=>$_POST['email'],
		'despassword'=>$_POST['despassword'],
		'phone'=>$_POST['phone'],
		'picture'=>0
	]);


	$user->save();

	User::setSuccess("Usuário registrado com sucesso!! Efetue o Acesso");

	header('Location: /');
	exit;

});

//---------ROTA DO FORMULÁRIO DE LOGIN----------------------//

$app->post('/login', function() {

	try {

		User::login($_POST['login'], $_POST['despassword']);

	} catch(Exception $e) {

		User::setError($e->getMessage());

		header("Location: /");
		exit;

	}

	header("Location: /user");
	exit;

});

$app->get('/user/logout', function() {

	User::logout();

	header("Location: /");
	exit;

});

$app->get('/user', function() {  


	User::verifyLogin();

	$page = new Page();

	$page->setTpl("index");

});

?>