<?php

use \Projeto\PageAdmin;
use \Projeto\Model\User;

//------------------ROTA DA PÁGINA DE LOGIN--------------------------------//

$app->get('/admin/login', function() {  

	
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login-admin",[
		'error'=>user::getError(),
		'profileMsg'=>User::getSuccess(),
	]);

});


//---------ROTA DO FORMULÁRIO DE LOGIN----------------------//

$app->post('/admin/login', function() {

	try {

		User::login($_POST['login'], $_POST['despassword']);

	} catch(Exception $e) {

		User::setError($e->getMessage());

		header("Location: /admin/login");
		exit;

	}

	header("Location: /admin");
	exit;

});

$app->get("/admin/users/delete/:iduser",function($iduser){

	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	User::setSuccess("Usuário removido com sucesso.");

	header("Location: /admin/users");
 	exit;
});

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;

});



$app->get('/admin', function() {  


	User::verifyLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get('/admin/profile', function() {  


	User::verifyLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("admin-profile");

});



$app->post("/admin/profile/update/:iduser", function ($iduser) {

	$user = new User();

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header('Location: /admin/login');
	exit;

});

$app->post("/admin/profile/update_image/:iduser", function ($iduser) {

	$user = new User();

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->updateImage();

	header('Location: /admin/login');
	exit;

});



$app->get('/admin/users', function() {  


	User::verifyLoginAdmin();

	$users = User::listAll();

	$page = new PageAdmin();
	
	
	$page->setTpl("users", array(	
		"users"=>$users,
		'profileMsg'=>User::getSuccess(),
		'errorRegister'=>User::getErrorRegister()
		
	));

});

$app->post("/admin/users/register", function(){

	if (User::checkEmailExist($_POST['email']) === true) {

		User::setErrorRegister("Este endereço de e-mail já está sendo usado por outro usuário.");
		header("Location: /admin/users");
		exit;

	}

	if (User::checkLoginExist($_POST['login']) === true) {

		User::setErrorRegister("Este Login já está sendo usado por outro usuário.");
		header("Location: /admin/users");
		exit;

	}

	$user = new User();

	$user->setData([
		'inadmin'=>1,
		'login'=>$_POST['login'],
		'person'=>$_POST['person'],
		'email'=>$_POST['email'],
		'despassword'=>$_POST['despassword'],
		'phone'=>$_POST['phone'],
		'born_date'=>$_POST['born_date'],
		'city'=>$_POST['city'],
		'address'=>$_POST['address'],
		'picture'=>0
	]);

	$user->save();

	User::setSuccess("Usuário cadastrado com sucesso");

	header('Location: /admin/users');
	exit;

});

?>