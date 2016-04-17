<?php namespace App\models;

class rights extends \core\model
{
	
	public function getrights() {
		$data = $this->db->select("SELECT up.id as 'id',ko.id as 'id_konto',pk.nazwa as 'Nazwa Podkategorii',ko.login as 'Login' FROM uprawnienia up LEFT JOIN konto ko on up.id_konto = ko.id LEFT JOIN podkategoria pk on up.id_podkategoria = pk.id ");
		return $data;
	}

	public function getLogins() {
		$data = $this->db->select("SELECT id,login from konto");
		return $data;
	}

	public function getSubcategory() {
		$data = $this->db->select("SELECT id,nazwa from podkategoria");
		return $data;
	}

	public function getRight($id) {
		$data = $this->db->select("SELECT id,id_konto,id_podkategoria from uprawnienia where id=".$id);
		return $data;
	}

	public function updateRights($table,$id) {
		$data = $this->db->update('uprawnienia',$table,$id);
		return $data;
	}

	public function deleteRights($id) {
		$data = $this->db->delete('uprawnienia',$id);
		return $data;
	}

	public function insertRights($table) {
		$data = $this->db->insert('uprawnienia',$table);
		return $data;
	}


}


