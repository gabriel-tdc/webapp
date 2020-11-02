<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/Middleware.php';

class Authentication extends Middleware {
	public function login() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');

		$this->load->model('Login_model', 'login', true);
		$user = $this->login->getUserByEmail($this->input->post('email'));

		if(!$user) {
			http_response_code(400);	
			$data = array(
				'status' => 'error',
				'message' => 'Email e/ou senha inválidos'
			);	
			die( json_encode($data) );
		}

		$isValidUser = password_verify($this->input->post('password'), $user->password);

		if($isValidUser){
			$this->load->library('jwt');
			$token = $this->jwt->generate($user);

			if($user->deleted_at){
				http_response_code(400);	
				$data = array(
					'status' => 'error',
					'message' => 'Este usuário foi deletado.'
				);	
				die( json_encode($data) );
			}

			unset($user->password);
			unset($user->deleted_at);
			unset($user->updated_at);
			unset($user->created_at);

			$data =  array(
				'token' => $token,
				'user' => $user,
			);

			$this->session->set_userdata($data);
			
			echo json_encode( $data );
		} else {	
			http_response_code(400);	
			$data = array(
				'status' => 'error',
				'message' => 'E-mail e/ou senha inválidos'
			);	
			die( json_encode($data) );
		}
	}

	public function checkAuthentication() {
		
		$requestHeaders = apache_request_headers();

		if(isset($requestHeaders['Authorization'])){
			$token = $requestHeaders['Authorization'];
		} elseif(isset($requestHeaders['Authorization'])) {
			$token = $_SERVER['HTTP_AUTHORIZATION'];
		} else {
			$data = array(
				'error' => 'Não localizado o authorization code'
			);
			http_response_code(400);
			die( json_encode($data) );
		}

		if($token) {
			$this->load->library('jwt');
			$tokenStatus = $this->jwt->check($token);
			$message = array(
				TOKEN_VALIDO => 'Token Válido',
				TOKEN_EXPIRADO => 'Token Expirado',
				TOKEN_INVALIDO => 'Token Inválido',
			);
	
			$data = array(
				'status' => $tokenStatus,
				'message' => $message[$tokenStatus]
			);
			echo json_encode($data);
		} else {
			
			$data = array(
				'error' => 'Não localizado o authorization code'
			);
			http_response_code(400);
			die( json_encode($data) );
		}

	}
}
