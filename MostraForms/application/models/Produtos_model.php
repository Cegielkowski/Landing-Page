<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos_model extends CI_Model {

	public function getProdutos() {
		$query = $this->db->get('formulario');
		return $query->result();
	}

}