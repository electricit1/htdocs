<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url,
	\helpers\database;

class wiedza extends Controller {

	private $_model;
	public function __construct()	
	{
		$this->_model = new \App\Models\knowledge();
	}

	public function wiedzaNaukaWyborJezyka($idzestawu = 0)
	{
		$_knowledgeModel = new \App\Models\knowledge();
		
		if ($idzestawu>=1) {
			//wybor jezyka
			if (isset($_POST['submit'])) {$wybor=$_POST['radios1'];$tryb = $_POST['radios2'];url::redirect("wiedza/nauka/".$idzestawu."/".$tryb."/".$wybor);}

			Menu::renderHeaderWithMenu();
			$data[jezyki]=$_knowledgeModel->getlang($idzestawu);
			view::render('knowledge/wiedzaWyborJezyka', $data);
		}else{
			Menu::renderHeaderWithMenu('zly zestaw');
		}

		View::rendertemplate('footer',$data);
	}

	public function wiedzaNauka($idzestawu = 0, $tryb = 0, $wybor = 0)
	{
		$_knowledgeModel = new \App\Models\knowledge();
		
		if ($idzestawu>=1 and ($wybor==0 or $wybor==1) and ($tryb==0 or $tryb==1)) {
			Menu::renderHeaderWithMenu();
			wiedza::renderknowledge($idzestawu,$tryb,$wybor);
		}else{
			Menu::renderHeaderWithMenu('oszukujesz, pfft');
		}

		View::rendertemplate('footer',$data);
	}

	public function renderknowledge($idzestawu,$tryb,$wybor)
	{
		$_userModel = new \App\Models\User();
		$_knowledgeModel = new \App\Models\knowledge();

		if (!isset($_POST['submit'])) {
			$data['zestaw'] = $_knowledgeModel->getzestaw($idzestawu);
			$_SESSION['wyniktotal'] = $data['zestaw'][0]->ilosc_slowek;
			$_SESSION['wyniksum'] = 0;
			$j1 = explode(PHP_EOL, $data['zestaw'][0]->zestaw);
			shuffle($j1);
			$_SESSION['tab']=$j1;
			$data['wybor'] = $wybor;
			View::render('knowledge/wiedza', $data);
			
		}elseif (isset($_POST['submit'])){
			// opisane w funkcji renderknowledge, wiedza.php
			$slowo = view::antysql($_POST['slowo']);
			$data['wybor'] = $wybor; // jezyk pierwszy lub drugi
			$jest=0; // sprawdza czy slowo jest poprawne
			$zestawJezyk1 = explode(',',explode(';',$_SESSION['tab'][0])[($data['wybor']+1)%2]); 
			// rozwala zestaw, na jezyk1 i jezyk2, a potem rozwala slowa w ktoryms z jezykow na 
			// pojedyncze zaleznie od wybranego jezyka dlatego jest ($data['wybor']+1)%2, do wyboru sa 2 jezyki wiec,
			// bierze liczbe dodaje 1 i robi reszte z dzielnia dlatego to jest zbior slow ktore sa sprawdzane z podanym slowem
			
			
			//sprawdza czy jest poprawnie wpisane
			foreach ($zestawJezyk1 as $key => $value) {if (trim($value)==$slowo) {$jest=1;$_SESSION['wyniksum']++;break;}}
			
			// jezeli jest to usuwa i ponownie tasuje tablice zestawu
			if ($jest==1 or $tryb==0) {unset($_SESSION['tab'][0]);shuffle($_SESSION['tab']);}
			// jezeli skonczyl to redirect
			if (($_SESSION['tab'][0])==NULL){
				$data['wynik'][0]=$_SESSION['wyniksum'];
				$data['wynik'][1]=$_SESSION['wyniktotal'];
				unset($_SESSION['wyniksum']);
				unset($_SESSION['wyniktotal']);
				unset($_SESSION['tab']);
				View::render('knowledge/wynik', $data);
				}else{
					View::render('knowledge/wiedza', $data);
				}
				
			//	Url::redirect("zestaw/all"); 
			}
	}




	public function wiedzaSprWyborJezyka($idzestawu = 0)
	{
		$_knowledgeModel = new \App\Models\knowledge();
		
		if ($idzestawu>=1) {
			if (isset($_POST['submit'])) {$wybor=$_POST['radios1'];url::redirect("wiedza/spr/".$idzestawu."/".$wybor);}

			Menu::renderHeaderWithMenu();
			$data[jezyki]=$_knowledgeModel->getlang($idzestawu);
			view::render('knowledge/wiedzaWyborJezykaSpr', $data);
		}else{
			Menu::renderHeaderWithMenu('zly zestaw');
		}

		View::rendertemplate('footer',$data);
	}

	public function wiedzaSpr($idzestawu = 0, $wybor = 0)
	{
		$_knowledgeModel = new \App\Models\knowledge();
		
		if ($idzestawu>=1 and ($wybor==0 or $wybor==1)) {
			Menu::renderHeaderWithMenu();
			wiedza::renderknowledgeSpr($idzestawu,$wybor);
		}else{
			Menu::renderHeaderWithMenu('oszukujesz, pfft');
		}

		View::rendertemplate('footer',$data);
	}

	public function renderknowledgeSpr($idzestawu,$wybor)
	{
		$_userModel = new \App\Models\User();
		$_knowledgeModel = new \App\Models\knowledge();

		if (!isset($_POST['submit'])) {
			$data['zestaw'] = $_knowledgeModel->getzestaw($idzestawu);
			$_SESSION['wyniktotal'] = $data['zestaw'][0]->ilosc_slowek;
			$_SESSION['wyniksum'] = 0;
			$j1 = explode(PHP_EOL, $data['zestaw'][0]->zestaw);
			shuffle($j1);
			$_SESSION['tab']=$j1;
			$data['wybor'] = $wybor;
			View::render('knowledge/wiedza', $data);
			
		}elseif (isset($_POST['submit'])){
			// opisane w funkcji renderknowledge, wiedza.php
			$slowo = view::antysql($_POST['slowo']);
			$data['wybor'] = $wybor; 
			$zestawJezyk1 = explode(',',explode(';',$_SESSION['tab'][0])[($data['wybor']+1)%2]); 
			
			foreach ($zestawJezyk1 as $key => $value) {if (trim($value)==$slowo) {$_SESSION['wyniksum']++;break;}}
			
			unset($_SESSION['tab'][0]);
			shuffle($_SESSION['tab']);
			
			if (($_SESSION['tab'][0])==NULL){
				$data['wynik'][0]=$_SESSION['wyniksum'];
				$data['wynik'][1]=$_SESSION['wyniktotal'];
				if( session::get('loggedin')==true ) {
				$_knowledgeModel->addWynik(
					array(
						'id_konto' => session::get('userID'),
						'id_zestaw' => $idzestawu,
						'data_wyniku' => date("Y-m-d",time()),
						'wynik' => ($_SESSION['wyniksum']/$_SESSION['wyniktotal'])*100));
				}
				unset($_SESSION['wyniksum']);
				unset($_SESSION['wyniktotal']);
				View::render('knowledge/wynik', $data);
			}else{
				View::render('knowledge/wiedza', $data);
			}
				
		}
	}








}
