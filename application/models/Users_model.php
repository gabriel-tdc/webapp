<?php
class Users_model extends CI_Model {

	protected $table = 'users';
	public $fields = ['id', 'name', 'email', 'password'];
	
	public function get($id) {
		$this->db->select($this->fields);
		$this->db->where('id', $id);
		$users = $this->db->get($this->table)->row();
		return $users;
	}

	public function getById($data) {
		$this->db->select($this->fields);
		$this->db->where('id', $data['id']);
		$user = $this->db->get($this->table)->row();
		return $user;
	}
	
	public function insert($data) {
		// Campos que não podem ser inserido
		foreach($data as $index => $postFields){
			if(!in_array($index, $this->fields)){
				unset($data[$index]);
				unset($data['id']);
			}
		}
		
		if(count($data) >= 1){
			$this->db->insert($this->table, $data);
			return true;
		} else {
			return false;
		}
	}

	public function update($id, $data) {
		// Campos que não podem ser alterados via código
		foreach($data as $index => $postFields){
			if(!in_array($index, $this->fields)){
				unset($data[$index]);
				unset($data['id']);
			}
		}

		if(count($data) >= 1){
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
			return true;
		} else {
			return false;
		}

	}

}
