<?php

use \Projeto\Model\User;


	function formatDate($date)
	{

		return date('d/m/Y', strtotime($date));

	}


	function checkLogin($inadmin = true)
	{
		
		return User::checkLogin($inadmin);

	}

	function getUserName()
	{

		$res = User::getFromSession();

		$user =  $res->getperson();

		return utf8_decode($user);

	}

	function totalUsers(){

		$total = User::total();

	   return  $total['usersTotal'];

	}




?>