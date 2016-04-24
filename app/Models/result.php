<?php namespace App\models;

class result extends \core\model
{
	public function getwyniki($id) {
		$data = $this->db->select("select ok.nazwa,tk.login,data_wyniku,wynik from wynik pt inner join konto tk on pt.id_konto=tk.id inner join zestaw ok on pt.id_zestaw=ok.id where pt.id_konto=".$id." order by data_wyniku desc"); 
		return $data;
	}

	public function getwynikiall() {
		$data = $this->db->select("select ok.nazwa,tk.login,data_wyniku,wynik from wynik pt inner join konto tk on pt.id_konto=tk.id inner join zestaw ok on pt.id_zestaw=ok.id order by data_wyniku desc"); 
		return $data;
	}
}

