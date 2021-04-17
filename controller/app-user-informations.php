<?php

use \Projeto\Page;
use \Projeto\Model\User;
use \Projeto\Model\Information;



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

?>