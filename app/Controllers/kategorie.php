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

		View::renderTemplate('categories', $data);
		View::renderTemplate('footer', $data);
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

		View::renderTemplate('subcategories', $data);
		View::renderTemplate('footer', $data);
		}

}