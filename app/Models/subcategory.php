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
		$data = $this->db->select("SELECT id,id_kategoria,nazwa,opis,obrazek FROM ".PREFIX."podkategoria where id_kategoria=".$idkategori);
		return $data;
	}

	public function addpodkategoria($table) {
		$this->db->insert('podkategoria',$table);
	}	

	public function lastpodkategoria() {
		$data = $this->db->select("SELECT id FROM podkategoria ORDER BY id DESC LIMIT 1");
		return $data;
	}
}


