<?php 

namespace Projeto\Model;

use Exception;
use \Projeto\Model;
use \Projeto\DB\Sql;
use \Projeto\Mailer;

class User extends Model {

	const SESSION = "User";
	const ERROR = "UserError";
	const ERROR_REGISTER = "UserErrorRegister";
	const SUCCESS = "UserSucesss";

	


	public static function getFromSession()
	{

		$user = new User();

		if (isset($_SESSION[User::SESSION]) && (int)$_SESSION[User::SESSION]['iduser'] > 0) {

			$user->setData($_SESSION[User::SESSION]);

		}

		return $user;

	}

	public static function checkLogin($inadmin = true)
	{

			if ($inadmin === true && (bool)$_SESSION[User::SESSION]['inadmin'] === true) {

				return true;

			} else if ($inadmin === false) {

				return true;

			} else {

				return false;

			}

	}

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

	public static function getPasswordHash($password)
	{

		return password_hash($password, PASSWORD_DEFAULT, [
			'cost'=>12
		]);

	}

	public static function verifyLogin($inadmin = true)
	{

		if (
			!isset($_SESSION[User::SESSION])
			|| 
			!$_SESSION[User::SESSION]
			||
			!(int)$_SESSION[User::SESSION]["iduser"] > 0
			||
			(bool)$_SESSION[User::SESSION]["iduser"] !== $inadmin
		) {
			
			header("Location: /");
			exit;

		}

	}

	public static function verifyLoginAdmin($inadmin = true)
	{

		if (
			!isset($_SESSION[User::SESSION])
			|| 
			!$_SESSION[User::SESSION]
			||
			!(int)$_SESSION[User::SESSION]["iduser"] > 0
			||
			(bool)$_SESSION[User::SESSION]["iduser"] !== $inadmin
		) {
			
			header("Location: /admin/login");
			exit;

		}

	}

	public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;

	}

	public function get($iduser)
	{
	 
		 $sql = new Sql();
		 
		 $results = $sql->select("SELECT * FROM tb_users  WHERE iduser = :iduser", array(
		 ":iduser"=>$iduser
		 ));

		 
		 $this->setData($results[0]);
	 
	 }


	public function save()
	{

		$sql  = new Sql();

		$results = $sql->select("CALL sp_users_save(:person,:login,:despassword, :email, :phone,:inadmin,:picture,:born_date,:city,:address)",array(
			":person"=>$this->getperson(),
			":login"=>$this->getlogin(),
			":despassword" => User::getPasswordHash($this->getdespassword()),
			":email"=>$this->getemail(),
			":phone"=>$this->getphone(),
			":inadmin"=>$this->getinadmin(),
			":picture"=>$this->getpicture(),
			":born_date"=>$this->getborn_date(),
			":city"=>$this->getcity(),
			":address"=>$this->getaddress()	

		));

		$this->setData($results[0]);

	}

	public function update()
	{

		$sql  = new Sql();

		$results = $sql->select("CALL sp_users_update(:iduser,:person,:phone,:born_date,:city,:address)",array(
			":iduser"=>$this->getiduser(),
			":person"=>$this->getperson(),
			":phone"=>$this->getphone(),
			":born_date"=>$this->getborn_date(),
			":city"=>$this->getcity(),
			":address"=>$this->getaddress()
			
		
			
		));

		$this->setData($results[0]);

	}


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
				"user" . DIRECTORY_SEPARATOR . 
				"ft_perfil" . DIRECTORY_SEPARATOR . 
				$this->getpicture();
				unlink($img);

		}
		else
		{
			$img = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
				"res" . DIRECTORY_SEPARATOR . 
				"user" . DIRECTORY_SEPARATOR . 
				"ft_perfil" . DIRECTORY_SEPARATOR . 
			     $this->getpicture();
			     $img;

				
		}

    }

    public static function getImage($value)
	{
		$name_file = date('Ymdhms');

		$directory = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 
			"res" . DIRECTORY_SEPARATOR . 
			"user" . DIRECTORY_SEPARATOR . 
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

	
	public static function setError($msg)
	{

		$_SESSION[User::ERROR] = $msg;

	}

	public static function getError()
	{

		$msg = (isset($_SESSION[User::ERROR]) && $_SESSION[User::ERROR]) ? $_SESSION[User::ERROR] : '';

		User::clearError();

		return $msg;

	}

	public static function clearError()
	{

		$_SESSION[User::ERROR] = NULL;

	}

	public static function setSuccess($msg)
	{

		$_SESSION[User::SUCCESS] = $msg;

	}

	public static function getSuccess()
	{

		$msg = (isset($_SESSION[User::SUCCESS]) && $_SESSION[User::SUCCESS]) ? $_SESSION[User::SUCCESS] : '';

		User::clearSuccess();

		return $msg;

	}

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

	

	public static function checkEmailExist($email)
	{

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE email = :email", [
			':email'=>$email
		]);

		return (count($results) > 0);

	}

	
}

 ?>