<?php 

namespace Projeto;

class Model {

	private $values = [];

	public function setData($data)
	{

		foreach ($data as $key => $value)
		{

		$this->{"set".$key}($value); //variável de forma dinâmica entre chaves

		}

	}

	public function __call($name, $args)
	{
		//verificando o valor dos 3 primeiros campos para GET ou SET
		$method = substr($name, 0, 3);
		$fieldName = substr($name, 3, strlen($name));

		
			
			switch ($method)
			{

				case "get":
					return (isset($this->values[$fieldName])) ?  $this->values[$fieldName]: NULL;
				break;

				case "set":
					return $this->values[$fieldName] = $args[0];
				break;
			}

	}

	public function getValues()
	{

		return $this->values;

	}

}

 ?>
