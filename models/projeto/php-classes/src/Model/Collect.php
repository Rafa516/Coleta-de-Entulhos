<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

//Classe collect(pontos de coletas, com seus métodos específicos)
class Collect extends Model {

	//Método estático com a query que seleciona  todos dados da tabela tb_collects e tb_users relacionada pela coluna de idusers em ordem decrescente

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN  tb_collects b ON b.iduser = a.iduser  ORDER BY b.dtregister DESC");

	}

	
	
	//Método com a query que seleciona dados da tabela tb_collects e tb_users relacionada pela coluna de idusers em ordem decrescente, passando o iduser por parâmetro (pontos de coletas relacionado ao usuário)

	public function getCollectsID($iduser)
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_users a INNER JOIN tb_collects b ON a.iduser = b.iduser WHERE b.iduser = :iduser ORDER BY b.dtregister DESC
		", [	 

			':iduser'=>$iduser
		]);
	
	}


	//Método estático que verifica o array de dados
	public static function checkList($list)
	{

		foreach ($list as &$row) {
			
			$p = new Collect();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}


	public static function totalCollectID($iduser)
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_collects WHERE iduser = :iduser",[
				':iduser'=>$iduser
				]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

	
		return ['collectsTotalID'=>(int)$resultTotal[0]["nrtotal"]];
	}


	//Método estático para a verificação do total de fotos de cada marcação
	public static function numPhotos($idcollect)
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_collectphotos WHERE idcollect = :idcollect",[
			':idcollect'=>$idcollect
			]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['photos'=>(int)$resultTotal[0]["nrtotal"]];
	}

	public static function totalCollects()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_locations_collects");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

	
		return ['collectsTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}


	//Método que busca os dados do procedimento e salva no tabela de pontos de coletas
	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_collect_save(:iduser,:locality,:phone,:email,:service,:informations)", array(
			":iduser"=>$this->getiduser(),
			":locality"=>$this->getlocality(),
			":phone"=>$this->getphone(),
			":email"=>$this->getemail(),
			":service"=>$this->getservice(),
			":informations"=>$this->getinformations(),
		
		));

		$this->setData($results[0]);

		Collect::movePhotos();
		Collect::saveLocation();

	}



	public function saveLocation()
	{


		$sql = new Sql();

		$results = $sql->select("CALL sp_locations_collect_add(:idcollect,:lng,:lat)", array(
			":idcollect"=>$this->getidcollect(),
			":lng"=>$this->getlng(),
			":lat"=>$this->getlat()	
		));	

		$this->setData($results[0]);

	}

	public static function serviceOne()
	{

		$sql = new Sql();

			return   $sql->select("SELECT * FROM tb_locations_collects a INNER JOIN  tb_collects b ON b.idcollect = a.idcollect
				WHERE service = 'Papa Entulho (GDF)'");	
 
	}

	public static function serviceTwo()
	{

		$sql = new Sql();

			return   $sql->select("SELECT * FROM tb_locations_collects a INNER JOIN  tb_collects b ON b.idcollect = a.idcollect
				WHERE service = 'Coleta de Vidros'");	
 
	}

	public static function serviceThree()
	{

		$sql = new Sql();

			return   $sql->select("SELECT * FROM tb_locations_collects a INNER JOIN  tb_collects b ON b.idcollect = a.idcollect
				WHERE service = 'Coleta de Eletrônicos'");	
 
	}

	public static function serviceFour()
	{

		$sql = new Sql();

			return   $sql->select("SELECT * FROM tb_locations_collects a INNER JOIN  tb_collects b ON b.idcollect = a.idcollect
				WHERE service = 'Coleta de Materiais Recicláveis'");	
 
	}

	public static function listCollectsID($idcollect)
	{

		$sql = new Sql();

			$results =  $sql->select("SELECT * FROM tb_locations_collects a INNER JOIN  tb_collects b ON b.idcollect = a.idcollect WHERE b.idcollect = :idcollect",[
					':idcollect'=>$idcollect
			]);	

		return  [
				'valueLat'=>(float)$results[0]["lat"],
				'valueLng'=>(float)$results[0]["lng"],
				'valueLocality'=>$results[0]["locality"],
				'valueService'=>$results[0]["service"],
				'valueInformations'=>$results[0]["informations"],
			   ];

	}

	public function listServices($idcollect)
	{

		$sql = new Sql();

			$results =  $sql->select("SELECT * FROM tb_collects WHERE idcollect = :idcollect",[
					':idcollect'=>$idcollect
			]);	

			$this->setData($results[0]);

		return  ['service'=>$results[0]["service"]];

	}


	//Método que seleciona todas pontos de coletas passando a ID por parâmetro
	public function get($idcollect)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_collects WHERE idcollect = :idcollect", [
			':idcollect'=>$idcollect
		]);

		$this->setData($results[0]);

		return ['value'=>(int)$results[0]["idcollect"]];

	}

	//Método que seleciona todas pontos de coletas passando a ID por parâmetro e verificando o valor da situação de cada marcação
	public function valueSituation($idcollect)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_collects WHERE idcollect = :idcollect", [
			':idcollect'=>$idcollect
		]);

		$this->setData($results[0]);

		return ['value'=>(int)$results[0]["situation"]];

	}

	public static function namePhotos($idcollect)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_collectphotos WHERE idcollect = :idcollect", [
			':idcollect'=>$idcollect
		]);

		return ['name'=>$results[0]["namephoto"]];

	}

	
	
	//Método para deletar um marcação
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_collects WHERE idcollect = :idcollect", [
			':idcollect'=>$this->getidcollect()
		]);


		 /*$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"ft_collect" . DIRECTORY_SEPARATOR . 
				$this->getnamephoto();
				unlink($img);*/

	}

	


	//Método para pegar os valores do array
	public function getValues()
	{
		

		$values = parent::getValues();

		return $values;

	}

	//Método para verificar e mover as fotos para  a pasta de destino e seu nome para o banco de dados
	public function movePhotos()
	{
		 				
			$file = isset($_FILES['namephoto']) ? $_FILES['namephoto'] : FALSE;

		

			    //loop para ler as imagens
			    for ($cont = 0; $cont < count($file['name']); $cont++){ 


					$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
						"res" . DIRECTORY_SEPARATOR . 
						"ft_collect" . DIRECTORY_SEPARATOR . 
						
						 $file['name'][$cont];

						$namePhoto = $file['name'][$cont];

					
			   
					    $sql = new Sql();
					    $sql->select("CALL sp_image_collect_add(:idcollect,:namephoto)", array(
							":idcollect"=>$this->getidcollect(),
							
							":namephoto"=>$namePhoto ));
		      
					    move_uploaded_file($file['tmp_name'][$cont], $directory);

			      }
			
		
	}

	//Método para listar as imagens referentes a cada marcação
	public function showPhotos($idcollect)
	{
	     $sql = new Sql();
	    
	    
	     $resultsExistPhoto = $sql->select("SELECT * FROM tb_collectphotos WHERE idcollect = :idcollect ", [
	         ':idcollect'=>$idcollect
	     ]);

	     $countResultsPhoto = count($resultsExistPhoto);
	     if ($countResultsPhoto > 0)
	     {
	         foreach ($resultsExistPhoto as &$result)
	         {
	             foreach ($result as $key => $value) {
	                 if ($key === "namephoto") {
	                     $result["desphoto"] = '/res/ft_collect/'. $result['namephoto'];
	                 }
	             }
	         } 

	    
	     
	     return $resultsExistPhoto;
	 	 }
	}
	
	//Método para listar todos as fotos de cada marcação e passar pro parâmetro a ID
	public  function getPhotos($idphoto)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_collectphotos WHERE idphoto = :idphoto", [
			':idphoto'=>$idphoto	
		]);	

	}

	//Método para deletar fotos
	public function deletePhoto($idphoto)
	{

		$sql = new Sql();

	 	 $sql->query("DELETE FROM tb_collectphotos WHERE idphoto = :idphoto", [
			':idphoto'=>$idphoto
		]);

	}

	//PAGINAÇÃO DA PÁGINA TABELAS COM LOCAIS
	public  static function getPage($page = 1, $itemsPerPage = 6)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_collects ORDER BY dtregister DESC
			LIMIT $start, $itemsPerPage");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


	//BUSCA DA PÁGINA TABELAS COM LOCAIS

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 6)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_collects 
			WHERE idcollect LIKE :search  OR locality LIKE :search OR informations LIKE :search OR email LIKE :search
			OR phone LIKE :search OR service LIKE :search
			
			ORDER BY dtregister DESC
			LIMIT $start, $itemsPerPage;
		", [
			':search'=>'%'.$search.'%'
		]);

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


}
