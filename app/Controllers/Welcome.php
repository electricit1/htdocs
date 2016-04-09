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
        $data['title'] = $this->language->get('welcomeText');
        $data['welcomeMessage'] = $this->language->get('welcomeMessage');
        $data['ElementyMenu'] = $this->language->get('ElementyMenu');

        View::renderTemplate('header', $data);
        View::render('Welcome/Menu', $data);
        View::render('Welcome/Welcome', $data);
        View::renderTemplate('footer', $data);
    }

    public function subPage()
    {
        $data['title'] = $this->language->get('subpageText');
        $data['welcomeMessage'] = $this->language->get('subpageMessage');

        View::renderTemplate('header', $data);
        View::render('Welcome/SubPage', $data);
        View::renderTemplate('footer', $data);
    }

    public function signin()
    {
        $data['title'] = $this->language->get('subpageText');
        $data['welcomeMessage'] = $this->language->get('subpageMessage');

        View::renderTemplate('header', $data);
        View::render('Welcome/signin', $data);
        View::renderTemplate('footer', $data);
    }
}
