<?php
class Banco_horas_model extends CI_Model {

	protected $table = 'banco_horas';
	public $fields = ['id', 'id_user', 'date', 'start', 'pause', 'return', 'finish', 'total'];
	
	public function get($id) {
		$this->db->select('id, date, start, pause, return, finish, total');
		$this->db->where('id_user', $id);
		$this->db->order_by('date', 'desc');
		$bancoHoras = $this->db->get($this->table)->result();
		return $bancoHoras;
	}

	public function getById($data) {
		$this->db->select('id, date, start, pause, return, finish, total');
		$this->db->where('id', $data['id']);
		$this->db->where('id_user', $data['idUser']);
		$bancoHora = $this->db->get($this->table)->row();
		return $bancoHora;
	}

	public function getByDate($date) {
		$this->db->where('date', $date);
		$num = $this->db->get($this->table)->num_rows();
		return $num;
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
			return $this->db->insert_id();
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

	public function setTotal($id, $total) {
		$this->db->where('id', $id);
		$this->db->set('total', $total);
		$this->db->update($this->table);
		return true;
	}

}
