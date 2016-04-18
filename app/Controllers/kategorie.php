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
			
		View::render('categories/categories', $data);

	}


	public function kategorieAdd()
	{
		$_userModel = new \App\Models\User();
		
		if ($_userModel->getRole(Session::get('userID'))==4) {
			Menu::renderHeaderWithMenu();
			kategorie::renderCategoriesAdd();
		}else{
			Menu::renderHeaderWithMenu('Oszukujesz, zaloguj sie');		
		}
		
		View::rendertemplate('footer',$data);
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

    		if($check !== false){
    			$uploadOk = 1;
    		}else{
    			$error[] = "Plik nie jest obrazem.";
    			$uploadOk = 0;
    		}
    						
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
			}else{
    			if (move_uploaded_file($_FILES['obrazek']['tmp_name'][0],$target_file)) {	
       				$_categoryModel->addKategoria(
       					array(
       						'id' => $_categoryModel->lastKategoria()[0]->id+1,
							'nazwa' => $_POST['nazwa'],
				 			'opis' => $_POST['opis'], 
			 				'obrazek' => $nazwa
			 				)
					);
					Url::redirect('kategorie');
    			}else{
        			$error[] = "Przepraszam, Wystapil blad podczas wysylania.";
    			}
			}
       	}
       	
       	echo \core\Error::display($error);
       	View::render('categories/categoriesAdd', $data);
       	
    }


}
