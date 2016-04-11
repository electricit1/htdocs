<?php namespace App\Controllers;

use \Core\View,
	\Core\Controller,
	\Helpers\Session,
	\Helpers\Url;

/*
*
* class_name controller
*/
class User extends Controller
{
	private $_model;
    /**
     * Call the parent construct
     */
    public function __construct()
    {
        $this->_model = new \App\Models\User();
    }

    /**
     * Define Index method
     */
    public function index()
    {

        if(Session::get('loggedin'))
        {
        	if($this->_model->getRole(Session::get('userID')) != 4)
        	{
        		Menu::renderHeaderWithMenu('Nie posiadasz wystarczających uprawnień');
        	}
        	else
        	{
        		$data['table'] = $this->_model->getAllUsers();
        		Menu::renderHeaderWithMenu();
        		View::render('users/allUsers', $data);
        		View::renderTemplate('footer');
        	} 

        }
        else
        {
        	Menu::renderHeaderWithMenu('Musisz być zalogowany');
        }

    }

    public function add()
    {
        echo "dodaje uzytkownika";
    }

    public function edit($id)
    {
    	if(Session::get('loggedin'))
        {
        	if(isset($_POST['submit']))
        	{
        		$imie = $_POST['imie'];
        		$nazwisko = $_POST['nazwisko'];
        		$login = $_POST['login'];
        		$email = $_POST['email'];
        		if($this->_model->getRole(Session::get('userID')) == 4 && $this->_model->getRole($id) != 4 )
        		{
                    echo $this->_model->getRole($id);
        			$rola = $_POST['rola'];
        			$this->_model->update(array('imie' => $imie, 'nazwisko' => $nazwisko, 'login' => $login, 'id_rola' => $rola, 'email' => $email), array('id' => $id));
        			Url::redirect('user/all');
        		}
        		else
        		{
        			$this->_model->update(array('imie' => $imie, 'nazwisko' => $nazwisko, 'login' => $login, 'email' => $email), array('id' => $id));
        			Url::redirect('user/edit/'.$id);
        		}
        			
        	}
        	else
        	{
        		if($this->_model->getRole(Session::get('userID')) == 4  || Session::get('userID') == $id)
        		{
        			if($this->_model->getRole(Session::get('userID')) == 4 && $this->_model->getRole($id) != 4)
        				$data['roles'] = $this->_model->getAllRoles();
        			$data['user'] = $this->_model->getUser(Session::get('userID'));
        			//$error= '';
        			Menu::renderHeaderWithMenu();
        			View::render('users/editUser', $data, $error);
        			View::renderTemplate('footer');
        		}
        		else
        		{
        			Menu::renderHeaderWithMenu('Nie posiadasz wystarczających uprawnień');
        		} 
        	}
        }
        else
        {
        	Menu::renderHeaderWithMenu('Musisz być zalogowany');
        }
    }

    public function delete()
    {
        echo "usuwam smiecia";
    }

    public function nick()
    {
    	echo json_encode(array('nick' => 'default'));
    }

}