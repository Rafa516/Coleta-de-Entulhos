<?php

use \Projeto\Page;
use \Projeto\Model\User;
use \Projeto\Model\Call;

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

//------------------ROTA  DO FORMULÁRIO DE REGISTRO DOS USUÁRIOS--------------------------------//

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
		'born_date'=>$_POST['born_date'],
		'city'=>$_POST['city'],
		'genre'=>$_POST['genre'],
		'address'=>$_POST['address'],
		'picture'=>0
	]);

	$user->save();

	User::setSuccess("Usuário registrado com sucesso!! Efetue o Acesso");

	header("Location: /");
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

//---------ROTA PARA ENCERRAR A SESSÃO----------------------//

$app->get('/user/logout', function() {

	User::logout();

	header("Location: /");
	exit;

});


//---------ROTA PARA A PÁGINA INICIAL----------------------//

$app->get('/user', function() {  


	User::verifyLogin();

	$page = new Page();

	$page->setTpl("index");

});

//---------ROTA PARA A PÁGINA DE ABERTURA DOS CHAMADOS----------------------//

$app->get('/user/open-call', function() {  


	User::verifyLogin();

	$page = new Page();

	$page->setTpl("open-call-users",[
		'CallOpenMsg'=>User::getSuccess(),
		'errorRegister'=>User::getErrorRegister()
	]);

});

//---------ROTA PARA A PÁGINA DO PERFIL DO USUÁRIO----------------------//


$app->post("/user/open-call/submit", function(){

	User::verifyLogin();

	$call = new Call();

	if ($_POST['lat'] == '' &&  $_POST['lng'] == '') {

			User::setErrorRegister("Marque um local no mapa");
			header("Location: /user/open-call");
			exit;

	}

	$call->setData($_POST);

	$call->save();

	User::setSuccess("Chamado registrado com sucesso!!");

	header("Location: /user/open-call");
	exit;


});


//---------ROTA PARA A PÁGINA DOS MEUS CHAMADOS----------------------//

$app->get('/user/my-calls/:iduser', function($iduser) {  


	User::verifyLogin();

	$user = User::getFromSession();

	$call = new Call();

	$page = new Page();

	$page->setTpl("mycalls",[
		'user'=>$user->getValues(),
		'images'=>$call->showPhotos($iduser),
		'calls'=>$call->getCallsID($iduser)

	]);

});

//---------ROTA PARA A PÁGINA DAS IMAGENS DOS CHAMADOS----------------------//

$app->get('/user/calls/images/:idcall', function($idcall) {  


	User::verifyLogin();

	$call = new Call();

	$page = new Page();

	$page->setTpl("image-calls-user",[
		'images'=>$call->showPhotos($idcall),
		"call"=>$call->get((int)$idcall)
	]);

});

//---------ROTA PARA A PÁGINA DE LOCALIZAÇÃO NO MAPA----------------------//

$app->get('/user/calls/maps/:idcall', function($idcall) {  


	User::verifyLogin();

	$call = new Call();

	$page = new Page();

	$page->setTpl("map-calls-user",[
		"call"=>$call->get((int)$idcall),
		"markers"=>$call->listMarkersID($idcall)	
	]);

});

//---------ROTA PARA A PÁGINA DO MAPA COM TODOS LOCAIS MARCADOS)----------------------//

$app->get('/user/locations', function() {  


	User::verifyLogin();

	$call = new Call();

	$page = new Page();

	$page->setTpl("locations-user",[
	"markers"=>$call::listAllMarkers()
	]);

});

//---------ROTA PARA  A PÁGINA DO PERFIL DO USUÁRIO----------------------//

$app->get('/user/profile', function() {  


	User::verifyLogin();

	$page = new Page();

	$page->setTpl("user-profile");

});

$app->get('/user/all-calls', function() {  


	User::verifyLogin();

	$call = new Call();

	$page = new Page();

	$page->setTpl("user-AllCalls",[
	 "allCalls"=>$call::listAll()
	]);

});


//---------ROTA PARA ALTERAR OS DADOS DO USUÁRIO - POST----------------------//

$app->post("/user/profile/update/:iduser", function ($iduser) {

	$user = new User();

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header('Location: /');
	exit;

});

//---------ROTA PARA ALTERAR A FOTO DO PERFIL DO USUÁRIO - POST---------------------//

$app->post("/user/profile/update_image/:iduser", function ($iduser) {

	$user = new User();

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->updateImage();

	header('Location: /');
	exit;

});


?>