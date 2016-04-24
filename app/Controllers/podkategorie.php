<?php namespace App\Controllers;
use \core\view,
	\core\Controller,
	\helpers\session,
	\helpers\password,
	\helpers\url,
	\helpers\database;

class podkategorie extends Controller {

	private $_model;
	public function __construct()	
	{
		$this->_model = new \App\Models\subcategory();
	}

	public function podkategorie($idkategorii = 0)
	{
		$_subcategoryModel = new \App\Models\subcategory();
		$data['istniejacepodKategorie'] = $_subcategoryModel->getsubcategory();
		
		if ($idkategorii>=1 and 
			in_array( (object) array(id=> $idkategorii), $data['istniejacepodKategorie'])) {

			Menu::renderHeaderWithMenu();
			podkategorie::renderSubCategories($idkategorii);
		}else{
			Menu::renderHeaderWithMenu('nie ma takiej kategorii');
		}
		View::rendertemplate('footer',$data);
	}

	public function renderSubCategories($idkategorii)
	{
		$_userModel = new \App\Models\User();
		$_subcategoryModel = new \App\Models\subcategory();
		$data['podkategorie'] = $_subcategoryModel->getsubcategories($idkategorii);
		if ($_userModel->getRole(Session::get('userID'))==4) {
				$data['podkategorie'] = $_subcategoryModel->getsubcategoriesall($idkategorii);
			}
		

		//tak sie wczytuje 
		$data['buttonSubCategory'] = View::wczytaj('buttonSubCategory');
		$data['userrole']=$_userModel->getRole(Session::get('userID'));
		View::render('subcategories/subcategories', $data);
	}

	public function podkategorieAdd($idkategorii = 0)
	{
		$_userModel = new \App\Models\User();
		$_subcategoryModel = new \App\Models\subcategory();
		$data['istniejaceKategorie'] = $_subcategoryModel->getcategories();
		
		if ($idkategorii>=1 and 
			$_userModel->getRole(Session::get('userID'))==4 and 
			in_array( (object) array(id=> $idkategorii), $data['istniejaceKategorie'])) {

			Menu::renderHeaderWithMenu();
			podkategorie::renderpodkategorieAdd($idkategorii);
		}else{
			Menu::renderHeaderWithMenu('nie ma takiej kategorii lub nie masz dostepu do tej czesci');
		}
		View::rendertemplate('footer',$data);
	}

	public function renderpodkategorieAdd($idkategorii)
    {
    	$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_subcategoryModel = new \App\Models\subcategory();
		
		$data['obrazki'] = scandir("/programy/xampp/htdocs/app/templates/default/assets/images/podkategorie"); // startuje z dysku, // teoretycznie tu OBRAZEKIFOLDER
       	unset($data['obrazki'][0]); // usuwa /.
       	unset($data['obrazki'][1]); // usuwa /..

    	if(isset($_POST["submit"])){
    		if ($_POST['radios']==2) { // nowy obrazek, matko boska, >.>
        		$target_dir = $_SERVER['DOCUMENT_ROOT'].'/app/Templates/Default/Assets/images/podkategorie/';
				$uploadOk = 1;
				$nazwa = str_replace(" ", '', $_FILES["obrazek"]["name"][0]);
				$target_file = $target_dir . $nazwa;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    			$check = getimagesize($_FILES["obrazek"]["tmp_name"][0]);
	    		
    			if($check !== false){$uploadOk = 1;}else{$error[] = "Plik nie jest obrazem.";$uploadOk = 0;}
    			if (file_exists($target_file)) {$error[] = "Przepraszam, taki plik juz istnieje.";$uploadOk = 0;}
				if ($_FILES["obrazek"]["size"][0] > 5000000) {$error[] = "Przepraszam, Plik jest za duzy.";$uploadOk = 0;}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
					{$error[] = "Przepraszam, pliki tylko w formatach JPG, JPEG, PNG i GIF, a twoj jest typu ".$imageFileType;$uploadOk = 0;}
				if ($uploadOk == 0) {$error[] = "Przepraszam, plik nie zostal wyslany.";
				}else{
    				if (move_uploaded_file($_FILES['obrazek']['tmp_name'][0],$target_file)){
    					// #SQL INJECTION MUCH FUN WOW
						
						$n1 = view::antysql($_POST['nazwa']);	
						$n2 = view::antysql($_POST['opis']);	
						$n3 = view::antysql($nazwa);	
	
       					$_subcategoryModel->addpodkategoria(
       						array(
       							'id' => $_subcategoryModel->lastpodkategoria()[0]->id+1,
       							'id_kategoria' => $idkategorii,
								'nazwa' => $n1,
				 				'opis' => $n2, 
			 					'obrazek' => $n3,
			 					'widocznosc' => 1
			 				)
						);
						Url::redirect('podkategorie/'.$idkategorii);
    				}else{$error[] = "Przepraszam, Wystapil blad podczas wysylania.";}
				}
			}elseif ($_POST['radios']==1){ // z listy wybrany obrazek
				
				$n1 = view::antysql($_POST['nazwa']);	
				$n2 = view::antysql($_POST['opis']);	
				$n3 = view::antysql($_POST['obrazek1']);	
	
				$obrazek=$_POST['obrazek1'];
				$_subcategoryModel->addpodkategoria(
					array(
						'nazwa' => $n1,
						'opis' => $n2,
						'id_kategoria' => $idkategorii,
						'widocznosc' => 1,
						'obrazek' => $n3));
				Url::redirect('podkategorie/'.$idkategorii);
				
			}else{$error[] = 'jeszcze bardziej kantujesz >.> lamo';}



	 	}

	 	echo \core\Error::display($error);
	    View::render('subcategories/subcategoriesAdd', $data);	    
    }





