<?php

use \Projeto\PageAdmin;
use \Projeto\Model\User;
use \Projeto\Model\Information;

//---------ROTA PARA DELETAR UMA INFORMAÇÃO ----------------------//

$app->get("/admin/informations/delete/:idinf",function($idinf){

	$informations = new Information();

	$informations->get((int)$idinf);

	$informations->delete();

	User::setSuccess("Informação removida com sucesso.");

	header("Location: /admin/informations");
 	exit;
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


?>
