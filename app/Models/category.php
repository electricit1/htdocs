<?php namespace App\models;

class category extends \core\model
{
	public function getcategories() {
		$data['kategorie'] = $this->db->select("SELECT id,nazwa,opis,obrazek FROM ".PREFIX."kategoria"); // WHERE login = :username", array(':username' => $username
		return $data;
	}

	public function getsubcategories($idkategori) {
		$data['podkategorie'] = $this->db->select("SELECT id,id_kategoria,nazwa,opis,obrazek FROM ".PREFIX."podkategoria where id_kategoria=".$idkategori);
		return $data;
	}

}