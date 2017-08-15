<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {


	public function __constructor(){
		parent::__constructor;
	}

	public function index()
	{
		//Carrega o model
		$this->load->model('produtos_model','produtos');
		
		//Pega dados do model
		$data['produtos'] = $this->produtos->getProdutos();

		$this->load->view('listarprodutos',$data);
	}


}
