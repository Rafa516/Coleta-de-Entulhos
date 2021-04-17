<?php

use \Projeto\PageAdmin;
use \Projeto\Model\User;
use \Projeto\Model\Collect;



//---------ROTA PARA DELETAR O LOCAL ----------------------//

$app->get("/admin/collects/delete/:idcollect",function($idcollect){

	$collect = new Collect();

	$collect->get((int)$idcollect);

	$collect->delete();

	User::setSuccess("Local removido com sucesso.");

	header("Location: /admin/all-collects");
 	exit;
});


//---------ROTA PARA A PÁGINA DOS PONTOS DE COLETA-------------------//

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

	$collect = new Collect();

	if ($_POST['lat'] == '' &&  $_POST['lng'] == '') {

			User::setErrorRegister("Marque um local no mapa");
			header("Location: /admin/add-collect");
			exit;

	}

	$collect->setData($_POST);



	$collect->save();

	User::setSuccess("Ponto de Coleta registrado com sucesso!!");

	header("Location: /admin/add-collect");
	exit;


});


//---------ROTA PARA A PÁGINA DOS PONTOS DE COLETA-------------------//

$app->get('/admin/all-collects', function() {  


	User::verifyLoginAdmin();

	$collect = new Collect();

	$search = (isset($_GET['search'])) ? $_GET['search'] : "";
	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	if ($search != '') {

		$pagination = $collect::getPageSearch($search, $page);

	} else {

		$pagination = $collect::getPage($page);

	}

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) { 
		array_push($pages, [
			'link'=>'/admin/all-collects?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new PageAdmin();

	$page->setTpl("admin-all-collects",[
	 "search"=>$search,
	 "pages"=>$pages,
	 "allCollects"=>$pagination['data'],
	 'profileMsg'=>User::getSuccess()
	]);

});

//---------ROTA PARA A PÁGINA DE LOCALIZAÇÃO NO MAPA----------------------//

$app->get('/admin/collects/maps/:idcollect', function($idcollect) {  

	User::verifyLoginAdmin();

	$collect = new Collect();

	$page = new PageAdmin();

	$page->setTpl("map-collects-admin",[
		"collect"=>$collect->get((int)$idcollect),
		"collects"=>$collect->listCollectsID($idcollect),
		"value"=>$collect->listServices($idcollect)
	]);

});

//---------ROTA PARA A PÁGINA DAS IMAGENS---------------------//

$app->get('/admin/collects/images/:idcollect', function($idcollect) {  


	User::verifyLoginAdmin();

	$collect = new Collect();

	$page = new PageAdmin();

	$page->setTpl("image-collects-admin",[
		'images'=>$collect->showPhotos($idcollect),
		"collects"=>$collect->listCollectsID($idcollect)
	]);

});

//---------ROTA PARA A PÁGINA DO MAPA COM TODOS PONTOS DE COLETAS----------------------//

$app->get('/admin/locations-collects', function() {  


	User::verifyLoginAdmin();

	$collect = new Collect();

	$page = new PageAdmin();

	$page->setTpl("locations-collects-admin",[
	"serviceOne"=>$collect::serviceOne(),
	"serviceTwo"=>$collect::serviceTwo(),
	"serviceThree"=>$collect::serviceThree(),
	"serviceFour"=>$collect::serviceFour()	
	]);

});

?>