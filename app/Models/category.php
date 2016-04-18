<?php namespace App\models;

class category extends \core\model
{
	public function getcategories() {
		$data = $this->db->select("SELECT id,nazwa,opis,obrazek FROM ".PREFIX."kategoria"); 
		// WHERE login = :username", array(':username' => $username
		return $data;
	}

	public function addKategoria($table) {
		$this->db->insert('kategoria',$table);
	}	

	public function lastKategoria() {
		$data = $this->db->select("SELECT id FROM kategoria ORDER BY id DESC LIMIT 1");
		return $data;
	}

}


