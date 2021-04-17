
<?php

use \Projeto\Page;
use \Projeto\Model\User;
use \Projeto\Model\Marker;


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

?>