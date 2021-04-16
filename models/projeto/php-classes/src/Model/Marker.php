<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

//Classe marker(marcações, com seus métodos específicos)
class Marker extends Model {

	//Método estático com a query que seleciona  todos dados da tabela tb_markers e tb_users relacionada pela coluna de idusers em ordem decrescente

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN  tb_markers b ON b.iduser = a.iduser  ORDER BY b.dtregister DESC");

	}

	
	
	//Método com a query que seleciona dados da tabela tb_markers e tb_users relacionada pela coluna de idusers em ordem decrescente, passando o iduser por parâmetro (marcações relacionado ao usuário)

	public function getMarkersID($iduser)
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_users a INNER JOIN tb_markers b ON a.iduser = b.iduser WHERE b.iduser = :iduser ORDER BY b.dtregister DESC
		", [	 

			':iduser'=>$iduser
		]);
	
	}


	//Método estático que verifica o array de dados
	public static function checkList($list)
	{

		foreach ($list as &$row) {
			
			$p = new Marker();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	

	public static function totalMarkerID($iduser)
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_markers WHERE iduser = :iduser",[
				':iduser'=>$iduser
				]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

	
		return ['markersTotalID'=>(int)$resultTotal[0]["nrtotal"]];
	}


	//Método estático para a verificação do total de fotos de cada marcação
	public static function numPhotos($idmarker)
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_markerphotos WHERE idmarker = :idmarker",[
			':idmarker'=>$idmarker
			]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['photos'=>(int)$resultTotal[0]["nrtotal"]];
	}

	public static function totalMarkers()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_locations");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

	
		return ['markersTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}


	//Método que busca os dados do procedimento e salva no tabela de marcações
	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_marker_save(:iduser,:locality, :observation,:type1,:type2,:type3,:type4)", array(
			":iduser"=>$this->getiduser(),
			":locality"=>$this->getlocality(),
			":observation"=>$this->getobservation(),
			":type1"=>$this->gettype1(),
			":type2"=>$this->gettype2(),
			":type3"=>$this->gettype3(),
			":type4"=>$this->gettype4(),
		));

		$this->setData($results[0]);

		marker::movePhotos();
		marker::saveLocation();

	}

	

	public function saveLocation()
	{


		$sql = new Sql();

		$results = $sql->select("CALL sp_locations_marker_add(:idmarker,:lng,:lat)", array(
			":idmarker"=>$this->getidmarker(),
			":lng"=>$this->getlng(),
			":lat"=>$this->getlat()	
		));	

		$this->setData($results[0]);

	}

	public static function listAllMarkers()
	{

		$sql = new Sql();

			return   $sql->select("SELECT * FROM tb_locations a INNER JOIN  tb_markers b ON b.idmarker = a.idmarker");	

	}

	public static function listMarkersID($idmarker)
	{

		$sql = new Sql();

			$results =  $sql->select("SELECT * FROM tb_locations a INNER JOIN  tb_markers b ON b.idmarker = a.idmarker WHERE b.idmarker = :idmarker",[
					':idmarker'=>$idmarker
			]);	

		return  [
				'valueLat'=>(float)$results[0]["lat"],
				'valueLng'=>(float)$results[0]["lng"],
				'valueLocality'=>$results[0]["locality"],
				'valueObservation'=>$results[0]["observation"],
			   ];

	}


	//Método que seleciona todas marcações passando a ID por parâmetro
	public function get($idmarker)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_markers WHERE idmarker = :idmarker", [
			':idmarker'=>$idmarker
		]);

		$this->setData($results[0]);

		return ['value'=>(int)$results[0]["idmarker"]];

	}

	//Método que seleciona todas marcações passando a ID por parâmetro e verificando o valor da situação de cada marcação
	public function valueSituation($idmarker)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_markers WHERE idmarker = :idmarker", [
			':idmarker'=>$idmarker
		]);

		$this->setData($results[0]);

		return ['value'=>(int)$results[0]["situation"]];

	}

	public static function namePhotos($idmarker)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_markerphotos WHERE idmarker = :idmarker", [
			':idmarker'=>$idmarker
		]);

		return ['name'=>$results[0]["namephoto"]];

	}

	
	
	//Método para deletar um marcação
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_markers WHERE idmarker = :idmarker", [
			':idmarker'=>$this->getidmarker()
		]);


		 /*$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"ft_marker" . DIRECTORY_SEPARATOR . 
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
						"ft_marker" . DIRECTORY_SEPARATOR . 
						
						 $file['name'][$cont];

						$namePhoto = $file['name'][$cont];

					
			   
					    $sql = new Sql();
					    $sql->select("CALL sp_image_marker_add(:idmarker,:namephoto)", array(
							":idmarker"=>$this->getidmarker(),
							
							":namephoto"=>$namePhoto ));
		      
					    move_uploaded_file($file['tmp_name'][$cont], $directory);

			      }
			
		
	}

	//Método para listar as imagens referentes a cada marcação
	public function showPhotos($idmarker)
	{
	     $sql = new Sql();
	    
	    
	     $resultsExistPhoto = $sql->select("SELECT * FROM tb_markerphotos WHERE idmarker = :idmarker ", [
	         ':idmarker'=>$idmarker
	     ]);

	     $countResultsPhoto = count($resultsExistPhoto);
	     if ($countResultsPhoto > 0)
	     {
	         foreach ($resultsExistPhoto as &$result)
	         {
	             foreach ($result as $key => $value) {
	                 if ($key === "namephoto") {
	                     $result["desphoto"] = '/res/ft_marker/'. $result['namephoto'];
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

	     $results  = $sql->select("SELECT * FROM tb_markerphotos WHERE idphoto = :idphoto", [
			':idphoto'=>$idphoto	
		]);	

	}

	//Método para deletar fotos
	public function deletePhoto($idphoto)
	{

		$sql = new Sql();

	 	 $sql->query("DELETE FROM tb_markerphotos WHERE idphoto = :idphoto", [
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
			FROM  tb_markers ORDER BY dtregister DESC
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
			FROM tb_markers 
			WHERE idmarker LIKE :search  OR locality LIKE :search OR observation LIKE :search OR type1 LIKE :search
			OR type2 LIKE :search OR type3 LIKE :search OR type4 LIKE :search
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
