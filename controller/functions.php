<?php

use \Projeto\Model\User;
use \Projeto\Model\Marker;
use \Projeto\Model\Collect;
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

		$total = Marker::totalMarkers();
	

	   return  $total['markersTotal'];

	}

	function totalCollects(){

		$total = Collect::totalCollects();
	

	   return  $total['collectsTotal'];

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


	function numPhotosCollects($idcollect){

		$total = Collect::numPhotos($idcollect);

	   	return  $total['photos'];

	}

	function namePhotos($idmarker){

		$total = Marker::namePhotos($idmarker);

	   	return  $total['name'];
	}

	function namePhotosCollects($idcollect){

		$total = Collect::namePhotos($idcollect);

	   	return  $total['name'];
	}



	

?>