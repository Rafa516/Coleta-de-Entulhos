<?php

use \Projeto\Model\User;
use \Projeto\Model\Marker;
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

	function totalMarkers(){

		$total = Marker::totalMarker();
	

	   return  $total['markersTotal'];

	}

	function totalMarkersID($iduser){

		$total = Marker::totalMarkerID($iduser);
	

	   return  $total['markersTotalID'];

	}


	function totalMarkerPendings(){

		$total = Marker::totalMarkersPendings();

	   return  $total['markersPendings'];

	}

	function totalMarkerProgress(){

		$total = Marker::totalMarkersProgress();

	   return  $total['markersProgress'];

	}

	function totalMarkerFinished(){

		$total = Marker::totalMarkersFinished();

	   return  $total['markersFinished'];
	}

	

	function numPhotos($idmarker){

		$total = Marker::numPhotos($idmarker);

	   	return  $total['photos'];

	}

	function namePhotos($idmarker){

		$total = Marker::namePhotos($idmarker);

	   	return  $total['name'];
	}


	

?>