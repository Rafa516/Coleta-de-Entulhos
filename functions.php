<?php

use \Projeto\Model\User;
use \Projeto\Model\Call;
use \Projeto\DB\Sql;




	function formatDate($date)
	{

		return date('d/m/Y', strtotime($date));

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

	function totalCalls(){

		$total = Call::totalCall();
	

	   return  $total['callsTotal'];

	}

	function totalCallsID($iduser){

		$total = Call::totalCallID($iduser);
	

	   return  $total['callsTotalID'];

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

	function numPhotos($idcall){

		$total = Call::numPhotos($idcall);

	   	return  $total['photos'];

	}

	function namePhotos($idcall){

		$total = Call::namePhotos($idcall);

	   	return  $total['name'];
	}


	

?>