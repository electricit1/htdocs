<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url,
	\helpers\database;

class uprawnienia extends Controller {

	private $_model;
	public function __construct()	
	{
		$this->_model = new \App\Models\rights();
	}

	public function uprawnienia()
	{
		$_userModel = new \App\Models\User();
		$_rightsModel = new \App\Models\rights();
		
		if ($_userModel->getRole(Session::get('userID'))==4 and Session::get('loggedin')){
			Menu::renderHeaderWithMenu();
			uprawnienia::renderuprawnienia();
		}else{
			Menu::renderHeaderWithMenu('sorry bro, tak sie nie bawimy');
		}
		View::rendertemplate('footer',$data);
	}


	public function uprawnieniaEdit($id = 0)
	{
		$_userModel = new \App\Models\User();
		$_rightsModel = new \App\Models\rights();

		$data['istniejaceUprawnienia'] = $_rightsModel->getRightsID($id);
		
		if ($id>=1 and 
			Session::get('loggedin') and 
			$_userModel->getRole(Session::get('userID'))==4 and 
			$id==$data['istniejaceUprawnienia']->id){
			Menu::renderHeaderWithMenu();
			uprawnienia::renderuprawnieniaEdit($id);
		}else{
			Menu::renderHeaderWithMenu('sorry bro, tak sie nie bawimy');
		}
			
		View::rendertemplate('footer',$data);
	}

	public function uprawnieniaAdd()
	{
		$_userModel = new \App\Models\User();
		$_rightsModel = new \App\Models\rights();
		
		if (Session::get('loggedin') and $_userModel->getRole(Session::get('userID'))==4) {
			Menu::renderHeaderWithMenu();
			uprawnienia::renderuprawnieniaAdd();
		}else{
			Menu::renderHeaderWithMenu('sorry bro, tak sie nie bawimy');
		}
		
		View::rendertemplate('footer',$data);
	}

	public function renderuprawnienia()
	{
		$_userModel = new \App\Models\User();
		$_rightsModel = new \App\Models\rights();
		
		$data['uprawnienia'] = $_rightsModel->getrights();
				
		View::render('rights/rights', $data);
	}

	public function renderuprawnieniaEdit($id)
	{
		$_userModel = new \App\Models\User();
		$_rightsModel = new \App\Models\rights();
		
		$data['uprawnienia'] = $_rightsModel->getrights();
				
		if(isset($_POST['submit'])){
			// #SQL INJECTION MUCH FUN WOW
			$n1 = view::antysql($_POST['login']);
			$n2 = view::antysql($_POST['podkategoria']);

			$_rightsModel->updateRights(
				array(
					'id_konto' => $n1,
					'id_podkategoria' => $n2
					), 
				array(
					'id' => $id)
				);
        	Url::redirect('uprawnienia/all');

        }elseif(isset($_POST['delete'])){
        	$_rightsModel->deleteRights(
        		array(
        			'id' => $id
        			)
        		);
        	Url::redirect('uprawnienia/all');
        		
        }else{
			$data['login'] = $_rightsModel->getLogins();
			$data['subcategories'] = $_rightsModel->getSubcategory();
			$data['aktualne'] = $_rightsModel->getRight($id);
			View::render('rights/rightsEdit', $data);
		}
	}

	public function renderuprawnieniaAdd()
	{
		$_userModel = new \App\Models\User();
		$_rightsModel = new \App\Models\rights();
		
		$data['uprawnienia'] = $_rightsModel->getrights();
				
		if(isset($_POST['submit'])){
			// #SQL INJECTION MUCH FUN WOW
			$n1 = view::antysql($_POST['login']);
			$n2 = view::antysql($_POST['podkategoria']);
							
			$_rightsModel->insertRights(
				array(
					'id_konto' => $n1,
					'id_podkategoria' => $n2
					)
				);
        	Url::redirect('uprawnienia/all');
        }else{
			$data['login'] = $_rightsModel->getLogins();
			$data['subcategories'] = $_rightsModel->getSubcategory();
			View::render('rights/rightsAdd', $data);
		}
	}
	

}
