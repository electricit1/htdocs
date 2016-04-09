<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url;

class Auth extends Controller {

	public function login()
	{
		//echo 'coc';
		if(isset($_POST['submit']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];

			echo "nazwa uzytkownika: ".$username;
			echo "haslo: ".$password;
		}

		View::rendertemplate('header',$data);
		View::render('auth/login',$data);
		View::rendertemplate('footer',$data);
	}
}