<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Middleware extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->jwtPayload = (object) array();

		if(isset($this->uri->rsegments[3]) && ($this->uri->rsegments[3] == 'private')){
			
			function getAuthorizationHeader(){
				$headers = null;
				if (isset($_SERVER['Authorization'])) {
					$headers = trim($_SERVER["Authorization"]);
				}
				else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
					$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
				} elseif (function_exists('apache_request_headers')) {
					$requestHeaders = apache_request_headers();
					// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
					$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
					//print_r($requestHeaders);
					if (isset($requestHeaders['Authorization'])) {
						$headers = trim($requestHeaders['Authorization']);
					}
				}
				return $headers;
			}

			$header = getAuthorizationHeader();
	
			if($header){
				$token = $header;
			} else {
				$data = array(
					'error' => 'Não localizado o authorization code'
				);
				http_response_code(400);
				die( json_encode($data) );
			}
	
			if(isset($token)) {
				$this->load->library('jwt');
				$tokenStatus = $this->jwt->check($token);
	
				if($tokenStatus === TOKEN_VALIDO){
					$payload = $this->jwt->getPayload($token);

					if(isset($payload->admin)){
						if($payload->admin !== true){
							$data = array(
								'status' => 0,
								'message' => 'Token não autorizado'
							);
							http_response_code(400);
							die( json_encode($data) );
						}
					}
					
					$this->jwtPayload = $payload;
				} else {
					$message = array(
						TOKEN_VALIDO => 'Token Válido',
						TOKEN_EXPIRADO => 'Token Expirado',
						TOKEN_INVALIDO => 'Token Inválido',
					);
					
					if($tokenStatus !== TOKEN_VALIDO){
						http_response_code(400);
					}
			
					$data = array(
						'status' => $tokenStatus,
						'message' => $message[$tokenStatus]
					);
					die( json_encode($data) );
				}
			} else {
				http_response_code(400);
				$data = array(
					'status' => 0,
					'message' => 'Token não encontrado'
				);
				die( json_encode($data) );
			}
		}

		// Post FIX
		$_POST = !empty($_POST) ? $_POST : json_decode(file_get_contents("php://input"), true);

	}
}
