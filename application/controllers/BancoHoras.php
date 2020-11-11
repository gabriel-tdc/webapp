<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'controllers/Middleware.php';

class BancoHoras extends Middleware {
	public function __construct() {
		parent::__construct();
		$this->load->model('Banco_horas_model', 'bancoHoras', TRUE);
	}
	
	public function get() {
		$bancoHoras = $this->bancoHoras->get($this->jwtPayload->id);

		echo json_encode($bancoHoras);
	}

	public function getById() {
		$idBanco = $this->uri->segment(2);
		$bancoHoras = $this->bancoHoras->getById(
			[
				'id' => $idBanco,
				'idUser' => $this->jwtPayload->id 
			]
		);

		echo json_encode($bancoHoras);
	}

	public function insert() {
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('date', 'data', 'required');
		
		if ($this->form_validation->run()){	
			$data = $this->input->post();
			// Forçar inserir sempre para o usuário logado
			$data['id_user'] = $this->jwtPayload->id;

			$this->validacoes($data);

			$alreadyRegistered = $this->bancoHoras->getByDate($data['date']);
			if($alreadyRegistered){
				http_response_code(400);
				echo json_encode(
					['message' => 'Esta data já possui um registro.']
				);
				die();
			}

			$inserted = $this->bancoHoras->insert($data);
		
			$this->calcularTempoTotal($inserted);

			echo json_encode(
				['message' => $inserted ? 'Dados salvos com sucesso': 'Não foi possivel salvar os dados']
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
		
		$this->form_validation->set_rules('date', 'data', 'required');
		
		if ($this->form_validation->run()){	
			$idBanco = $this->uri->segment(2);
			
			$this->validacoes($this->input->post());
	
			$updated = $this->bancoHoras->update($idBanco, $this->input->post());
	
			if($updated){
				$this->calcularTempoTotal($idBanco);
			}
	
			echo json_encode(
				['message' => $updated ? 'Dados alterado com sucesso': 'Não foi possivel atualizar']
			);
		} else {
			http_response_code(400);
			echo json_encode(
				['message' => validation_errors()]
			);
		}

	}

	private function calculateHours($hourFrom, $hourTo){
		$date_time  = new DateTime($hourFrom);
		$diff       = $date_time->diff( new DateTime($hourTo));
		return $diff->format('%H:%I:%S');
	}

	private function isHour($hour){
		return preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/", $hour);
	}

	private function isDate($date){
		$format = 'Y-m-d';
		$d = DateTime::createFromFormat($format, $date);
    	return $d && $d->format($format) == $date;
	}

	private function validacoes($data){
		// Validar se a entrada dos dados estão no formato correto
		// Validação da Data
		if( isset($data['date']) && !$this->isDate( $data['date'] ) ){
			http_response_code(400);
			echo json_encode(
				['message' => "O campo date deve ser no formato de data (1999-12-31)"]
			);
			die();
		}

		// Validação das Horas
		$hourFields = ["start", "pause", "return", "finish"];
		foreach($hourFields as $hourField){
			if(	isset($data[$hourField]) && $data[$hourField] != '' && !$this->isHour( $data[$hourField] ) ){
				http_response_code(400);
				echo json_encode(
					['message' => "O campo $hourField deve ser no formato de hora (00:00)"]
				);
				die();
			}
		}
	}

	private function calcularTempoTotal($idBanco){
		// Selecionar o registro, para calcular o tempo caso tenha fechado o dia
		$bancoHoras = $this->bancoHoras->getById(
			[
				'id' => $idBanco,
				'idUser' => $this->jwtPayload->id 
			]
		);

		if($bancoHoras->start && $bancoHoras->pause && $bancoHoras->return && $bancoHoras->finish){				
			$horaAlmoco			= $this->calculateHours($bancoHoras->return, $bancoHoras->pause);
			$horaTrabalho		= $this->calculateHours($bancoHoras->start, $bancoHoras->finish);
			$totalTrabalhado	= $this->calculateHours($horaTrabalho, $horaAlmoco);
			$this->bancoHoras->setTotal($idBanco, $totalTrabalhado);
		}
	}
}
