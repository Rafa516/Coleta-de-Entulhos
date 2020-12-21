<?php

use \Projeto\Model\User;
use \Projeto\Model\Call;


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

	function totalCallPendings(){

		$total = Call::totalCallsPendings();

	   return  $total['callsPendings'];

	}

	function totalCallProgress(){

		$total = Call::totalCallsProgress();

	   return  $total['callsProgress'];

	}

	function totalCallFinished(){

		$total = Call::totalCallsFinished();

	   return  $total['callsFinished'];

	}




?>