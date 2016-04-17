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
		$menu = new \App\Controllers\uprawnienia();	
		
		Menu::renderHeaderWithMenu();
		if ($_userModel->getRole(Session::get('userID'))==4) {
			uprawnienia::renderuprawnienia();
		}
		View::rendertemplate('footer',$data);
	}

	public function renderuprawnienia()
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\rights();
		$menu = new \App\Controllers\uprawnienia();	
		
		$data['uprawnienia'] = $_categoryModel->getrights();
				
		View::renderTemplate('rights', $data);
	}

	public function uprawnieniaEdit($id)
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\rights();
		$menu = new \App\Controllers\uprawnienia();	
		
		
		if ($_userModel->getRole(Session::get('userID'))==4) {
			uprawnienia::renderuprawnieniaEdit($id);
		}
		
	}

	public function renderuprawnieniaEdit($id)
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\rights();
		$menu = new \App\Controllers\uprawnienia();	
		
		$data['uprawnienia'] = $_categoryModel->getrights();
				
		if(isset($_POST['submit'])){
        	$lg = $_POST['login'];
        	$pk = $_POST['podkategoria'];
        	
				
			$_categoryModel->updateRights(array('id_konto' => $lg, 'id_podkategoria' => $pk), array('id' => $id));
        	Url::redirect('uprawnienia');
        	
        }elseif (isset($_POST['delete'])) {
        	$_categoryModel->deleteRights(array('id' => $id));
        	Url::redirect('uprawnienia');
        		
        }
        else{
		if (isset($id) and Session::get('loggedin')) {
			Menu::renderHeaderWithMenu();

			$data['login'] = $_categoryModel->getLogins();
			$data['subcategories'] = $_categoryModel->getSubcategory();
			$data['aktualne'] = $_categoryModel->getRight($id);
			View::renderTemplate('rightsEdit', $data);

			View::rendertemplate('footer',$data);
		}else{
			Menu::renderHeaderWithMenu('sorry bro, tak sie nie bawimy');
			View::rendertemplate('footer',$data);
		}
		}
	}



	public function uprawnieniaAdd()
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\rights();
		$menu = new \App\Controllers\uprawnienia();	
		
		
		if ($_userModel->getRole(Session::get('userID'))==4) {
			uprawnienia::renderuprawnieniaAdd();
		}
		
	}

	public function renderuprawnieniaAdd()
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\rights();
		$menu = new \App\Controllers\uprawnienia();	
		
		$data['uprawnienia'] = $_categoryModel->getrights();
				
		if(isset($_POST['submit'])){
        	$lg = $_POST['login'];
        	$pk = $_POST['podkategoria'];
        	
				
			$_categoryModel->insertRights(array('id_konto' => $lg, 'id_podkategoria' => $pk));
        	Url::redirect('uprawnienia');
        }
        else{
		if (Session::get('loggedin')) {
			Menu::renderHeaderWithMenu();

			$data['login'] = $_categoryModel->getLogins();
			$data['subcategories'] = $_categoryModel->getSubcategory();
			View::renderTemplate('rightsAdd', $data);

			View::rendertemplate('footer',$data);
		}else{
			Menu::renderHeaderWithMenu('sorry bro, tak sie nie bawimy');
			View::rendertemplate('footer',$data);
		}
		}
	}

}
