<?php namespace App\models;

class subcategory extends \core\model
{
	public function getsubcategories($idkategori) {
		/*	
		Sposoby na wypisanie tego dziadostwa

		<?php foreach ($data['nazwykolumn'] as $value) echo "<th>$value->Field</th>"; ?>
		"SHOW COLUMNS FROM ".DB_NAME.".zestaw"

		<?php foreach ($data['nazwykolumn'] as $value) echo "<td>$value->COLUMN_NAME</td>"; ?>
		"SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME = 'zestaw'"

		*/
		$data = $this->db->select("SELECT id,id_kategoria,widocznosc,nazwa,opis,obrazek FROM ".PREFIX."podkategoria where id_kategoria=".$idkategori." and widocznosc=1");
		return $data;
	}

	public function getsubcategoriesall($idkategori) {
		$data = $this->db->select("SELECT id,id_kategoria,widocznosc,nazwa,opis,obrazek FROM ".PREFIX."podkategoria where id_kategoria=".$idkategori);
		return $data;
	}	

	public function addpodkategoria($table) {
		$this->db->insert('podkategoria',$table);
	}	

	public function lastpodkategoria() {
		$data = $this->db->select("SELECT id FROM podkategoria ORDER BY id DESC LIMIT 1");
		return $data;
	}

	public function getcategories() {
		$data = $this->db->select("SELECT id FROM kategoria");
		return $data;
	}

	public function getcategories2() {
		$data = $this->db->select("SELECT id,nazwa FROM kategoria");
		return $data;
	}

	public function getobrazek($idpodkategorii) {
		$data = $this->db->select("SELECT id,id_kategoria,nazwa,opis,widocznosc,obrazek FROM podkategoria where id=".$idpodkategorii);
		return $data;
	}

	public function editpodkategoria($table,$where) {
		$this->db->update('podkategoria',$table,$where);
	}	


	public function getsubcategory() {
		$data = $this->db->select("SELECT id FROM ".PREFIX."podkategoria");
		return $data;
	}	

	public function deletepodkategoria($where) {
		$this->db->delete('podkategoria',$where);
	}	

}


