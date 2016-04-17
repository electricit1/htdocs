<?php namespace App\models;

class category extends \core\model
{
	public function getcategories() {
		$data = $this->db->select("SELECT id,nazwa,opis,obrazek FROM ".PREFIX."kategoria"); 
		// WHERE login = :username", array(':username' => $username
		return $data;
	}

	public function getsubcategories($idkategori) {
		/*	
		Sposoby na wypisanie tego dziadostwa

		<?php foreach ($data['nazwykolumn'] as $value) echo "<th>$value->Field</th>"; ?>
		"SHOW COLUMNS FROM ".DB_NAME.".zestaw"

		<?php foreach ($data['nazwykolumn'] as $value) echo "<td>$value->COLUMN_NAME</td>"; ?>
		"SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME = 'zestaw'"

		*/
		$data = $this->db->select("SELECT id,id_kategoria,nazwa,opis,obrazek FROM ".PREFIX."podkategoria where id_kategoria=".$idkategori);
		return $data;
	}

	public function getsetscolumns() {
		$data = $this->db->select("select 'id','id_konto','Jezyk 1','Jezyk 2','Nazwa podkategorii','Nazwa zestawu','Zawartosc zestawu','Ilosc slowek','Data edycji' ");
		return $data;
	}

	public function getsets($idpodkategori) {
		$data = $this->db->select("SELECT mt.id,ko.login as 'Login',id_podkategoria,ja.nazwa as 'Jezyk 1',jb.nazwa as 'Jezyk 2',pk.nazwa as 'Nazwa podkategorii',mt.nazwa as 'Nazwa zestawu',zestaw as 'Zawartosc zestawu',ilosc_slowek as 'Ilosc slowek',data_edycji as 'Data edycji' FROM zestaw mt LEFT JOIN konto ko on mt.id_konto = ko.id LEFT JOIN  jezyk ja on mt.id_jezyk1 = ja.id LEFT JOIN  jezyk jb on mt.id_jezyk2 = jb.id LEFT JOIN  podkategoria pk on mt.id_podkategoria = pk.id WHERE mt.id_podkategoria=".$idpodkategori);
		return $data;
	}

	public function getsetsByOne($id) {
		$data = $this->db->select("SELECT mt.id,ko.login as 'Login',id_jezyk1,id_jezyk2,id_podkategoria,ja.nazwa as 'Jezyk 1',jb.nazwa as 'Jezyk 2',pk.nazwa as 'Nazwa podkategorii',mt.nazwa as 'Nazwa zestawu',zestaw as 'Zawartosc zestawu',ilosc_slowek as 'Ilosc slowek',data_edycji as 'Data edycji' FROM zestaw mt LEFT JOIN konto ko on mt.id_konto = ko.id LEFT JOIN  jezyk ja on mt.id_jezyk1 = ja.id LEFT JOIN  jezyk jb on mt.id_jezyk2 = jb.id LEFT JOIN  podkategoria pk on mt.id_podkategoria = pk.id WHERE mt.id=".$id);
		return $data;
	}

	public function getLangs() {
		$data = $this->db->select("SELECT id,nazwa FROM ".PREFIX."jezyk");
		return $data;
	}

	public function getSubcategory() {
		$data = $this->db->select("SELECT id,nazwa FROM ".PREFIX."podkategoria");
		return $data;
	}	


	public function getsetsall() {
		$data = $this->db->select("SELECT id,id_konto,id_jezyk1,id_jezyk2,id_podkategoria,nazwa,zestaw,ilosc_slowek,data_edycji FROM ".PREFIX."zestaw");
		return $data;
	}

	public function getuprawnienia($idkonto) {
		$data = $this->db->select("SELECT id_podkategoria FROM ".PREFIX."uprawnienia where id_konto=".$idkonto);
		return $data;
	}

	public function updateZestaw($table,$where) {
		$this->db->update('Zestaw',$table,$where);
	}

	public function deleteZestaw($where) {
		$this->db->delete('Zestaw',$where);
	}

	public function addZestaw($table) {
		$this->db->insert('Zestaw',$table);
	}

	public function lastZestaw() {
		$data = $this->db->select("SELECT id FROM zestaw ORDER BY id DESC LIMIT 1");
		return $data;
	}	

}


