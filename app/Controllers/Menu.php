<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url;

class Menu extends Controller
{
	public function renderHeaderWithMenu()
	{
		$_userModel = new \App\Models\User();
		$menu = new \App\Controllers\menu();

		if(Session::get('loggedin'))
		{
			$data['sessionSet'] = true;
			$data['fullname'] = $_userModel->getFullname(Session::get('userID'));

			$data['menu'] = $menu->getMenuForUser($_userModel->getRole(Session::get('userID')));
        /*$data['menu'] = array
        (
            array('link' => '\'#\'', 'val' => 'cos')
        );*/
		} 
		else
		{
       	 	$data['menu'] = array
        	(
            	array('link' => '\'#\'', 'val' => 'cos')
        	);
		}
		echo $_userModel->getRole($userID);
		View::renderTemplate('header', $data);

	}

	private function getMenuForUser($role)
	{
		switch($role)
		{
			case '1':
				return array
					(
						array('link' => '#', 'val' => 'menu1 dla ucznia'),
						array('link' => '#', 'val' => 'menu2 dla ucznia')
					);
				break;
			default:
			    return array
        		(
            		array('link' => '\'#\'', 'val' => 'cos')
        		);
		}

	}
}