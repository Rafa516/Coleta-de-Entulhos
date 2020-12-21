<?php

use \Projeto\PageAdmin;
use \Projeto\Model\User;
use \Projeto\Model\Call;

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

//---------ROTA PARA DELETAR O USUÁRIO----------------------//

$app->get("/admin/users/delete/:iduser",function($iduser){

	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	User::setSuccess("Usuário removido com sucesso.");

	header("Location: /admin/users");
 	exit;
});


//---------ROTA PARA DELETAR O CHAMADO ----------------------//

$app->get("/admin/calls/delete/:idcall",function($idcall){

	$call = new Call();

	$call->get((int)$idcall);

	$call->delete();

	User::setSuccess("Chamado removido com sucesso.");

	header("Location: /admin/all-calls");
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

//---------ROTA PARA A PÁGINA DE TODOS CHAMADOS PENDENTES----------------------//

$app->get('/admin/calls-pendings', function() {  


	User::verifyLoginAdmin();

	$call = new Call();

	$page = new PageAdmin();

	$page->setTpl("calls-pendings",[
	"callPendings"=>$call::listCallPendigs(),
	"total"=>$call::totalCallsPendings()
	]);

});

//---------ROTA PARA A PÁGINA DE TODOS CHAMADOS EM ANDAMENTO----------------------//

$app->get('/admin/calls-progress', function() {  


	User::verifyLoginAdmin();

	$call = new Call();

	$page = new PageAdmin();

	$page->setTpl("calls-progress",[
	"callProgress"=>$call::listCallProgress(),
	"total"=>$call::totalCallsProgress()
	]);

});

//---------ROTA PARA A PÁGINA DE TODOS CHAMADOS FINALIZADOS----------------------//

$app->get('/admin/calls-finished', function() {  


	User::verifyLoginAdmin();

	$call = new Call();

	$page = new PageAdmin();

	$page->setTpl("calls-finished",[
	"callFinished"=>$call::listCallFinished(),
	"total"=>$call::totalCallsFinished()
	]);

});

//---------ROTA PARA A PÁGINA DE ABERTURA DOS CHAMADOS----------------------//

$app->get('/admin/open-call', function() {  


	User::verifyLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("open-call-admin",[
		'profileMsg'=>User::getSuccess(),

	]);

});

//---------ROTA PARA O REGISTRO DO CHAMADO ---------------------//


$app->post("/admin/open-call/submit", function(){

	User::verifyLoginAdmin();

	$call = new Call();

	$call->setData($_POST);

	$call->save();

	User::setSuccess("Chamado registrado com sucesso!!");

	header("Location: /admin/open-call");
	exit;


});

//---------ROTA PARA A PÁGINA DE TODOS OS CHAMADOS ---------------------//

$app->get('/admin/all-calls', function() {  


	User::verifyLoginAdmin();

	$call = new Call();

	$page = new PageAdmin();

	$page->setTpl("admin-all-calls",[
	 "allCalls"=>$call::listAll(),
	 'profileMsg'=>User::getSuccess()
	]);

});

//---------ROTA PARA A PÁGINA DE SITUAÇÃO DOS CHAMADOS ---------------------//

$app->get('/admin/call-situation/:idcall', function($idcall) {  


	User::verifyLoginAdmin();

	$call = new Call();

	$page = new PageAdmin();

	$page->setTpl("call-situation",[
		"idcall"=>$call->get((int)$idcall),
		"callSituation"=>$call->valueSituation((int)$idcall),

	]);

});

//---------ROTA PARA A ALTERAÇÃO DOS CHAMADOS ---------------------//

$app->post("/admin/calls/update-situation/:idcall",function($idcall){

	$call = new Call();

	$call->get((int)$idcall);

	$call->setData($_POST);

	$call->updateSituation();

	User::setSuccess("Situação alterada com Sucesso");

	header("Location: /admin/all-calls");
 	exit;
});


//---------ROTA PARA A PÁGINA DAS IMAGENS---------------------//

$app->get('/admin/calls/images/:idcall', function($idcall) {  


	User::verifyLoginAdmin();

	$call = new Call();

	$page = new PageAdmin();

	$page->setTpl("image-calls-admin",[
		'images'=>$call->showPhotos($idcall),
		"call"=>$call->get((int)$idcall)
	]);

});

//---------ROTA PARA A PÁGINA DE LOCALIZAÇÃO NO MAPA----------------------//

$app->get('/admin/calls/maps/:idcall', function($idcall) {  

	User::verifyLoginAdmin();

	$call = new Call();

	$page = new PageAdmin();

	$page->setTpl("map-calls-admin",[
		"call"=>$call->get((int)$idcall)
	]);

});

//---------ROTA PARA A PÁGINA DO PERFIL DO USUÁRIO)----------------------//

$app->get('/admin/profile', function() {  


	User::verifyLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("admin-profile");

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

	$users = User::listAll();

	$page = new PageAdmin();
	
	
	$page->setTpl("users", array(	
		"users"=>$users,
		'profileMsg'=>User::getSuccess(),
		'errorRegister'=>User::getErrorRegister()
		
	));

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