    public function podkategorieEdit($idpodkategorii = 0)
	{
		$_userModel = new \App\Models\User();
		
		if ($_userModel->getRole(Session::get('userID'))==4 and $idpodkategorii>=0) {
			Menu::renderHeaderWithMenu();
			podkategorie::rendersubCategoriesEdit($idpodkategorii);
		}else{
			Menu::renderHeaderWithMenu('Oszukujesz, zaloguj sie');		
		}
		
		View::rendertemplate('footer',$data);
	}


	public function rendersubCategoriesEdit($idpodkategorii = 0)
    {
    	$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_subcategoryModel = new \App\Models\subcategory();
		$menu = new \App\Controllers\podkategorie();	

		$data['aktualne'] = $_subcategoryModel->getobrazek($idpodkategorii);
		$data['widocznosc'] = array(1=> 1, 0=> 0 );
		
		$data['obrazki'] = scandir("/programy/xampp/htdocs/app/templates/default/assets/images/podkategorie"); // startuje z dysku, // teoretycznie tu OBRAZEKIFOLDER
       	unset($data['obrazki'][0]); // usuwa /.
       	unset($data['obrazki'][1]); // usuwa /..

       	$data['kategoria'] = $_subcategoryModel->getcategories2();

    	if(isset($_POST["submit"]))
        {
        	
        	$error[] = ( $_POST['radios']);
        	if ($_POST['radios']==2) { // nowy obrazek, matko boska, >.>

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

				if (file_exists($target_file)) {$error[] = "Przepraszam, taki plik juz istnieje.";$uploadOk = 0;}
				if ($_FILES["obrazek"]["size"][0] > 5000000) 
					{$error[] = "Przepraszam, Plik jest za duzy.";$uploadOk = 0;}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
					{$error[] = "Przepraszam, pliki tylko w formatach JPG, JPEG, PNG i GIF, a twoj jest typu ".$imageFileType;$uploadOk = 0;}
				if ($uploadOk == 0) {$error[] = "Przepraszam, plik nie zostal wyslany.";}
				else{
    				if (move_uploaded_file($_FILES['obrazek']['tmp_name'][0],$target_file)) {

    					// #SQL INJECTION MUCH FUN WOW
						$n1 = view::antysql($_POST['nazwa']);	
						$n2 = view::antysql($_POST['opis']);	
						$n3 = view::antysql($nazwa);
						$n4 = view::antysql($_POST['widocznosc']);	
						$n5 = view::antysql($_POST['kategoria']);	
				
       					$_subcategoryModel->editpodkategoria(
						array(
							'nazwa' => $n1,
							'opis' => $n2,
							'obrazek' => $n3,
							'widocznosc' => $n4,
							'id_kategoria' => $n5),
						array('id' => $data[aktualne][0]->id ));
						Url::redirect('podkategorie/'.$data['aktualne'][0]->id_kategoria);
						
    				}else{$error[] = "Przepraszam, Wystapil blad podczas wysylania.";}
				}
					
			}elseif ($_POST['radios']==1){ // z listy wybrany obrazek
				
					$n1 = view::antysql($_POST['nazwa']);	
					$n2 = view::antysql($_POST['opis']);	
					$n3 = view::antysql($obrazek);
					$n4 = view::antysql($_POST['widocznosc']);	
					$n5 = view::antysql($_POST['kategoria']);	
				
					$obrazek=$_POST['obrazek1'];
					$_subcategoryModel->editpodkategoria(
						array(
							'nazwa' => $n1,
							'opis' => $n2,
							'obrazek' => $n3,
							'widocznosc' => $n4,
							'id_kategoria' => $n5),
						array('id' => $data[aktualne][0]->id ));
					Url::redirect('podkategorie/'.$data['aktualne'][0]->id_kategoria);
				
			}else{$error[] = 'jeszcze bardziej kantujesz >.> lamo';}

       	}elseif(isset($_POST["delete"])){
       		$_subcategoryModel->deletepodkategoria(array( 'id' => $data[aktualne][0]->id));
       		Url::redirect('podkategorie/'.$data['aktualne'][0]->id_kategoria);
       	}
		       	
       	echo \core\Error::display($error);       
       	View::render('subcategories/subcategoriesEdit', $data);       	
    }
}
