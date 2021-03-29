<?php 

namespace Projeto\Model;

use \Projeto\DB\Sql;
use \Projeto\Model;

//Classe Call(Chamados, com seus métodos específicos)
class Information extends Model {


	//Método estático que verifica o array de dados
	public static function checkList($list)
	{

		foreach ($list as & $row) {
			
			$p = new Information();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}

	//Método estático que verifica o total de informações registrados
	public static function totalinformations()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_informations");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

	
		return ['informationsTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}

	

	//Método que busca os dados do procedimento e salva no tabela de informações
	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_informations_save(:idinf,:person,:title,:informations)", array(
			":idinf"=>$this->getidinf(),
			":person"=>$this->getperson(),
			":title"=>$this->gettitle(),
			":informations"=>$this->getinformations()
		));

		$this->setData($results[0]);;

	}

	public function update()
    {
        $sql = new Sql();
 
        $results = $sql->select('CALL sp_informations_update(:idinf,:title,:informations)', [
            ":idinf" => $this->getidinf(),
            ":title" => $this->gettitle(),
            ":informations" => $this->getinformations()
            ]);
    }

	

	
	//Método que seleciona todas informações passando a ID por parâmetro
	public function get($idinf)
	{

		$sql = new Sql();

	     $results  = $sql->select("SELECT * FROM tb_informations WHERE idinf = :idinf", [
			':idinf'=>$idinf
		]);

		$this->setData($results[0]);

		return ['value'=>$results[0]["idinf"]];

	}

	
	
	//Método para deletar uma informação
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_informations WHERE idinf = :idinf", [
			':idinf'=>$this->getidinf()
		]);


	}


	//Método para pegar os valores do array
	public function getValues()
	{
		

		$values = parent::getValues();

		return $values;

	}

	
	

	public  static function getPage($page = 1, $itemsPerPage = 2)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_informations ORDER BY dtregister DESC
			LIMIT $start, $itemsPerPage");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		
		

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}



	public static function getPageSearch($search, $page = 1, $itemsPerPage = 2)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_informations
			WHERE idinf LIKE :search  OR title LIKE :search OR informations LIKE :search OR person LIKE :search 
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
