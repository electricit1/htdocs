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
		//Menu::renderHeaderWithMenu();
		kategorie::renderCategoriesAdd();
		View::rendertemplate('footer',$data);
	}

	/*
	public function renderCategoriesAdd()
	{
		$_userModel = new \App\Models\User();
		$menu = new \App\Controllers\menu();
		$data['userrole']=$_userModel->getRole(Session::get('userID'));
    	
		$_categoryModel = new \App\Models\category();
		$menu = new \App\Controllers\kategorie();

		View::renderTemplate('categoriesAdd', $data);
	}
	*/




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
			
			print_r( array('id' => $_categoryModel->lastZestaw()[0]->id+1,'id_konto' => Session::get('userID'), 'id_jezyk1' => $j1, 'id_jezyk2' => $j2, 'id_podkategoria' => $np,
			 'nazwa' => $nz, 'zestaw' => implode(';',array($z1, $z2) ),
			 'ilosc_slowek' => $is, 'data_edycji' => '\''.date("Y-m-d",time()).'\'' ));
			$_categoryModel->addZestaw(array('id' => $_categoryModel->lastZestaw()[0]->id+1,'id_konto' => Session::get('userID'), 'id_jezyk1' => $j1, 'id_jezyk2' => $j2, 'id_podkategoria' => $np,
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
        	if(isset($_FILES["obrazek"]))
        	{

        	$uploadOk = 1;
        	$target_dir = "/";
			$target_file = $target_dir . basename($_FILES["obrazek"]["name"]);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
        	$check = getimagesize($_FILES["obrazek"]["tmp_name"]);
			if($check !== false) {
        	//	echo "File is an image - " . $check["mime"] . ".";
       			$uploadOk = 1;
    		} else {
    		//  echo "File is not an image.";
    		    $uploadOk = 0;
    		}

    		// Check if file already exists
			if (file_exists($target_file)) {
    		// echo "Sorry, file already exists.";
    			$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["obrazek"]["size"] > 500000) {
    		// echo "Sorry, your file is too large.";
    			$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
    		// echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    			$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
    		// echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
    		if (move_uploaded_file($_FILES["obrazek"]["tmp_name"], $target_file)) {
        	// echo "The file ". basename( $_FILES["obrazek"]["name"]). " has been uploaded.";
    		} else {
        	// echo "Sorry, there was an error uploading your file.";
    		}
    		}

        		


        		$nazwa = $_POST['nazwa'];
        		$opis = $_POST['opis'];
        		$obrazek = $_POST['obrazek'];
        		//$this->db->insert('kategoria',array('nazwa' => $nazwa, 'opis' => $opis, 'obrazek' => $obrazek));
        		//Url::redirect('kategorie');


       		}else{
     
       		Menu::renderHeaderWithMenu('blad przy wczytywaniu');
       		//phpinfo();
       		print_r($_FILES);
       		View::renderTemplate('categoriesAdd', $data);
       		}
    }

}
