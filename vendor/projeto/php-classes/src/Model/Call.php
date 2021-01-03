<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

//Classe Call(Chamados, com seus métodos específicos)
class Call extends Model {

	//Método estático com a query que seleciona  todos dados da tabela tb_calls e tb_users relacionada pela coluna de idusers em ordem decrescente

	public static function listAll()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN  tb_calls b ON b.iduser = a.iduser  ORDER BY b.dtregister DESC");

	}

	//Método estático para selecionar somente os chamados pendentes
	public static function listCallPendigs()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN  tb_calls b ON b.iduser = a.iduser WHERE situation = 1 ORDER BY b.dtregister DESC");

	}

	//Método estático para selecionar somente os chamados em andamento
	public static function listCallProgress()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN  tb_calls b ON b.iduser = a.iduser WHERE situation = 2 ORDER BY b.dtregister DESC");

	}

	//Método estático para selecionar somente os chamados finalizados
	public static function listCallFinished()
	{

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN  tb_calls b ON b.iduser = a.iduser WHERE situation = 3 ORDER BY b.dtregister DESC");

	}
	
	//Método com a query que seleciona dados da tabela tb_calls e tb_users relacionada pela coluna de idusers em ordem decrescente, passando o iduser por parâmetro (Chamados relacionado ao usuário)

	public function getCallsID($iduser)
	{

		$sql = new Sql();

		return $sql->select("
			SELECT * FROM tb_users a INNER JOIN tb_calls b ON a.iduser = b.iduser WHERE b.iduser = :iduser ORDER BY b.dtregister DESC
		", [	 

			':iduser'=>$iduser
		]);

	
	}


	//Método estático que verifica o array de dados
	public static function checkList($list)
	{

		foreach ($list as &$row) {
			
			$p = new Call();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	//Método estático que verifica o total de chamados registrados
	public static function total()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_calls");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");


		return ['callsTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}

	//Método estático que verifica o total de chamados pedentes registrados
	public static function totalCallsPendings()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_calls WHERE situation = 1");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['callsPendings'=>(int)$resultTotal[0]["nrtotal"]];
	}

	//Método estático que verifica o total de chamados em andamento registrados
	public static function totalCallsProgress()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_calls WHERE situation = 2");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['callsProgress'=>(int)$resultTotal[0]["nrtotal"]];
	}

	//Método estático que verifica o total de chamados finalizados  registrados
	public static function totalCallsFinished()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_calls WHERE situation = 3");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['callsFinished'=>(int)$resultTotal[0]["nrtotal"]];
	}

	//Método estático para a verificação do total de fotos de cada chamado
	public static function numPhotos($idcall)
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_callphotos WHERE idcall = :idcall",[
			':idcall'=>$idcall]);
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['photos'=>(int)$resultTotal[0]["nrtotal"]];
	}


	//Método que busca os dados do procedimento e salva no tabela de chamados
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
		Call::saveLocation();

	}

	//Método para atualizar a situação dos chamados
	public function updateSituation()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_update_situation(:idcall,:situation)", [
			':idcall'=>$this->getidcall(),
			':situation'=>$this->getsituation()	
		]);

		$this->setData($results[0]);	

	}

	public function saveLocation()
	{


		$sql = new Sql();

		$results = $sql->select("CALL sp_locations_call_add(:idcall,:lng,:lat)", array(
			":idcall"=>$this->getidcall(),
			":lng"=>$this->getlng(),
			":lat"=>$this->getlat()	
		));	

		$this->setData($results[0]);

	}

	public function latitude($idcall)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_locations WHERE idcall = :idcall", [
			':idcall'=>$idcall
		]);

		$this->setData($results[0]);

		return ['value'=>(float)$results[0]["lat"]];

	}

	public function longitude($idcall)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_locations WHERE idcall = :idcall", [
			':idcall'=>$idcall
		]);

		$this->setData($results[0]);


		return ['value'=>(float)$results[0]["lng"]];

	}

	public function locality($idcall)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_calls WHERE idcall = :idcall", [
			':idcall'=>$idcall
		]);

		$this->setData($results[0]);


		return ['value'=>$results[0]["locality"]];
	}

	public function observation($idcall)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_calls WHERE idcall = :idcall", [
			':idcall'=>$idcall
		]);

		$this->setData($results[0]);


		return ['value'=>$results[0]["observation"]];
	}

	

	//Método que seleciona todos chamados passando a ID por parâmetro
	public function get($idcall)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_calls WHERE idcall = :idcall", [
			':idcall'=>$idcall
		]);

		$this->setData($results[0]);

		return ['value'=>(int)$results[0]["idcall"]];

	}

	//Método que seleciona todos chamados passando a ID por parâmetro e verificando o valor da situação de cada chamado
	public function valueSituation($idcall)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_calls WHERE idcall = :idcall", [
			':idcall'=>$idcall
		]);

		$this->setData($results[0]);

		return ['value'=>(int)$results[0]["situation"]];

	}

	public static function namePhotos($idcall)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_callphotos WHERE idcall = :idcall", [
			':idcall'=>$idcall
		]);

		return ['name'=>$results[0]["namephoto"]];

	}

	
	
	//Método para deletar um chamado
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_calls WHERE idcall = :idcall", [
			':idcall'=>$this->getidcall()
		]);


		 /*$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"ft_call" . DIRECTORY_SEPARATOR . 
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

	//Método para listar as imagens referentes a cada chamado
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
	
	//Método para listar todos as fotos de cada chamado e passar pro parâmetro a ID
	public  function getPhotos($idphoto)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_callphotos WHERE idphoto = :idphoto", [
			':idphoto'=>$idphoto	
		]);	

	}

	//Método para deletar fotos
	public function deletePhoto($idphoto)
	{

		$sql = new Sql();

	 	 $sql->query("DELETE FROM tb_callphotos WHERE idphoto = :idphoto", [
			':idphoto'=>$idphoto
		]);

	}

	

	


}
