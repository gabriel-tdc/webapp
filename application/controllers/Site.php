<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('utils');
	}
	
	public function index() {
		$this->redirectIfLoggedIn();

		$data = [
			'page' => 'login',
			'pageTitle' => 'Bem vindo! Realize seu login',
		];
		$this->load->view('site', $data);
	}

	public function cadastro() {
		$this->redirectIfLoggedIn();

		$data = [
			'page' => 'cadastro',
			'pageTitle' => 'Bem vindo! Realize seu cadastro',
		];
		$this->load->view('site', $data);
	}

	public function alterar_dados() {
		$this->authenticationCheck();

		$user = $this->session->userdata('user');
		$token = $this->session->userdata('token');

		$data = [
			'page' => 'alterar-dados',
			'pageTitle' => 'Atualização de cadastro',
			'user' => $user,
			'token' => $token,
		];
		$this->load->view('site', $data);
	}

	public function ponto() {
		$this->authenticationCheck();

		$user = $this->session->userdata('user');
		$this->load->model('Banco_horas_model', 'bancoHoras', true);
		$bancoHoras = $this->bancoHoras->get($user->id);

		$total = 0;
		foreach ($bancoHoras as $bancoHora) {
			if($bancoHora->total){
				$total += $this->utils->convertInSeconds($bancoHora->total);
			}
		}
		$totalTime = $this->utils->convertSecondsInDate($total);

		$data = [
			'page' => 'ponto',
			'pageTitle' => 'Painel do seu Ponto',
			'bancoHoras' => $bancoHoras,
			'totalTime' => $totalTime,
		];
		$this->load->view('site', $data);
	}

	public function lancar_horas() {
		$this->authenticationCheck();

		$token = $this->session->userdata('token');
		$data = [
			'page' => 'lancar-horas',
			'pageTitle' => 'Lançar horas',
			'token' => $token,
		];
		$this->load->view('site', $data);
	}

	public function editar_horas() {
		$this->authenticationCheck();
		
		$user = $this->session->userdata('user');
		
		$idBanco = $this->uri->segment(2);
		$this->load->model('Banco_horas_model', 'bancoHoras', true);
		$bancoHoras = $this->bancoHoras->getById(
			[
				'id' => $idBanco,
				'idUser' => $user->id 
			]
		);


		$token = $this->session->userdata('token');
		$data = [
			'page' => 'editar-horas',
			'pageTitle' => 'Editar horas',
			'token' => $token,
			'bancoHoras' => $bancoHoras,
		];
		$this->load->view('site', $data);
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}

	private function authenticationCheck() {
		$user = $this->session->userdata('user');
		if(!$user){
			redirect('/');
		}
	}

	private function redirectIfLoggedIn() {
		$user = $this->session->userdata('user');
		if($user){
			redirect('ponto');
		}
	}
}
