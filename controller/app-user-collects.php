<?php

use \Projeto\Page;
use \Projeto\Model\User;
use \Projeto\Model\Collect;



//---------ROTA PARA A PÁGINA DOS PONTOS DE COLETA-------------------//

$app->get('/user/all-collects', function() {  


	User::verifyLogin();

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
			'link'=>'/user/all-collects?page='.$i,
			'page'=>$i,
			'search'=>$search,
		]);
	}

	$page = new Page();

	$page->setTpl("user-all-collects",[
	 "search"=>$search,
	 "pages"=>$pages,
	 "allCollects"=>$pagination['data'],
	 'profileMsg'=>User::getSuccess()
	]);

});

//---------ROTA PARA A PÁGINA DE LOCALIZAÇÃO NO MAPA----------------------//

$app->get('/user/collects/maps/:idcollect', function($idcollect) {  

	User::verifyLogin();

	$collect = new Collect();

	$page = new Page();

	$page->setTpl("map-collects-user",[
		"collect"=>$collect->get((int)$idcollect),
		"collects"=>$collect->listCollectsID($idcollect),
		"value"=>$collect->listServices($idcollect)
	]);

});

//---------ROTA PARA A PÁGINA DAS IMAGENS---------------------//

$app->get('/user/collects/images/:idcollect', function($idcollect) {  


	User::verifyLogin();

	$collect = new Collect();

	$page = new Page();

	$page->setTpl("image-collects-user",[
		'images'=>$collect->showPhotos($idcollect),
		"collects"=>$collect->listCollectsID($idcollect)
	]);

});

//---------ROTA PARA A PÁGINA DO MAPA COM TODOS PONTOS DE COLETAS----------------------//

$app->get('/user/locations-collects', function() {  


	User::verifyLogin();

	$collect = new Collect();

	$page = new Page();

	$page->setTpl("locations-collects-user",[
	"serviceOne"=>$collect::serviceOne(),
	"serviceTwo"=>$collect::serviceTwo(),
	"serviceThree"=>$collect::serviceThree(),
	"serviceFour"=>$collect::serviceFour()	
	]);

});

?>