<?php 

namespace Projeto\Model;


use \Projeto\Model;
use \Projeto\DB\Sql;

//Classe User(Usuários, com seus métodos específicos)
class User extends Model {

	const SESSION = "User";
	const ERROR = "UserError";
	const ERROR_REGISTER = "UserErrorRegister";
	const SUCCESS = "UserSucesss";

	


	//Método estático para verificação e validação do usuário comum e do administrador
	public static function login($login, $password)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users  WHERE login = :login", array(
			":login"=>$login
		)); 

		if (count($results) === 0) {
			throw new \Exception("Falha na sua tentativa de login.Conta não cadastrada");
		}


		$data = $results[0];


		if (password_verify($password, $data['despassword']) === true) {

			$user = new User();

			$data['person'] = utf8_encode($data['person']);

			$user->setData($data);


			$_SESSION[User::SESSION] = $user->getValues();

			return $user;

		} else {

			throw new \Exception("Falha na sua tentativa de login. Senha inválida");



		}

	}

	//Método estático para verificar se o email do usuário já existe
	public static function checkEmailExist($email)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE email = :email", [
			':email'=>$email
		]);

		return (count($results) > 0);

	}

	//Método estático para verificar se o login do usuário já existe
	public static function checkLoginExist($login)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE login = :login", [
			':login'=>$login
		]);

		return (count($results) > 0);

	}

	
 	//Método estático para encerrar a sessão do usuário (logout)
	public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;

	}

	//Método estático para criptografar as senhas registradas dos usuários
	public static function getPasswordHash($password)
	{

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

	}

	//Método estático para pegar a sessão dos usuários
	public static function getFromSession()
	{

		$user = new User();

		if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]['iduser'] > 0) {

			$user->setData($_SESSION[User::SESSION]);

		}

		return $user;

	}

	//Método estático para verificar a autenticidade do usuário comun, e verificar se ele esta com a sessão iniciada ou não.
	public static function verifyLogin($inadmin = true)
	{

		if (	
			(bool)$_SESSION[User::SESSION]["iduser"] !== $inadmin
			||
			(int)$_SESSION[User::SESSION]["inadmin"] !== 0
		) {
			
			header("Location: /");
			exit;

		}

	}

	//Método estático para verificar a autenticidade do usuário Administrador, e verificar se ele esta com a sessão iniciada ou não.
	public static function verifyLoginAdmin($inadmin = true)
	{

		if (
			
			(bool)$_SESSION[User::SESSION]["iduser"] !== $inadmin
			||
			(int)$_SESSION[User::SESSION]["inadmin"] !== 1
		) {
			
			header("Location: /admin/login");
			exit;

		}

	}

	
	//Método para selecionar todos os usuários e passar a ID como parâmetro
	public function get($iduser)
	{
	 
		 $sql = new Sql();
		 
		 $results = $sql->select("SELECT * FROM tb_users  WHERE iduser = :iduser", array(
		 ":iduser"=>$iduser
		 ));

		 
		 $this->setData($results[0]);
	 
	 }

	 //Método para salvar os dados do procedimento de registro do usuário comum.
	public function save()
	{

		$sql  = new Sql();

		$results = $sql->select("CALL sp_users_save(:person,:login,:despassword, :email, :phone,:inadmin,:genre,:picture,:born_date,:city,:address)",array(
			":person"=>$this->getperson(),
			":login"=>$this->getlogin(),
			":despassword" => User::getPasswordHash($this->getdespassword()),
			":email"=>$this->getemail(),
			":phone"=>$this->getphone(),
			":inadmin"=>$this->getinadmin(),
			":genre"=>$this->getgenre(),
			":picture"=>$this->getpicture(),
			":born_date"=>$this->getborn_date(),
			":city"=>$this->getcity(),
			":address"=>$this->getaddress()	

		));

		$this->setData($results[0]);

	}

	 //Método para editar os dados do procedimento  do usuário comum.
	public function update()
	{

		$sql  = new Sql();

		$results = $sql->select("CALL sp_users_update(:iduser,:person,:genre,:phone,:born_date,:city,:address)",array(
			":iduser"=>$this->getiduser(),
			":person"=>$this->getperson(),
			":genre"=>$this->getgenre(),
			":phone"=>$this->getphone(),
			":born_date"=>$this->getborn_date(),
			":city"=>$this->getcity(),
			":address"=>$this->getaddress()	
		));

		$this->setData($results[0]);

	}

	//Método para editar a imagem do perfil
	public function updateImage()
    {
        $sql = new Sql();
 
        $results = $sql->select('CALL sp_update_image(:iduser,:picture)', [
            ":iduser" => $this->getiduser(),
            ":picture"=>User::getImage($this->getpicture())
           ,
        ]);

        if($this->getpicture() != 0)
        {

	        $img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"ft_perfil" . DIRECTORY_SEPARATOR . 
				$this->getpicture();
				unlink($img);

		}
		else
		{
			$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"ft_perfil" . DIRECTORY_SEPARATOR . 
			     $this->getpicture();
			     $img;

				
		}

    }
	
	//Método estático para nomear e mover a imagem para a pasta de destino 
    public static function getImage($value)
	{
		$name_file = date('Ymdhms');

		$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"ft_perfil" . DIRECTORY_SEPARATOR .
			$name_file;	
			     			
			$picture = isset($_FILES['picture']) ? $_FILES['picture'] : FALSE;
			
				if (!$picture['error']){
					
					 move_uploaded_file($picture['tmp_name'],$directory);

					return $name_file;

				} else {

					return 0;

				}
	}
	//Método para deletar os usuários
	public function delete()
	{

		$sql = new Sql();

		$sql->query("DELETE FROM tb_users WHERE iduser = :iduser", [
			':iduser'=>$this->getiduser()
		]);

			if($this->getinadmin() == 1 && $this->getpicture() != 0){

				$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
					"res" . DIRECTORY_SEPARATOR . 
					"ft_perfil" . DIRECTORY_SEPARATOR . 
					$this->getpicture();
					unlink($img);
			}
			else{

				$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
					"res" . DIRECTORY_SEPARATOR . 
					"ft_perfil" . DIRECTORY_SEPARATOR . 
					$this->getpicture();

			}

	}

    //Método estático para listar todos os usuários
	public static function listAll()
	{

		$sql = new Sql();
		
		return  $sql->select("SELECT * FROM tb_users  ORDER BY dtregister desc ");
		 

	}

	//Método estático para verificar o total de usuários registrados
	public static function total()
	{
		
		$sql = new Sql();
		$total = $sql->select("SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_users");
		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");
	  
		return ['usersTotal'=>(int)$resultTotal[0]["nrtotal"]];
	}	

	


	//Método estático que seta a mensagem de erro
	public static function setError($msg)
	{

		$_SESSION[User::ERROR] = $msg;

	}

	//Método estático que pega a mensagem de erro
	public static function getError()
	{

		$msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';

		User::clearError();

		return $msg;

	}

	//Método estático que limpa a mensagem de erro
	public static function clearError()
	{

		$_SESSION[User::ERROR] = NULL;

	}
	//Método estático que seta a mensagem de sucesso
	public static function setSuccess($msg)
	{

		$_SESSION[User::SUCCESS] = $msg;

	}

	//Método estático que seta a mensagem de sucesso
	public static function getSuccess()
	{

		$msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';

		User::clearSuccess();

		return $msg;

	}
	//Método estático que limpa a mensagem de sucesso
	public static function clearSuccess()
	{

		$_SESSION[User::SUCCESS] = NULL;

	}

	public static function setErrorRegister($msg)
	{

		$_SESSION[User::ERROR_REGISTER] = $msg;

	}

	public static function getErrorRegister()
	{

		$msg = (isset($_SESSION[User::ERROR_REGISTER]) && $_SESSION[User::ERROR_REGISTER]) ? $_SESSION[User::ERROR_REGISTER] : '';

		User::clearErrorRegister();

		return $msg;

	}

	public static function clearErrorRegister()
	{

		$_SESSION[User::ERROR_REGISTER] = NULL;

	}

	//PAGINAÇÃO DA PÁGINA de USUÁRIOS
	public  static function getPage($page = 1, $itemsPerPage = 5)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM  tb_users ORDER BY dtregister DESC
			LIMIT $start, $itemsPerPage");

		$resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

		return [
			'data'=>$results,
			'total'=>(int)$resultTotal[0]["nrtotal"],
			'pages'=>ceil($resultTotal[0]["nrtotal"] / $itemsPerPage)
		];

	}


	//BUSCA DA PÁGINA DE USUÁRIOS

	public static function getPageSearch($search, $page = 1, $itemsPerPage = 5)
	{

		$start = ($page - 1) * $itemsPerPage;

		$sql = new Sql();

		$results = $sql->select("
			SELECT SQL_CALC_FOUND_ROWS *
			FROM tb_users 
			WHERE iduser LIKE :search OR person LIKE :search OR email LIKE :search OR phone LIKE :search
			OR born_date LIKE :search OR city LIKE :search OR address LIKE :search OR login LIKE :search 
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

 ?>