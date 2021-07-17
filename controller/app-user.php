<?php

use \Projeto\Page;
use \Projeto\Model\User;
use \Projeto\Model\Marker;
use \Projeto\Model\Information;
use \Projeto\Model\Collect;

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

//---------ROTA DA PÁGINA RECUPERAR SENHA ----------------------//

$app->get("/forgot", function() {

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot",[
		'error'=>user::getError(),
		'profileMsg'=>User::getSuccess()

	]);	

});

//---------ROTA DA PÁGINA RECUPERAR SENHA  ENVIO DO FORMULÁRIO (POST)----------------------//

$app->post("/forgot", function(){

	try {

		User::getForgot($_POST["email"]);

	} catch(Exception $e) {

		User::setError($e->getMessage());

		header("Location: /forgot");
		exit;
	}

	User::setSuccess("E-mail enviado!
	Verifique as instruções no seu e-mail.");

	header("Location: /forgot");
	exit;
	
});

//---------ROTA DA PÁGINA ALTERAR SENHA ----------------------//

$app->get("/forgot/reset", function() {

	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset",[
		'error'=>user::getError(),
		'profileMsg'=>User::getSuccess(),
		'name'=>$user["person"],
		'code'=>$_GET["code"]

	]);	

});

//---------ROTA DA PÁGINA ALTERAR SENHA (POST)----------------------//
$app->post("/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);	


	User::setForgotUsed($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$password = User::getPasswordHash($_POST["despassword"]);

	$user->setPassword($password);

	User::setSuccess("Senha Alterada com succeso!");

	header("Location: /");
	exit;

	

});
//---------ROTA DA PÁGINA DE ERRO AO ALTERAR SENHA----------------------//
$app->get("/forgot/reset/error", function() {

	
	$page = new Page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset-error");	

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





//---------ROTA PARA A PÁGINA DO MAPA COM TODOS LOCAIS MARCADOS----------------------//

$app->get('/user/locations', function() {  


	User::verifyLogin();

	$marker = new Marker();

	$page = new Page();

	$page->setTpl("locations-user",[
	"markers"=>$marker::listAllMarkers()
	]);

});

//---------ROTA PARA  A PÁGINA DO PERFIL DO USUÁRIO----------------------//

$app->get('/user/profile', function() {  


	User::verifyLogin();

	$page = new Page();

	$page->setTpl("user-profile",[
	'changePassError'=>User::getError(),
	'changePassSuccess'=>User::getSuccess()

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

$app->post("/profile/change-password", function(){


	

	if ($_POST['current_pass'] === $_POST['new_pass']) {

		User::setError("A sua nova senha deve ser diferente da atual.");
		header("Location: /user/profile");
		exit;		

	}

	$user = User::getFromSession();

	if (!password_verify($_POST['current_pass'], $user->getdespassword())) {

		User::setError("A senha atual está inválida.");
		header("Location: /user/profile");
		exit;			

	}

	$user->setdespassword($_POST['new_pass']);

	$user->updatePassword();

	User::setSuccess("Senha alterada com sucesso.");

	header("Location: /user/profile");
	exit;

});


?>