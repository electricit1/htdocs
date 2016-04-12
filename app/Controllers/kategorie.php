<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url;

class kategorie extends Controller {

	private $_model;
	public function __construct()	
	{
		$this->_model = new \App\Models\category();
	}

	public function kategorie()
	{
		kategorie::renderCategories();
		View::rendertemplate('footer',$data);
	}

	
	public function renderCategories()
	{
		$_userModel = new \App\Models\User();
		$menu = new \App\Controllers\menu();

		if(Session::get('loggedin'))
		{
			$data['sessionSet'] = true;
			$data['fullname'] = $_userModel->getFullname(Session::get('userID'));
			$data['menu'] = $menu->getMenuForUser($_userModel->getRole(Session::get('userID')));
		} 
		else
		{
       	 	$data['menu'] = $menu->getMenuForUser($_userModel->getRole(0));
		}
		View::renderTemplate('header', $data);
    	
		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();

       	$data = $_categoryModel->getcategories();

       //tak sie wczytuje 
		$data['buttonCategory'] = View::wczytaj('buttonCategory');

		View::renderTemplate('categories', $data);

	}



	public function podkategorie($param1 = '')
	{
		kategorie::renderSubCategories($param1);
		View::rendertemplate('footer',$data);
	}

	public function renderSubCategories($idkategorii)
	{
		$_userModel = new \App\Models\User();
		$menu = new \App\Controllers\menu();

		if(Session::get('loggedin'))
		{
			$data['sessionSet'] = true;
			$data['fullname'] = $_userModel->getFullname(Session::get('userID'));
			$data['menu'] = $menu->getMenuForUser($_userModel->getRole(Session::get('userID')));
		} 
		else
		{
       	 	$data['menu'] = $menu->getMenuForUser($_userModel->getRole(0));
		}

		
		View::renderTemplate('header', $data);

		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();

		$data = $_categoryModel->getsubcategories($idkategorii);

		//tak sie wczytuje 
		$data['buttonSubCategory'] = View::wczytaj('buttonSubCategory');

		View::renderTemplate('subcategories', $data);

		}




	public function zestawy($param1 = '',$param2 = '')
	{
		kategorie::rendersets($param2);
		View::rendertemplate('footer',$data);
	}

	public function rendersets($idpodkategorii)
	{
		$_userModel = new \App\Models\User();
		$menu = new \App\Controllers\menu();

		if(Session::get('loggedin'))
		{
			$data['sessionSet'] = true;
			$data['fullname'] = $_userModel->getFullname(Session::get('userID'));
			$data['menu'] = $menu->getMenuForUser($_userModel->getRole(Session::get('userID')));
		} 
		else
		{
       	 	$data['menu'] = $menu->getMenuForUser($_userModel->getRole(0));
		}

		
		View::renderTemplate('header', $data);

		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();

		$rola = $_userModel->getRole(Session::get('userID'));

		if ($rola>=3) {
			$data['zestawy'] = $_categoryModel->getsetsall();
		}else{

			if ($rola>=1) {
				$data['zestawy'] = $_categoryModel->getsets($idpodkategorii);
			}
		}
		
		$data['nazwykolumn'] = $_categoryModel->getsetscolumns();
		
		View::renderTemplate('sets', $data);

		}




}