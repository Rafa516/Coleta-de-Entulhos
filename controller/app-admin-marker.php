<?php

use \Projeto\PageAdmin;
use \Projeto\Model\User;
use \Projeto\Model\Marker;


//---------ROTA PARA DELETAR O LOCAL ----------------------//

$app->get("/admin/markers/delete/:idmarker",function($idmarker){

	$marker = new Marker();

	$marker->get((int)$idmarker);

	$marker->delete();

	User::setSuccess("Local removido com sucesso.");

	header("Location: /admin/all-markers");
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


?>