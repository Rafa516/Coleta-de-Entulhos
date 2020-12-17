<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

class Call extends Model {

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_calls ORDER BY dtregister desc");

	}

	public static function checkList($list)
	{

		foreach ($list as &$row) {
			
			$p = new Call();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	public function getCallsID($iduser)
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_calls WHERE iduser = :iduser ORDER BY iduser desc 
		", [

			':iduser'=>$iduser
		]);

	
	}

	public static function total()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_calls");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['callsTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}


	public function save()
	{


		$sql = new Sql();

		$results = $sql->select("CALL sp_call_save(:iduser, :locality, :observation, :situation)", array(
			":iduser"=>$this->getiduser(),
			":locality"=>$this->getlocality(),
			":observation"=>$this->getobservation(),
			":situation"=>$this->getsituation()
		));

		$this->setData($results[0]);

		Call::movePhotos();

	}


	public function get($idcall)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_calls WHERE idcall = :idcall", [
			':idcall'=>$idcall
		]);

		$this->setData($results[0]);

	}

	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_calls WHERE idcall = :idcall", [
			':idcall'=>$this->getidcall()
		]);

		/*$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"site" . DIRECTORY_SEPARATOR . 
			"img" . DIRECTORY_SEPARATOR . 
			"products" . DIRECTORY_SEPARATOR . 
			$name;
			unlink($img);*/

	}

	
	public static function totalPhotos($idcall)
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_callphotos WHERE idcall = :idcall", [
	         ':idcall'=>$idcall
	     ]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['totalPhotos'=>(int)$resultTotal[0]["nrtotal"]];
	}



	public function getValues()
	{
		

		$values = parent::getValues();

		return $values;

	}


	public function movePhotos()
	{
		 				
			$file = isset($_FILES['namephoto']) ? $_FILES['namephoto'] : FALSE;

		

			    //loop para ler as imagens
			    for ($cont = 0; $cont < count($file['name']); $cont++){ 


					$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
						"res" . DIRECTORY_SEPARATOR . 
						"ft_call" . DIRECTORY_SEPARATOR . 
						
						 $file['name'][$cont];

						$namePhoto = $file['name'][$cont];

					
			   
					    $sql = new Sql();
					    $sql->select("CALL sp_image_call_add(:idcall,:iduser, :namephoto)", array(
							":idcall"=>$this->getidcall(),
							":iduser"=>$this->getiduser(),
							":namephoto"=>$namePhoto ));
		      
					    move_uploaded_file($file['tmp_name'][$cont], $directory);

			      }
			
		
	}

	public function showPhotos($idcall)
	{
	     $sql = new Sql();
	    
	    
	     $resultsExistPhoto = $sql->select("SELECT * FROM tb_callphotos WHERE idcall = :idcall ", [
	         ':idcall'=>$idcall
	     ]);

	     $countResultsPhoto = count($resultsExistPhoto);
	     if ($countResultsPhoto > 0)
	     {
	         foreach ($resultsExistPhoto as &$result)
	         {
	             foreach ($result as $key => $value) {
	                 if ($key === "namephoto") {
	                     $result["desphoto"] = '/res/ft_call/'. $result['namephoto'];
	                 }
	             }
	         } 
	     
	     return $resultsExistPhoto;
	 	 }
	}

	public   function getPhotos($idphoto)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_callphotos WHERE idphoto = :idphoto", [
			':idphoto'=>$idphoto	
		]);	

	}

	public function deletePhoto($idphoto)
	{

		$sql = new Sql();

	 	 $sql->query("DELETE FROM tb_callphotosWHERE idphoto = :idphoto", [
			':idphoto'=>$idphoto
		]);

	}

	


}
