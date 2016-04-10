<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url;

class Auth extends Controller {

	private $_model;
	public function __construct()	
	{
		$this->_model = new \App\Models\User();
	}

	public function login()
	{
		if(isset($_POST['submit']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];


			if($username == '' || $password == '')
			{
				if($username == '')
					$error[] = 'Nazwa użytkownika jest wymagana';
				else
					$error[] = 'Hasło jest wymagane';		
			}
			else if(Password::verify($password, $this->_model->getHash($username)) == false){
				$error[] = "Złe hasło lub nazwa użytkownika";
			}
			if(!$error)
			{
				Session::set('loggedin',true);
				Session::set('userID', $this->_model->getID($username));
			}
		}

		Menu::renderHeaderWithMenu();
		View::render('auth/login',$data, $error);
		View::rendertemplate('footer',$data);
	}
	public function logout()
	{
		Session::destroy();
		Url::redirect();
	}
}