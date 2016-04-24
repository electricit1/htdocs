<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url,
	\helpers\database;

class zestaw extends Controller {

	private $_model;
	public function __construct()	
	{
		$this->_model = new \App\Models\sets();
	}

	public function zestawy($idpodkategorii = 0)
	{
		$_setsModel = new \App\Models\sets();
		$data['istniejacePodkategorie'] = $_setsModel->getSubcategoryID($idpodkategorii);
		
		if ($idpodkategorii>=1 and
			$idpodkategorii==$data['istniejacePodkategorie']->id) {
			Menu::renderHeaderWithMenu();
			zestaw::rendersets($idpodkategorii);
		}else{
			Menu::renderHeaderWithMenu('Nie ma takiej podkategorii');
		}

		View::rendertemplate('footer',$data);
	}

	public function rendersets($idpodkategorii)
	{
		$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_setsModel = new \App\Models\sets();
		
		$data['zestawy'] = $_setsModel->getsets($idpodkategorii);
		$data['nazwykolumn'] = $_setsModel->getsetscolumns();

		if (Session::get('loggedin')) {
			$data['uprawnienia'] = $_setsModel->getuprawnienia(Session::get('userID'));
		}else{
			$data['uprawnienia'] = $_setsModel->getuprawnienia(-1);
		}
		
		View::render('sets/sets', $data);
	}

	public function zestawEdit($idzestawu = 0)
	{
		$_userModel = new \App\Models\User();
		$_setsModel = new \App\Models\sets();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));
		$data['istniejaceZestawy'] = $_setsModel->getsetsID($idzestawu);

		
		if ($idzestawu>=1 and 
			Session::get('loggedin') and 
			$idzestawu==$data['istniejaceZestawy']->id){
			$data['zestaw'] = $_setsModel->getsetsByOne($idzestawu);
			$data['uprawnienia'] = $_setsModel->getuprawnienia(Session::get('userID'));
			
			
			if (Session::get('userID')==$data[zestaw][0]->id_konto or
				$_userModel->getRole(Session::get('userID'))==4 or
				in_array((object) array(id_podkategoria => $data[zestaw][0]->id_podkategoria), $data['uprawnienia'])){
				Menu::renderHeaderWithMenu();	
				zestaw::renderzestawEdit($idzestawu);
			}else{
				Menu::renderHeaderWithMenu('nie masz dostepu do tej sekcji');
			}
		}else{
			Menu::renderHeaderWithMenu('zaloguj sie lub nie ma takiego zestawu');
		}

		View::rendertemplate('footer',$data);
	}

	public function renderzestawEdit($id)
	{

		$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_setsModel = new \App\Models\sets();

		$data['zestaw'] = $_setsModel->getsetsByOne($id);
		$data['lang'] = $_setsModel->getLangs();
		$data['subcategories'] =$_setsModel->getSubcategory();
		$data['widocznosc'] = array(1 => 1, 0 => 0);

		if(isset($_POST['submit'])){
			// #SQL INJECTION MUCH FUN WOW
	
			$n1 = view::antysql($_POST['Jezyk_1']);	
			$n2 = view::antysql($_POST['Jezyk_2']);	
			$n3 = view::antysql($_POST['Nazwa_podkategorii']);	
			$n4 = view::antysql($_POST['Nazwa_zestawu']);	
			$n5 = view::antysql($_POST['Zawartosc_zestawu1']);
			$n6 = count(explode(PHP_EOL, trim($_POST['Zawartosc_zestawu1']))); // to samo przy dodawniniu	
			$n7 = view::antysql($_POST['Data_edycji']);	
			$n8 = view::antysql($_POST['widocznosc']);	
			
			$_setsModel->updateZestaw(
				array(
					'id_jezyk1' => $n1, 
					'id_jezyk2' => $n2, 
					'id_podkategoria' => $n3, 
					'nazwa' => $n4, 
					'zestaw' => $n5, 
					'ilosc_slowek' => $n6, 
					'data_edycji' => date("Y-m-d",time()),
					'widocznosc' => $n8
					),
			 	array('id' => $id)
			 	);
        	Url::redirect('zestaw/all');
        	
        }elseif(isset($_POST['delete'])) {
        	$_setsModel->deleteZestaw(array('id' => $id));
        	Url::redirect('zestaw/all');
        }else{
			View::render('sets/zestawEdit', $data);
		}

	}


	public function zestawAdd()
	{
		$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_setsModel = new \App\Models\sets();
		if (Session::get('loggedin') ){
			$data['uprawnienia'] = $_setsModel->getuprawnienia(Session::get('userID'));
			
			
			if ($_userModel->getRole(Session::get('userID'))==4 or
				in_array((object) array(id_podkategoria => $data[zestaw][0]->id_podkategoria), $data['uprawnienia'])){
				Menu::renderHeaderWithMenu();	
				zestaw::renderzestawAdd();
			}else{
				Menu::renderHeaderWithMenu('nie masz dostepu do tej sekcji');
			}
		}else{
			Menu::renderHeaderWithMenu('zaloguj sie');
		}

		View::rendertemplate('footer',$data);
	}



	public function renderzestawAdd()
	{

		$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_setsModel = new \App\Models\sets();
		

		if(isset($_POST['add'])){
        	// #SQL INJECTION MUCH FUN WOW
			$n1 = view::antysql($_POST['Jezyk_1']);	
			$n2 = view::antysql($_POST['Jezyk_2']);	
			$n3 = view::antysql($_POST['Nazwa_podkategorii']);	
			$n4 = view::antysql($_POST['Nazwa_zestawu']);	
			$n5 = view::antysql($_POST['Zawartosc_zestawu1']);
			$n6 = count(explode(PHP_EOL, trim($_POST['Zawartosc_zestawu1']))); // to samo przy dodawniniu	
						
			$_setsModel->addZestaw(
				array(
					'id_konto' => Session::get('userID'),
				 	'id_jezyk1' => $n1,
				 	'id_jezyk2' => $n2,
				  	'id_podkategoria' => $n3,
			 		'nazwa' => $n4,
			  		'zestaw' => $n5,
			 		'ilosc_slowek' => $n6,
			  		'data_edycji' => date("Y-m-d",time()),
			  		'widocznosc' => 1
			  		)
			);
        	Url::redirect('zestaw/all');	
        }else{
			$data['lang'] = $_setsModel->getLangs();
			$data['subcategories'] =$_setsModel->getSubcategory();
			View::render('sets/zestawAdd', $data);
		}
	}

	public function zestawAll()
	{
		$_setsModel = new \App\Models\sets();
		
		Menu::renderHeaderWithMenu();
		zestaw::rendersetsAll();

		View::rendertemplate('footer',$data);
	}

	public function rendersetsAll()
	{
		$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_setsModel = new \App\Models\sets();
		
		$data['zestawy'] = $_setsModel->getsetsAll();
		$data['nazwykolumn'] = $_setsModel->getsetscolumns();

		if (Session::get('loggedin')) {
			$data['uprawnienia'] = $_setsModel->getuprawnienia(Session::get('userID'));
		}else{
			$data['uprawnienia'] = $_setsModel->getuprawnienia(-1);
		}
		
		View::render('sets/sets', $data);
	}

}
