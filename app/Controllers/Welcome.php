<?php namespace App\Controllers;

use Core\View,
    Core\Controller,
    Helpers\Session;

class Welcome extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->language->load('Welcome');
    }


    public function index()
    {
        $data['title'] = 'Strona główna';
        if(isset($_POST['error']))
        {
            $error =$_POST['error'];
        }


        Menu::renderHeaderWithMenu($error);
        //View::renderTemplate('header', $data);
        View::render('Welcome/Welcome', $data);
        View::renderTemplate('footer', $data);
    }

    public function subPage()
    {
        $data['title'] = $this->language->get('subpageText');
        $data['welcomeMessage'] = $this->language->get('subpageMessage');

        Menu::renderHeaderWithMenu();
        //View::renderTemplate('header', $data);
        View::render('Welcome/SubPage', $data);
        View::renderTemplate('footer', $data);
    }

}
