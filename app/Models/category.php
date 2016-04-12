<?php namespace App\models;

class category extends \core\model
{
	public function getcategories() {
		$data['kategorie'] = $this->db->select("SELECT id,nazwa,opis,obrazek FROM ".PREFIX."kategoria"); 
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
		$data['podkategorie'] = $this->db->select("SELECT id,id_kategoria,nazwa,opis,obrazek FROM ".PREFIX."podkategoria where id_kategoria=".$idkategori);
		return $data;
	}

	public function getsetscolumns() {
		$data = $this->db->select("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".DB_NAME."' AND TABLE_NAME = 'zestaw'");
		return $data;
	}

	public function getsets($idpodkategori) {
		$data = $this->db->select("SELECT id,id_konto,id_jezyk1,id_jezyk2,id_podkategoria,nazwa,zestaw,ilosc_slowek,data_edycji FROM ".PREFIX."zestaw where id_podkategoria=".$idpodkategori);
		return $data;
	}

	public function getsetsall() {
		$data = $this->db->select("SELECT id,id_konto,id_jezyk1,id_jezyk2,id_podkategoria,nazwa,zestaw,ilosc_slowek,data_edycji FROM ".PREFIX."zestaw");
		return $data;
	}

}


