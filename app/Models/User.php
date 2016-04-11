<?php namespace App\models;

class User extends \core\model
{
	public function getHash($username) {
		$data = $this->db->select("SELECT haslo FROM ".PREFIX."konto WHERE login = :username", array(':username' => $username));
		return $data[0]->haslo;
	}

	public function getID($username)
	{
		$data = $this->db->select("SELECT id FROM ".PREFIX."konto WHERE login = :username", array(':username' => $username));
		return $data[0]->id;
	}

	public function update($data,$where)
	{
		$this->db->update(PREFIX."konto",$data,$where);
	}

	public function getFullname($userID)
	{
		$data = $this->db->select("SELECT imie, nazwisko FROM ".PREFIX."konto WHERE id = :id", array(':id' => $userID));
		
		return $data[0]->imie.' '.$data[0]->nazwisko;
	}

	public function getRole($userID)
	{
		$data = $this->db->select("SELECT id_rola FROM ".PREFIX."konto WHERE id = :id", array(':id' => $userID));
		
		return $data[0]->id_rola;
	}

	public function getAllUsers()
	{
		$data = $this->db->select("SELECT konto.id, imie, nazwisko, login, konto.id_rola, nazwa AS rola FROM ".PREFIX."konto INNER JOIN rola ON konto.id_rola=rola.id");
		return $data;
	}

	public function getUser($userID)
	{
	    $data = $this->db->select("SELECT konto.id, imie, nazwisko, login, id_rola, email, nazwa AS rola FROM ".PREFIX."konto INNER JOIN rola ON konto.id_rola=rola.id WHERE konto.id=:userID",array(':userID' => $userID));
		return $data[0];
	}

	public function getAllRoles()
	{
		$data = $this->db->select("SELECT id, nazwa FROM ".PREFIX."rola WHERE id != 4");
		return $data;
	}
}