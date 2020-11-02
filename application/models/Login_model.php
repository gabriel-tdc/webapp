<?php
class Login_model extends CI_Model {

	public $nome;
	public $email;
	public $senha;

	public function getUserByEmail($email) {
		$this->db->order_by('id', 'desc');
		$this->db->where('email', $email);
		$user = $this->db->get('users')->row();
		return $user;
	}

}
