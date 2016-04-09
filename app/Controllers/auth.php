<?php namespace controllers;
use \core\view,
	\helpers\session,
	\helpers\password,
	\helpers\url;

class Auth extends \core\controller {

	public function login()
	{
		echo 'coc';
		$data['title'] = 'Logowanie';

		View::rendertemplate('header',$data);
		View::render('auth/login',$data);
		View::rendertemplate('footer',$data);
	}
}