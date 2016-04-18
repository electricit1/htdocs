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
		$_categoryModel = new \App\Models\rights();
		
		if ($_userModel->getRole(Session::get('userID'))==4 and Session::get('loggedin')){
			Menu::renderHeaderWithMenu();
			uprawnienia::renderuprawnienia();
		}else{
			Menu::renderHeaderWithMenu('sorry bro, tak sie nie bawimy');
		}
		View::rendertemplate('footer',$data);
	}


	public function uprawnieniaEdit($id)
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\rights();

		if (isset($id) and Session::get('loggedin') and $_userModel->getRole(Session::get('userID'))==4){
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
		$_categoryModel = new \App\Models\rights();
		
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
		$_categoryModel = new \App\Models\rights();
		
		$data['uprawnienia'] = $_categoryModel->getrights();
				
		View::render('rights/rights', $data);
	}

	public function renderuprawnieniaEdit($id)
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\rights();
		
		$data['uprawnienia'] = $_categoryModel->getrights();
				
		if(isset($_POST['submit'])){
        	$lg = $_POST['login'];
        	$pk = $_POST['podkategoria'];
      				
			$_categoryModel->updateRights(
				array(
					'id_konto' => $lg,
					'id_podkategoria' => $pk
					), 
				array(
					'id' => $id)
				);
        	Url::redirect('uprawnienia');

        }elseif(isset($_POST['delete'])){
        	$_categoryModel->deleteRights(
        		array(
        			'id' => $id
        			)
        		);
        	Url::redirect('uprawnienia');
        		
        }else{
			$data['login'] = $_categoryModel->getLogins();
			$data['subcategories'] = $_categoryModel->getSubcategory();
			$data['aktualne'] = $_categoryModel->getRight($id);
			View::render('rights/rightsEdit', $data);
		}
	}

	public function renderuprawnieniaAdd()
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\rights();
		
		$data['uprawnienia'] = $_categoryModel->getrights();
				
		if(isset($_POST['submit'])){
        	$lg = $_POST['login'];
        	$pk = $_POST['podkategoria'];
        	
				
			$_categoryModel->insertRights(
				array(
					'id_konto' => $lg,
					'id_podkategoria' => $pk
					)
				);
        	Url::redirect('uprawnienia');
        }else{
			$data['login'] = $_categoryModel->getLogins();
			$data['subcategories'] = $_categoryModel->getSubcategory();
			View::render('rights/rightsAdd', $data);
		}
	}
	

}
