<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url,
	\helpers\database;

class kategorie extends Controller {

	private $_model;
	public function __construct()	
	{
		$this->_model = new \App\Models\category();
	}



	public function kategorie()
	{
		Menu::renderHeaderWithMenu();
		kategorie::renderCategories();
		View::rendertemplate('footer',$data);
	}

	
	public function renderCategories()
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();

		if (Session::get('loggedin')) {
			$data['userrole']=$_userModel->getRole(Session::get('userID'));	
		}
		$data['kategorie'] = $_categoryModel->getcategories();
       	$data['buttonCategory'] = View::wczytaj('buttonCategory');
			
		View::renderTemplate('categories', $data);

	}





	public function kategorieAdd()
	{
		kategorie::renderCategoriesAdd();
		View::rendertemplate('footer',$data);
	}


	public function podkategorie($param1 = '')
	{
		Menu::renderHeaderWithMenu();
		kategorie::renderSubCategories($param1);
		View::rendertemplate('footer',$data);
	}

	public function renderSubCategories($idkategorii)
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();

		$data['podkategorie'] = $_categoryModel->getsubcategories($idkategorii);

		//tak sie wczytuje 
		$data['buttonSubCategory'] = View::wczytaj('buttonSubCategory');
		$data['userrole']=$_userModel->getRole(Session::get('userID'));
		View::renderTemplate('subcategories', $data);

	}




	public function zestawy($param1 = '',$param2 = '')
	{
		Menu::renderHeaderWithMenu();
		kategorie::rendersets($param2);
		View::rendertemplate('footer',$data);
	}

	public function rendersets($idpodkategorii)
	{
		$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();	
		//$data['zestawy'] = $_categoryModel->getsetsall();

		$data['zestawy'] = $_categoryModel->getsets($idpodkategorii);
		$data['nazwykolumn'] = $_categoryModel->getsetscolumns();
		if (Session::get('loggedin')) {
			$data['uprawnienia'] = $_categoryModel->getuprawnienia(Session::get('userID'));
		}else{
			$data['uprawnienia'] = $_categoryModel->getuprawnienia(-1);
		}
		
		View::renderTemplate('sets', $data);
	}


	public function zestawEdit($id)
	{

		$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();	
		

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
			$_categoryModel->updateZestaw(array('id_jezyk1' => $j1, 'id_jezyk2' => $j2, 'id_podkategoria' => $np, 'nazwa' => $nz, 'zestaw' => implode(';',array($z1, $z2) ), 'ilosc_slowek' => $is, 'data_edycji' => $de), array('id' => $id));
        	Url::redirect('kategorie');
        	
        }elseif (isset($_POST['delete'])) {
        	$_categoryModel->deleteZestaw(array('id' => $id));
        	Url::redirect('kategorie');
        		
        }
        else{
		if (isset($id) and Session::get('loggedin')) {
			Menu::renderHeaderWithMenu();

			$data['zestaw'] = $_categoryModel->getsetsByOne($id);
			$data['lang'] = $_categoryModel->getLangs();
			$data['subcategories'] =$_categoryModel->getSubcategory();
			
			View::renderTemplate('zestawEdit', $data);

			View::rendertemplate('footer',$data);
		}else{
			Menu::renderHeaderWithMenu('sorry bro, tak sie nie bawimy');
			View::rendertemplate('footer',$data);
		}
		}

	}


	public function zestawAdd()
	{

		$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();	
		

		if(isset($_POST['add'])){
        	$j1 = $_POST['Jezyk_1'];
        	$j2 = $_POST['Jezyk_2'];
        	$np = $_POST['Nazwa_podkategorii'];
        	$nz = $_POST['Nazwa_zestawu'];
			$z1 = $_POST['Zawartosc_zestawu1'];
			$z2 = $_POST['Zawartosc_zestawu2'];
			$is = $_POST['Ilosc_slowek'];
			
			/*print_r( array('id' => $_categoryModel->lastZestaw()[0]->id+1,'id_konto' => Session::get('userID'), 'id_jezyk1' => $j1, 'id_jezyk2' => $j2, 'id_podkategoria' => $np,
			 'nazwa' => $nz, 'zestaw' => implode(';',array($z1, $z2) ),
			 'ilosc_slowek' => $is, 'data_edycji' => '\''.date("Y-m-d",time()).'\'' ));
			 */
			$_categoryModel->addZestaw(array('id' => $_categoryModel->lastZestaw()[0]->id+1,
				'id_konto' => Session::get('userID'), 'id_jezyk1' => $j1,
				 'id_jezyk2' => $j2, 'id_podkategoria' => $np,
			 'nazwa' => $nz, 'zestaw' => implode(';',array($z1, $z2) ),
			 'ilosc_slowek' => $is, 'data_edycji' => date("Y-m-d",time()) )
			);
        	Url::redirect('kategorie');
        	
        }else{
		if (Session::get('loggedin')) {
			Menu::renderHeaderWithMenu();

			$data['lang'] = $_categoryModel->getLangs();
			$data['subcategories'] =$_categoryModel->getSubcategory();
			
			View::renderTemplate('zestawAdd', $data);

			View::rendertemplate('footer',$data);
		}else{
			Menu::renderHeaderWithMenu('sorry bro, tak sie nie bawimy');
			View::rendertemplate('footer',$data);
		}
		}

	}

	public function renderCategoriesAdd()
    {
    	$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();	

    	if(isset($_POST["submit"]))
        	{
        		$target_dir = $_SERVER['DOCUMENT_ROOT'].'/app/Templates/Default/Assets/images/kategorie/';
				$uploadOk = 1;
				$nazwa = str_replace(" ", '', $_FILES["obrazek"]["name"][0]);
				$target_file = $target_dir . $nazwa;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    			$check = getimagesize($_FILES["obrazek"]["tmp_name"][0]);

    			if($check !== false) 
    				{$uploadOk = 1;}
    			else 
    				{$error[] = "Plik nie jest obrazem.";$uploadOk = 0;}
				
				if (file_exists($target_file)) {
    				$error[] = "Przepraszam, taki plik juz istnieje.";
    				$uploadOk = 0;
				}

				if ($_FILES["obrazek"]["size"][0] > 500000) {
    				$error[] = "Przepraszam, Plik jest za duzy.";
    				$uploadOk = 0;
				}

				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    				$error[] = "Przepraszam, pliki tylko w formatach JPG, JPEG, PNG i GIF, a twoj jest typu ".$imageFileType;
    				$uploadOk = 0;
				}

				if ($uploadOk == 0) {
    				$error[] = "Przepraszam, plik nie zostal wyslany.";
				}
				else
				{
    				if (move_uploaded_file($_FILES['obrazek']['tmp_name'][0],$target_file)) {
    					
       					$_categoryModel->addKategoria(array(
       					'id' => $_categoryModel->lastKategoria()[0]->id+1,
						'nazwa' => $_POST['nazwa'],
				 		'opis' => $_POST['opis'], 
			 			'obrazek' => $nazwa)
						);
						Url::redirect('kategorie');
    				} else {
        				$error[] = "Przepraszam, Wystapil blad podczas wysylania.";
    				}

				}

				Menu::renderHeaderWithMenu($error);

	       		View::renderTemplate('categoriesAdd', $data);

       		}else{
     
       		Menu::renderHeaderWithMenu();
       		View::renderTemplate('categoriesAdd', $data);
       		}
    }


	public function podkategorieAdd($idkategorii)
    {
    	$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();	

    	if(isset($_POST["submit"]))
        	{
        		$target_dir = $_SERVER['DOCUMENT_ROOT'].'/app/Templates/Default/Assets/images/podkategorie/';
				$uploadOk = 1;
				$nazwa = str_replace(" ", '', $_FILES["obrazek"]["name"][0]);
				$target_file = $target_dir . $nazwa;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    			$check = getimagesize($_FILES["obrazek"]["tmp_name"][0]);

    			if($check !== false) 
    				{$uploadOk = 1;}
    			else 
    				{$error[] = "Plik nie jest obrazem.";$uploadOk = 0;}
				
				if (file_exists($target_file)) {
    				$error[] = "Przepraszam, taki plik juz istnieje.";
    				$uploadOk = 0;
				}

				if ($_FILES["obrazek"]["size"][0] > 500000) {
    				$error[] = "Przepraszam, Plik jest za duzy.";
    				$uploadOk = 0;
				}

				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    				$error[] = "Przepraszam, pliki tylko w formatach JPG, JPEG, PNG i GIF, a twoj jest typu ".$imageFileType;
    				$uploadOk = 0;
				}

				if ($uploadOk == 0) {
    				$error[] = "Przepraszam, plik nie zostal wyslany.";
				}
				else
				{
    				if (move_uploaded_file($_FILES['obrazek']['tmp_name'][0],$target_file)) {
    					
       					$_categoryModel->addpodkategoria(array(
       					'id' => $_categoryModel->lastpodkategoria()[0]->id+1,
       					'id_kategoria' => $idkategorii,
						'nazwa' => $_POST['nazwa'],
				 		'opis' => $_POST['opis'], 
			 			'obrazek' => $nazwa)
						);
						Url::redirect('kategorie/'.$idkategorii);
    				} else {
        				$error[] = "Przepraszam, Wystapil blad podczas wysylania.";
    				}

				}

				Menu::renderHeaderWithMenu($error);

	       		View::renderTemplate('subcategoriesAdd', $data);

       		}else{
     
       		Menu::renderHeaderWithMenu();
       		View::renderTemplate('subcategoriesAdd', $data);
       		}
    }


}
