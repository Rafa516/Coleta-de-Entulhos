<?php

use \Projeto\Page;
use \Projeto\Model\User;
use \Projeto\Model\Marker;
use \Projeto\Model\Information;

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


$app->get('/user/informations', function() {  


	User::verifyLogin();



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
			'link'=>'/user/informations?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}


	$page = new Page();

	$page->setTpl("user-informations",[
	"informationsOpenMsg"=>User::getSuccess(),
	 "search"=>$search,
	 "pages"=>$pages,
	 "informations"=>$pagination['data']
	]);

});
//---------ROTA PARA A PÁGINA DE MARCAÇÕES DOS LOCAIS----------------------//

$app->get('/user/open-marker', function() {  


	User::verifyLogin();

	$page = new Page();

	$page->setTpl("open-marker-users",[
		'markerOpenMsg'=>User::getSuccess(),
		'errorRegister'=>User::getErrorRegister()
	]);

});

//---------ROTA PARA A PÁGINA DO PERFIL DO USUÁRIO----------------------//


$app->post("/user/open-marker/submit", function(){

	User::verifyLogin();

	$marker = new Marker();

	if ($_POST['lat'] == '' &&  $_POST['lng'] == '') {

			User::setErrorRegister("Marque um local no mapa");
			header("Location: /user/open-marker");
			exit;

	}

	$marker->setData($_POST);

	$marker->save();

	User::setSuccess("Local registrado com sucesso!!");

	header("Location: /user/open-marker");
	exit;


});



//---------ROTA PARA A PÁGINA DAS IMAGENS DOS LOCAIS----------------------//

$app->get('/user/markers/images/:idmarker', function($idmarker) {  


	User::verifyLogin();

	$marker = new Marker();

	$page = new Page();

	$page->setTpl("image-markers-user",[
		'images'=>$marker->showPhotos($idmarker),
		"markers"=>$marker->listMarkersID($idmarker)
	]);

});

//---------ROTA PARA A PÁGINA DE LOCALIZAÇÃO NO MAPA----------------------//

$app->get('/user/markers/maps/:idmarker', function($idmarker) {  


	User::verifyLogin();

	$marker = new Marker();

	$page = new Page();

	$page->setTpl("map-markers-user",[
		"marker"=>$marker->get((int)$idmarker),
		"markers"=>$marker->listMarkersID($idmarker)	
	]);

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

	$page->setTpl("user-profile");

});

//---------ROTA PARA  A PÁGINA DE TABELAS DE TODOS CHAMADOS----------------------//

$app->get('/user/all-markers', function() {  


	User::verifyLogin();

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
			'link'=>'/user/all-markers?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new Page();

	$page->setTpl("user-AllMarkers",[
	 "search"=>$search,
	 "pages"=>$pages,
	 "allmarkers"=>$pagination['data'],
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