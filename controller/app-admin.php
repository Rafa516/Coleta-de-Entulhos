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

//---------ROTA DA PÁGINA RECUPERAR SENHA ----------------------//

$app->get("/admin/forgot", function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-admin",[
		'error'=>user::getError(),
		'profileMsg'=>User::getSuccess()

	]);	

});

//---------ROTA DA PÁGINA RECUPERAR SENHA  ENVIO DO FORMULÁRIO (POST)----------------------//

$app->post("/admin/forgot", function(){

	try {

		User::getForgotAdmin($_POST["email"]);

	} catch(Exception $e) {

		User::setError($e->getMessage());

		header("Location: /admin/forgot");
		exit;
	}

	User::setSuccess("E-mail enviado!
	Verifique as instruções no seu e-mail.");

	header("Location: /admin/forgot");
	exit;
	
});

//---------ROTA DA PÁGINA ALTERAR SENHA ----------------------//

$app->get("/admin/forgot/reset", function() {

	$user = User::validForgotDecryptAdmin($_GET["code"]);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("/admin/forgot-reset-admin",[
		'error'=>user::getError(),
		'profileMsg'=>User::getSuccess(),
		'name'=>$user["person"],
		'code'=>$_GET["code"]

	]);	

});

//---------ROTA DA PÁGINA ALTERAR SENHA (POST)----------------------//
$app->post("/admin/forgot/reset", function(){

	$forgot = User::validForgotDecryptAdmin($_POST["code"]);	


	User::setForgotUsed($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$password = User::getPasswordHash($_POST["despassword"]);

	$user->setPassword($password);

	User::setSuccess("Senha Alterada com succeso!");

	header("Location: /admin/login");
	exit;

	

});
//---------ROTA DA PÁGINA DE ERRO AO ALTERAR SENHA----------------------//
$app->get("admin/forgot/reset/error", function() {

	
	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset-error-admin");	

});
//---------ROTA PARA DELETAR O USUÁRIO----------------------//

$app->get("/admin/users/delete/:iduser",function($iduser){

	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	User::setSuccess("Usuário removido com sucesso.");

	header("Location: /admin/users");
 	exit;
});



//---------ROTA PARA O ENCERRAMENTO DA SESSÃO (LOGOUT)----------------------//

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /admin/login");
	exit;

});

//---------ROTA PARA A PÁGINA INDEX (PAINEL) ----------------------//

$app->get('/admin', function() {  


	User::verifyLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("index");

});



//---------ROTA PARA A PÁGINA DO PERFIL DO USUÁRIO)----------------------//

$app->get('/admin/profile', function() {  


	User::verifyLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("admin-profile",[
	'changePassError'=>User::getError(),
	'changePassSuccess'=>User::getSuccess()

	]);

});

//---------ROTA PARA A EDIÇÃO DOS DADOS DO  PERFIL----------------------//

$app->post("/admin/profile/update/:iduser", function ($iduser) {

	$user = new User();

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header('Location: /admin/login');
	exit;

});


//---------ROTA PARA A EDIÇÃO DA FOTO  DO  PERFIL----------------------//

$app->post("/admin/profile/update_image/:iduser", function ($iduser) {

	$user = new User();

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->updateImage();

	header('Location: /admin/login');
	exit;

});

//---------ROTA PARA A PÁGINA DOS USUÁRIOS CADASTRADOS----------------------//

$app->get('/admin/users', function() {  


	User::verifyLoginAdmin();

	$user = new User();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $user::getPageSearch($search, $page);

	} else {

		$pagination = $user::getPage($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/admin/users?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}


	$page = new PageAdmin();

	$page->setTpl("users",[
	 "search"=>$search,
	 "pages"=>$pages,
	 "users"=>$pagination['data'],
	 'profileMsg'=>User::getSuccess(),
	 'errorRegister'=>User::getErrorRegister()
	]);


});

//---------ROTA PARA O REGISTRO DOS USUÁRIOS ADMINISTRADORES----------------------//

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
		'genre'=>$_POST['genre'],
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

$app->get('/admin/users/update/:iduser', function($iduser){
 
   User::verifyLoginAdmin();
 
   $user = new User();
 
   $user->get((int)$iduser);
 
   $page = new PageAdmin();
 
   $page ->setTpl("admin-user-update", array(
        "user"=>$user->getValues(),
        'profileMsg'=>User::getSuccess(),
        'errorRegister'=>User::getErrorRegister()  
    ));
 
});


$app->post("/admin/users/update/:iduser",function($iduser){


	$user = new User();


	$user->get((int)$iduser);
 
  	$user->setData($_POST);

  	$user->update();

  	User::setSuccess("Dados alterados com Sucesso");

  	header("Location: /admin/users");
  	exit;


});

$app->post("/profile/change-password-adm", function(){


	

	if ($_POST['current_pass'] === $_POST['new_pass']) {

		User::setError("A sua nova senha deve ser diferente da atual.");
		header("Location: /admin/profile");
		exit;		

	}

	$user = User::getFromSession();

	if (!password_verify($_POST['current_pass'], $user->getdespassword())) {

		User::setError("A senha atual está inválida.");
		header("Location: /admin/profile");
		exit;			

	}

	$user->setdespassword($_POST['new_pass']);


	$user->updatePassword();

	User::setSuccess("Senha alterada com sucesso.");

	header("Location: /admin/profile");
	exit;

});



?>