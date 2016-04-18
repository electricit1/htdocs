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

	public function zestawy($idkategorii = 0,$idpodkategorii = 0)
	{
		if ($idpodkategorii>=1) {
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
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_setsModel = new \App\Models\sets();
		if ($idzestawu>=1 and Session::get('loggedin') ){
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
		

		if(isset($_POST['submit'])){
        	$j1 = $_POST['Jezyk_1'];
        	$j2 = $_POST['Jezyk_2'];
        	$np = $_POST['Nazwa_podkategorii'];
        	$nz = $_POST['Nazwa_zestawu'];
			$z1 = $_POST['Zawartosc_zestawu1'];
			$z2 = $_POST['Zawartosc_zestawu2'];
			$is = $_POST['Ilosc_slowek'];
			$de = $_POST['Data_edycji'];
			//array('id_jezyk1' => $j1 'id_jezyk2' => $j2 'id_podkategoria' => $np 'nazwa' => $nz 'zestaw' => implode(';',array($z1, $z2) ) 'ilosc_slowek' => $is 'data_edycji' => $de);

			$_setsModel->updateZestaw(
				array(
					'id_jezyk1' => $j1, 
					'id_jezyk2' => $j2, 
					'id_podkategoria' => $np, 
					'nazwa' => $nz, 
					'zestaw' => implode(';',array($z1, $z2) ), 
					'ilosc_slowek' => $is, 
					'data_edycji' => $de
					),
			 	array('id' => $id)
			 	);
        	Url::redirect('kategorie');
        	
        }elseif(isset($_POST['delete'])) {
        	$_setsModel->deleteZestaw(array('id' => $id));
        	Url::redirect('kategorie');
        }else{
        	$data['zestaw'] = $_setsModel->getsetsByOne($id);
			$data['lang'] = $_setsModel->getLangs();
			$data['subcategories'] =$_setsModel->getSubcategory();	

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
        	$j1 = $_POST['Jezyk_1'];
        	$j2 = $_POST['Jezyk_2'];
        	$np = $_POST['Nazwa_podkategorii'];
        	$nz = $_POST['Nazwa_zestawu'];
			$z1 = $_POST['Zawartosc_zestawu1'];
			$z2 = $_POST['Zawartosc_zestawu2'];
			$is = $_POST['Ilosc_slowek'];
			
			/*print_r( array('id' => $_setsModel->lastZestaw()[0]->id+1,'id_konto' => Session::get('userID'), 'id_jezyk1' => $j1, 'id_jezyk2' => $j2, 'id_podkategoria' => $np,
			 'nazwa' => $nz, 'zestaw' => implode(';',array($z1, $z2) ),
			 'ilosc_slowek' => $is, 'data_edycji' => '\''.date("Y-m-d",time()).'\'' ));
			 */

			$_setsModel->addZestaw(
				array(
					'id' => $_setsModel->lastZestaw()[0]->id+1,
					'id_konto' => Session::get('userID'),
				 	'id_jezyk1' => $j1,
				 	'id_jezyk2' => $j2,
				  	'id_podkategoria' => $np,
			 		'nazwa' => $nz,
			  		'zestaw' => implode(';',array($z1, $z2)),
			 		'ilosc_slowek' => $is,
			  		'data_edycji' => date("Y-m-d",time())
			  		)
			);
        	Url::redirect('kategorie');	
        }else{
			$data['lang'] = $_setsModel->getLangs();
			$data['subcategories'] =$_setsModel->getSubcategory();
			View::render('sets/zestawAdd', $data);
		}
	}


}
