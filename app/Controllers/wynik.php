<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url,
	\helpers\database;

class wynik extends Controller {

	private $_model;
	public function __construct()	
	{
		$this->_model = new \App\Models\result();
	}

	public function wynik()
	{
		$_resultModel = new \App\Models\result();
		
		if (session::get('loggedin')==true) {
			Menu::renderHeaderWithMenu();
			wynik::renderwynik();
		}else{
			Menu::renderHeaderWithMenu('zaloguj sie');
		}

		View::rendertemplate('footer',$data);
	}

	public function renderwynik()
	{
		$_userModel = new \App\Models\User();
		$_resultModel = new \App\Models\result();
		$data['rola']=$_userModel->getRole(Session::get('userID'));
		if ($data['rola']==4) {
			$data['wyniki']=$_resultModel->getwynikiall();
		}else{$data['wyniki']=$_resultModel->getwyniki(Session::get('userID'));}
			
		if($data['wyniki']==NULL){echo "<h2 class=\"text-center\">Brak danych</h2>";}
		else{View::render('result/wynik', $data);}
		
	}


	public function wynikGraf()
	{
		$_resultModel = new \App\Models\result();
		
		if (session::get('loggedin')==true) {
			Menu::renderHeaderWithMenu();
			wynik::renderwynikGraf();
		}else{
			Menu::renderHeaderWithMenu('zaloguj sie');
		}

		View::rendertemplate('footer',$data);
	}

	public function renderwynikGraf()
	{
		$_userModel = new \App\Models\User();
		$_resultModel = new \App\Models\result();
		$data['rola']=$_userModel->getRole(Session::get('userID'));
		$data['wyniki']=$_resultModel->getwyniki(Session::get('userID'));
		
		if($data['wyniki']==NULL){echo "<h2 class=\"text-center\">Brak danych</h2>";}
		else{View::render('result/wynikGraf', $data);}
	}

}
