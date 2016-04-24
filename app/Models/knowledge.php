<?php namespace App\models;

class knowledge extends \core\model
{
	public function getzestaw($id) {
		$data = $this->db->select("SELECT id,zestaw,ilosc_slowek FROM ".PREFIX." zestaw where id=".$id); 
		return $data;
	}

	public function getlang($id) {
		$data = $this->db->select("SELECT ko.nazwa as 'jez1',pk.nazwa as 'jez2' FROM zestaw up INNER JOIN jezyk ko on up.id_jezyk1 = ko.id LEFT JOIN jezyk pk on up.id_jezyk2 = pk.id where up.id=".$id); 
		return $data;
	}

	public function addWynik($table) {
		$this->db->insert('wynik',$table);
	}

}

