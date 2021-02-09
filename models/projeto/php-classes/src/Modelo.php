<?php 

namespace Projeto;

//Classe Model(Modelo com os principais métodos)
class Modelo {

	private $valores = [];

	//Método para setar os dados das váriaveis de forma dinâmica
	public function setDados($dados)
	{

		foreach ($dados as $key => $valor)
		{

		$this->{"set".$key}($valor); //variável de forma dinâmica entre chaves

		}

	}

	//Método Construtor para  passar por parâmetros Get e Set das variáveis dinâmicamente
	public function __call($nome, $argumentos)
	{
		//verificando o valor dos 3 primeiros campos para GET ou SET
		$metodo = substr($nome, 0, 3);
		$campodNome = substr($nome, 3, strlen($nome));

		
			
			switch ($method)
			{

				case "get":
					return (isset($this->valores[$campodNome])) ?  $this->valores[$campodNome]: NULL;
				break;

				case "set":
					return $this->valores[$campodNome] = $argumentos[0];
				break;
			}

	}

	//Método para pegar os valores das váriaveis
	public function getValores()
	{

		return $this->valores;

	}

}

?>
