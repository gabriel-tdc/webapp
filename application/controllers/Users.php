<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/Middleware.php';

class Users extends Middleware {
	public function __construct() {
		parent::__construct();
		$this->load->model('Users_model', 'users', TRUE);
	}
	
	public function getLoggedUser() {
		$user = $this->users->get($this->jwtPayload->id);

		echo json_encode($user);
	}
	
	public function insert() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run()){	
			$data = $this->input->post();
			$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
	
			$this->users->insert($data);
	
			echo json_encode(
				['message' => 'Dados salvos com sucesso']
			);
		} else {
			http_response_code(400);
			echo json_encode(
				['message' => validation_errors()]
			);
		}

	}
	
	public function update() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 'name', 'required');
		$user = $this->users->get($this->jwtPayload->id);

		if($user->email != $this->input->post('email')){
			$this->form_validation->set_rules('email', 'email', 'required|is_unique[users.email]');
		} else {
			$this->form_validation->set_rules('email', 'email', 'required');
		}

		if ($this->form_validation->run()){	
			$data = $this->input->post();
			if($this->input->post('password') && $this->input->post('password') != ""){
				$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			} else {
				unset($data['password']);
			}
	
			$this->users->update($this->jwtPayload->id, $data);
			$user = $this->users->get($this->jwtPayload->id);
			
			$this->session->set_userdata('user', $user);
	
			echo json_encode(
				['message' => 'Dados alterados com sucesso']
			);
		} else {
			http_response_code(400);
			echo json_encode(
				['message' => validation_errors()]
			);
		}

	}

}
