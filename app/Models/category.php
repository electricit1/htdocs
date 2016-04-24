<?php namespace App\models;

class category extends \core\model
{
	public function getcategories() {
		$data = $this->db->select("SELECT id,nazwa,opis,widocznosc,obrazek FROM ".PREFIX."kategoria where widocznosc=1"); 
		return $data;
	}

	public function getcategoriesall() {
		$data = $this->db->select("SELECT id,nazwa,opis,widocznosc,obrazek FROM ".PREFIX."kategoria"); 
		return $data;
	}

	public function addKategoria($table) {
		$this->db->insert('kategoria',$table);
	}	

	public function editKategoria($table,$where) {
		$this->db->update('kategoria',$table,$where);
	}	

	public function deleteKategoria($where) {
		$this->db->delete('kategoria',$where);
	}	

	public function lastKategoria() {
		$data = $this->db->select("SELECT id FROM kategoria ORDER BY id DESC LIMIT 1");
		return $data;
	}

	public function getobrazki() {
		$data = $this->db->select("SELECT obrazek FROM kategoria");
		return $data;
	}

	public function getobrazek($idkategorii) {
		$data = $this->db->select("SELECT id,nazwa,opis,widocznosc,obrazek FROM kategoria where id=".$idkategorii);
		return $data;
	}

	public function isteniejeObraz($obraz) {
		$data = $this->db->select("SELECT obrazek FROM kategoria where obrazek='".$obraz."'");
		return $data;
	}


}


