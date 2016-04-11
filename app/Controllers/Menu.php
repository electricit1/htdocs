<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url;

class Menu extends Controller
{
	public function renderHeaderWithMenu($error = '')
	{
		$_userModel = new \App\Models\User();
		$menu = new \App\Controllers\menu();
		$data['error'] = $error;
		if(Session::get('loggedin'))
		{
			$data['sessionSet'] = true;
			$data['fullname'] = $_userModel->getFullname(Session::get('userID'));
			$data['userID'] = Session::get('userID');

			$data['menu'] = $menu->getMenuForUser($_userModel->getRole(Session::get('userID')));
        /*$data['menu'] = array
        (
            array('link' => '\'#\'', 'val' => 'cos')
        );*/
		} 
		else
		{
       	 	$data['menu'] = $data['menu'] = $menu->getMenuForUser($_userModel->getRole(0));
		}
		//echo $_userModel->getRole($userID);
		View::renderTemplate('header', $data);

	}

	public function getMenuForUser($role)
	{
		switch($role)
		{
			case '1': // uczen
				$this->language->load('Welcome');
				return $this->language->get('menuuczen');
				break;
			case '2': //maly redaktor
				$this->language->load('Welcome');
				return $this->language->get('menuredaktor');
				break;
			case '3': //super redaktor
				$this->language->load('Welcome');
				return $this->language->get('menusuperredaktor');
				break;
			case '4': //admin
				$this->language->load('Welcome');
				return $this->language->get('menuadmin');
				break;
			default: //nie zalogowany
			    $this->language->load('Welcome');
				return $this->language->get('nikt');
		}

	}

}