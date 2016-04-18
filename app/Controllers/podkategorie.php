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
		if ($idkategorii>=1) {
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
		$_categoryModel = new \App\Models\subcategory();

		$data['podkategorie'] = $_categoryModel->getsubcategories($idkategorii);

		//tak sie wczytuje 
		$data['buttonSubCategory'] = View::wczytaj('buttonSubCategory');
		$data['userrole']=$_userModel->getRole(Session::get('userID'));
		View::render('subcategories/subcategories', $data);
	}

	public function podkategorieAdd($idkategorii = 0)
	{
		$_userModel = new \App\Models\User();
		$_categoryModel = new \App\Models\subcategory();

		if ($idkategorii>=1 and $_userModel->getRole(Session::get('userID'))==4) {
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

		$_categoryModel = new \App\Models\subcategory();

    	if(isset($_POST["submit"])){
        	$target_dir = $_SERVER['DOCUMENT_ROOT'].'/app/Templates/Default/Assets/images/podkategorie/';
			$uploadOk = 1;
			$nazwa = str_replace(" ", '', $_FILES["obrazek"]["name"][0]);
			$target_file = $target_dir . $nazwa;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    		$check = getimagesize($_FILES["obrazek"]["tmp_name"][0]);
    		
    		if($check !== false){
    			$uploadOk = 1;
    		}else{
    			$error[] = "Plik nie jest obrazem.";$uploadOk = 0;
    		}
    						
			if (file_exists($target_file)){
    			$error[] = "Przepraszam, taki plik juz istnieje.";
    			$uploadOk = 0;
			}
			
			if ($_FILES["obrazek"]["size"][0] > 500000){
    			$error[] = "Przepraszam, Plik jest za duzy.";
    			$uploadOk = 0;
			}
			
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
    			$error[] = "Przepraszam, pliki tylko w formatach JPG, JPEG, PNG i GIF, a twoj jest typu ".$imageFileType;
    			$uploadOk = 0;
			}
			
			if ($uploadOk == 0){
    			$error[] = "Przepraszam, plik nie zostal wyslany.";
			}else{
    			if (move_uploaded_file($_FILES['obrazek']['tmp_name'][0],$target_file)){
       				$_categoryModel->addpodkategoria(
       					array(
       						'id' => $_categoryModel->lastpodkategoria()[0]->id+1,
       						'id_kategoria' => $idkategorii,
							'nazwa' => $_POST['nazwa'],
				 			'opis' => $_POST['opis'], 
			 				'obrazek' => $nazwa
			 			)
					);
					Url::redirect('kategorie/'.$idkategorii);
    			}else{
        			$error[] = "Przepraszam, Wystapil blad podczas wysylania.";
    			}
			}
	 	}

	 	echo \core\Error::display($error);
	    View::render('subcategories/subcategoriesAdd', $data);	    
    }


}
