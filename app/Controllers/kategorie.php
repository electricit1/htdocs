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

		$data['kategorie'] = $_categoryModel->getcategories(); // widocznosc dla leszczy

		if (Session::get('loggedin')) {
			$data['userrole']=$_userModel->getRole(Session::get('userID'));
			if ($data['userrole']==4) {$data['kategorie'] = $_categoryModel->getcategoriesall();} // widocznosc  godlike
		}

       	$data['buttonCategory'] = View::wczytaj('buttonCategory'); // jak tak sobie pomysle to jednak to byl blad
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

		$data['obrazki'] = scandir("/programy/xampp/htdocs/app/templates/default/assets/images/kategorie"); 
		// startuje z dysku, // teoretycznie tu OBRAZEKIFOLDER, btw jak nie wiesz gdzie jest na dysku zrobi print_r(scanfdir("/");)
       	unset($data['obrazki'][0]); // usuwa /.
       	unset($data['obrazki'][1]); // usuwa /..

    	if(isset($_POST["submit"]))
        {
        	if ($_POST['radios']==2) { // nowy obrazek, matko boska, >.>
        		$target_dir = $_SERVER['DOCUMENT_ROOT'].'/app/Templates/Default/Assets/images/kategorie/'; // startuje z htdocs
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
					if (move_uploaded_file($_FILES['obrazek']['tmp_name'][0],$target_file)) {
	
    					// #SQL INJECTION MUCH FUN WOW
						$n1 = view::antysql($_POST['nazwa']);	
						$n2 = view::antysql($_POST['opis']);	
						$n3 = view::antysql($nazwa);	
					
       					$_categoryModel->addKategoria(
       						array(
       							'id' => $_categoryModel->lastKategoria()[0]->id+1,
								'nazwa' => $n1,
				 				'opis' => $n2,
				 				'widocznosc' => 1, 
			 					'obrazek' => $n3
			 					));
						Url::redirect('kategorie/all'); // po dodaniu przekierowuje na katgorie zeby zobaczyc efekt
    				}else{$error[] = "Przepraszam, Wystapil blad podczas wysylania.";}
    			}
			}elseif ($_POST['radios']==1){ // z listy wybrany obrazek
				
				$n1 = view::antysql($_POST['nazwa']);	
				$n2 = view::antysql($_POST['opis']);	
				$n3 = view::antysql($_POST['obrazek1']);	
					$_categoryModel->addKategoria(
						array(
							'nazwa' => $n1,
							'opis' => $n2,
							'widocznosc' => 1,
							'obrazek' => $n3));
					Url::redirect('kategorie/all');
				
			}else{$error[] = 'jeszcze bardziej kantujesz >.> lamo';}
       	}
       	
       	echo \core\Error::display($error);
       	View::render('categories/categoriesAdd', $data);
    }


	public function kategorieEdit($idkategorii = 0)
	{
		$_userModel = new \App\Models\User();
		
		if ($_userModel->getRole(Session::get('userID'))==4 and $idkategorii>=0) {
			Menu::renderHeaderWithMenu();
			kategorie::renderCategoriesEdit($idkategorii);
		}else{
			Menu::renderHeaderWithMenu('Oszukujesz, zaloguj sie');		
		}
		
		View::rendertemplate('footer',$data);
	}


	public function renderCategoriesEdit($idkategorii = 0)
    {
    	$_userModel = new \App\Models\User();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));

		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();	

		$data['aktualne'] = $_categoryModel->getobrazek($idkategorii);
		$data['widocznosc'] = array(1=> 1, 0=> 0  );
		
		$data['obrazki'] = scandir("/programy/xampp/htdocs/app/templates/default/assets/images/kategorie"); // startuje z dysku, // teoretycznie tu OBRAZEKIFOLDER
       	unset($data['obrazki'][0]); // usuwa /.
       	unset($data['obrazki'][1]); // usuwa /..

    	if(isset($_POST["submit"]))
        {
        	
        	if ($_POST['radios']==2) { // nowy obrazek, matko boska, >.>

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
						
						$_categoryModel->editKategoria(
						array(
							'nazwa' => $n1,
							'opis' => $n2,
							'widocznosc' => $n4,
							'obrazek' => $n3),
						array('id' => $data[aktualne][0]->id ));
						Url::redirect('kategorie/all');
						
    				}else{$error[] = "Przepraszam, Wystapil blad podczas wysylania.";}
				}
					
			}elseif ($_POST['radios']==1){ // z listy wybrany obrazek
				
				$n1 = view::antysql($_POST['nazwa']);	
				$n2 = view::antysql($_POST['opis']);	
				$n3 = view::antysql($_POST['obrazek1']);	
				$n4 = view::antysql($_POST['widocznosc']);	
						
					$_categoryModel->editKategoria(
						array(
							'nazwa' => $n1,
							'opis' => $n2,
							'widocznosc' => $n4,
							'obrazek' => $n3),
						array('id' => $data[aktualne][0]->id ));
					Url::redirect('kategorie/all');
				
			}else{$error[] = 'jeszcze bardziej kantujesz >.> lamo';}

       	}elseif(isset($_POST["delete"])){
       		$_categoryModel->deleteKategoria(array( 'id' => $data[aktualne][0]->id));
       		Url::redirect('kategorie/all');
       	}
		       	
       	echo \core\Error::display($error);       
       	View::render('categories/categoriesEdit', $data);       	
    }


}
