<?php namespace App\models;

class sets extends \core\model
{
	public function getsetscolumns() {
		$data = $this->db->select("select 'id_konto','Jezyk 1','Jezyk 2','Nazwa podkategorii','Nazwa zestawu','Zawartosc zestawu','Ilosc slowek','Data edycji' ");
		return $data;
	}

	public function getsets($idpodkategori) {
		$data = $this->db->select("SELECT mt.id,ko.login as 'Login',mt.widocznosc,id_podkategoria,mt.id_konto,ja.nazwa as 'Jezyk 1',jb.nazwa as 'Jezyk 2',pk.nazwa as 'Nazwa podkategorii',mt.nazwa as 'Nazwa zestawu',zestaw as 'Zawartosc zestawu',ilosc_slowek as 'Ilosc slowek',data_edycji as 'Data edycji' FROM zestaw mt LEFT JOIN konto ko on mt.id_konto = ko.id LEFT JOIN  jezyk ja on mt.id_jezyk1 = ja.id LEFT JOIN  jezyk jb on mt.id_jezyk2 = jb.id LEFT JOIN  podkategoria pk on mt.id_podkategoria = pk.id WHERE mt.id_podkategoria=".$idpodkategori);
		return $data;
	}

	public function getsetsAll() {
		$data = $this->db->select("SELECT mt.id,ko.login as 'Login',mt.widocznosc,id_podkategoria,mt.id_konto,ja.nazwa as 'Jezyk 1',jb.nazwa as 'Jezyk 2',pk.nazwa as 'Nazwa podkategorii',mt.nazwa as 'Nazwa zestawu',zestaw as 'Zawartosc zestawu',ilosc_slowek as 'Ilosc slowek',data_edycji as 'Data edycji' FROM zestaw mt LEFT JOIN konto ko on mt.id_konto = ko.id LEFT JOIN  jezyk ja on mt.id_jezyk1 = ja.id LEFT JOIN  jezyk jb on mt.id_jezyk2 = jb.id LEFT JOIN  podkategoria pk on mt.id_podkategoria = pk.id");
		return $data;
	}

	public function getsetsByOne($id) {
		$data = $this->db->select("SELECT mt.id,ko.login as 'Login',mt.widocznosc,id_jezyk1,id_jezyk2,mt.id_konto,id_podkategoria,ja.nazwa as 'Jezyk 1',jb.nazwa as 'Jezyk 2',pk.nazwa as 'Nazwa podkategorii',mt.nazwa as 'Nazwa zestawu',zestaw as 'Zawartosc zestawu',ilosc_slowek as 'Ilosc slowek',data_edycji as 'Data edycji' FROM zestaw mt LEFT JOIN konto ko on mt.id_konto = ko.id LEFT JOIN  jezyk ja on mt.id_jezyk1 = ja.id LEFT JOIN  jezyk jb on mt.id_jezyk2 = jb.id LEFT JOIN  podkategoria pk on mt.id_podkategoria = pk.id WHERE mt.id=".$id);
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

	public function getSubcategoryID($idpodkategorii) {
		$data = $this->db->select("SELECT id FROM ".PREFIX."podkategoria where id=".$idpodkategorii);
		return $data[0];
	}	

	public function getsetsID($idzestawu) {
		$data = $this->db->select("SELECT id FROM ".PREFIX."zestaw where id=".$idzestawu);
		return $data[0];
	}	


}


