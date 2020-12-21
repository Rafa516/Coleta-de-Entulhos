<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

class Call extends Model {

	//Função com a query que seleciona  todos dados da tabela tb_calls e tb_users relacionada pela coluna de idusers em ordem decrescente

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN  tb_calls b ON b.iduser = a.iduser  ORDER BY b.dtregister DESC");

	}

	//Função para selecionar somente os chamados pendentes
	public static function listCallPendigs()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN  tb_calls b ON b.iduser = a.iduser WHERE situation = 1 ORDER BY a.dtregister DESC");

	}

	//Função para selecionar somente os chamados em andamento
	public static function listCallProgress()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN  tb_calls b ON b.iduser = a.iduser WHERE situation = 2 ORDER BY a.dtregister DESC");

	}

	//Função para selecionar somente os chamados finalizados
	public static function listCallFinished()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN  tb_calls b ON b.iduser = a.iduser WHERE situation = 3 ORDER BY a.dtregister DESC");

	}
	
	//Função com a query que seleciona dados da tabela tb_calls e tb_users relacionada pela coluna de idusers em ordem decrescente, passando o iduser por parâmetro.

	public function getCallsID($iduser)
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_calls a INNER JOIN tb_users b ON a.iduser = b.iduser WHERE b.iduser = :iduser ORDER BY a.dtregister DESC
		", [	 

			':iduser'=>$iduser
		]);

	
	}


	//Função que verifica o array de dados
	public static function checkList($list)
	{

		foreach ($list as &$row) {
			
			$p = new Call();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	public static function total()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_calls");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");


		return ['callsTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}

	public static function totalCallsPendings()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_calls WHERE situation = 1");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['callsPendings'=>(int)$resultTotal[0]["nrtotal"]];
	}

	public static function totalCallsProgress()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_calls WHERE situation = 2");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['callsProgress'=>(int)$resultTotal[0]["nrtotal"]];
	}

	public static function totalCallsFinished()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_calls WHERE situation = 3");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['callsFinished'=>(int)$resultTotal[0]["nrtotal"]];
	}




	//função que busca os dados do procedimento e salva no tabela de chamados
	public function save()
	{


		$sql = new Sql();

		$results = $sql->select("CALL sp_call_save(:iduser,:locality, :observation,:priority, :situation)", array(
			":iduser"=>$this->getiduser(),
			":locality"=>$this->getlocality(),
			":observation"=>$this->getobservation(),
			":priority"=>$this->getpriority(),
			":situation"=>$this->getsituation()
		));

		$this->setData($results[0]);

		Call::movePhotos();

	}

	public function updateSituation()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_update_situation(:idcall,:situation)", [
			':idcall'=>$this->getidcall(),
			':situation'=>$this->getsituation()	
		]);

		$this->setData($results[0]);	

	}


	public function get($idcall)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_calls WHERE idcall = :idcall", [
			':idcall'=>$idcall
		]);

		$this->setData($results[0]);

		return ['value'=>(int)$results[0]["idcall"]];

	}

	public function valueSituation($idcall)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_calls WHERE idcall = :idcall", [
			':idcall'=>$idcall
		]);

		$this->setData($results[0]);

		return ['value'=>(int)$results[0]["situation"]];

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

	 	 $sql->query("DELETE FROM tb_callphotos WHERE idphoto = :idphoto", [
			':idphoto'=>$idphoto
		]);

	}

	

	


}
