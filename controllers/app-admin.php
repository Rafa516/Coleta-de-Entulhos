<?php

use \Projeto\PageAdmin;
use \Projeto\Model\User;
use \Projeto\Model\Marker;
use \Projeto\Model\Information;

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


//---------ROTA PARA DELETAR O LOCAL ----------------------//

$app->get("/admin/markers/delete/:idmarker",function($idmarker){

	$marker = new Marker();

	$marker->get((int)$idmarker);

	$marker->delete();

	User::setSuccess("Local removido com sucesso.");

	header("Location: /admin/all-markers");
 	exit;
});


//---------ROTA PARA DELETAR UMA INFORMAÇÃO ----------------------//

$app->get("/admin/informations/delete/:idinf",function($idinf){

	$informations = new Information();

	$informations->get((int)$idinf);

	$informations->delete();

	User::setSuccess("Informação removida com sucesso.");

	header("Location: /admin/informations");
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

//---------ROTA PARA A PÁGINA DE INFORMAÇÕES ----------------------//

$app->get('/admin/informations', function() {  


	User::verifyLoginAdmin();



	$informations = new Information();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $informations::getPageSearch($search, $page);

	} else {

		$pagination = $informations::getPage($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/admin/informations?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}


	$page = new PageAdmin();

	$page->setTpl("informations",[
	"informationsOpenMsg"=>User::getSuccess(),
	 "search"=>$search,
	 "pages"=>$pages,
	 "informations"=>$pagination['data']
	]);

});

//---------ROTA PARA A PÁGINA DE REGISTRO DE INFORMAÇÕES ----------------------//

$app->get('/admin/informations/register', function() {  


	User::verifyLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("informations-register",[
	'errorRegister'=>User::getErrorRegister()
	]);

});


//---------ROTA POST DO FORMULÁRIO DE REGISTRO DE INFORMAÇÕES  ----------------------//

$app->post("/admin/informations/submit", function(){

	User::verifyLoginAdmin();

	$informations = new Information();

	if ($_POST['informations'] == '' &&  $_POST['informations'] == '') {

			User::setErrorRegister("Escreva uma Informação");
			header("Location: /admin/informations/register");
			exit;

	}

	$informations->setData($_POST);

	

	$informations->save();



	User::setSuccess("Informação Registrada");

	header("Location: /admin/informations");
	exit;


});


//---------ROTA PARA A PÁGINA DE EDIÇÃO DAS INFORMAÇÕES----------------------//

$app->get('/admin/informations/update/:idinf', function($idinf){
 
  User::verifyLoginAdmin();
 
   $informations = new Information();
 
   $informations->get((int)$idinf);
 
   $page = new PageAdmin();
 
   $page ->setTpl("informations-update", array(
        "information"=>$informations->getValues()    
    ));
 
});


//---------ROTA POST DO FORMULÁRIO PARA A PÁGINA DE EDIÇÃO DAS INFORMAÇÕES----------------------//

$app->post("/admin/informations/update/:idinf", function($idinf){

	User::verifyLoginAdmin();

	$informations = new Information();

	$informations->get((int)$idinf);

	$informations->setData($_POST);

	$informations->update();

	User::setSuccess("Informação Alterada com sucesso");

	header("Location: /admin/informations");
	exit;

});


//---------ROTA PARA A PÁGINA DE MARCAÇÃO DOS LOCAIS----------------------//

$app->get('/admin/open-marker', function() {  


	User::verifyLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("open-marker-admin",[
		'markerOpenMsg'=>User::getSuccess(),
		'errorRegister'=>User::getErrorRegister()

	]);

});

//---------ROTA PARA O REGISTRO DAS MARCAÇÕES ---------------------//


$app->post("/admin/open-marker/submit", function(){

	User::verifyLoginAdmin();

	$marker = new Marker();

	if ($_POST['lat'] == '' &&  $_POST['lng'] == '') {

			User::setErrorRegister("Marque um local no mapa");
			header("Location: /admin/open-marker");
			exit;

	}

	$marker->setData($_POST);

	$marker->save();
	var_dump($marker);

	User::setSuccess("Local registrado com sucesso!!");

	header("Location: /admin/open-marker");
	exit;


});


//---------ROTA PARA A PÁGINA DOS PONTOS DE COLETA

$app->get('/admin/add-collect', function() {  


	User::verifyLoginAdmin();

	$page = new PageAdmin();

	$page->setTpl("add-collect",[
		'markerOpenMsg'=>User::getSuccess(),
		'errorRegister'=>User::getErrorRegister()

	]);

});


//---------ROTA PARA O REGISTRO DOS PONTOS DE COLETA ---------------------//
$app->post("/admin/add-collect/submit", function(){

	User::verifyLoginAdmin();

	$marker = new Marker();

	if ($_POST['lat'] == '' &&  $_POST['lng'] == '') {

			User::setErrorRegister("Marque um local no mapa");
			header("Location: /admin/open-marker");
			exit;

	}

	$marker->setData($_POST);

	$marker->save();

	User::setSuccess("Ponto de Coleta registrado com sucesso!!");

	header("Location: /admin/add-collect");
	exit;


});


//---------ROTA PARA A PÁGINA DE TODOS OS LOCAIS ---------------------//

$app->get('/admin/all-markers', function() {  


	User::verifyLoginAdmin();

	$marker = new Marker();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $marker::getPageSearch($search, $page);

	} else {

		$pagination = $marker::getPage($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/admin/all-markers?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("admin-all-markers",[
	 "search"=>$search,
	 "pages"=>$pages,
	 "allMarkers"=>$pagination['data'],
	 'profileMsg'=>User::getSuccess()
	]);

});



//---------ROTA PARA A PÁGINA DAS IMAGENS---------------------//

$app->get('/admin/markers/images/:idmarker', function($idmarker) {  


	User::verifyLoginAdmin();

	$marker = new Marker();

	$page = new PageAdmin();

	$page->setTpl("image-markers-admin",[
		'images'=>$marker->showPhotos($idmarker),
		"markers"=>$marker->listMarkersID($idmarker)
	]);

});

//---------ROTA PARA A PÁGINA DE LOCALIZAÇÃO NO MAPA----------------------//

$app->get('/admin/markers/maps/:idmarker', function($idmarker) {  

	User::verifyLoginAdmin();

	$marker = new marker();

	$page = new PageAdmin();

	$page->setTpl("map-markers-admin",[
		"marker"=>$marker->get((int)$idmarker),
		"markers"=>$marker->listMarkersID($idmarker)
	]);

});

//---------ROTA PARA A PÁGINA DO MAPA COM TODOS LOCAIS MARCADOS----------------------//

$app->get('/admin/locations', function() {  


	User::verifyLoginAdmin();

	$marker = new marker();

	$page = new PageAdmin();

	$page->setTpl("locations-admin",[
	"markers"=>$marker::listAllMarkers()
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




?>