<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UsuarioModel extends CI_Model{

	public function insertUsuario($dados = null){

		if($dados != null){

			$this->db->insert('tb_usuario', $dados);

			$this->session->set_flashdata('cadastrook','Operação realizada com sucesso.');
			
			redirect('admin/usuario');
		}
	}
	
	public function getById($id = null){

		if($id != null){
			
			$this->db->where('id_usuario', $id);

			$this->db->limit(1);

			return $this->db->get('tb_usuario');
		}
	}
	

	public function updateUsuario($dados = null, $condition = null){

		if($dados != null && $condition != null){

			$this->db->update('tb_usuario', $dados, $condition);

			$this->session->set_flashdata('edicaook', 'Cadastro alterado com sucesso.');

			redirect(current_url());
		}
	}

	public function inativarUsuario($id = null){
		if($id != null){
			$dados = array('ativo' => 0, 'dt_update' => date("Y-m-d H:i:s"));
			$condition = array('id_usuario' => $id);
			$this->db->update('tb_usuario', $dados, $condition);
			return true;

		}
	}

	public function ativarUsuario($id = null){
		if($id != null){
			$dados = array('ativo' => 1, 'dt_update' => date("Y-m-d H:i:s"));
			$condition = array('id_usuario' => $id);
			$this->db->update('tb_usuario', $dados, $condition);
			return true;

		}
	}

	public function getAllUsuario(){

		$this->db->from('tb_usuario');

		$this->db->order_by('id_usuario');


		return $this->db->get();
	}

	//Pega o usuario que tenha o login e a senha cadastrada no banco de dados
	public function getUsuario($dados = null){

		if($dados != null){

			//Monta a consulta com a seguintes condições
			$this->db->where('email', $dados['login']);
			//$this->db->where('senha', sha1($dados['senha']));
			$this->db->where('senha', $dados['senha']);

			//Armazena os registro na variavel query
			$query = $this->db->get('tb_usuario');

			//Verifica se foi encontrado um registro com os dados igual a das condições
			if($query->num_rows == 1){	
				//Retorna o registro com os dados semelhantes ao aos dados que foram informados		
				return $query->result_array();
			}
		}
	}

	//Método responsavel pela verificação do login e senha no banco de dados
	public function doValidate($dados = null){

		if($dados != null){

			//Monta a consulta com a seguintes condições
			$this->db->where('email', $dados['login']);
			//$this->db->where('senha', sha1($dados['senha']));
			$this->db->where('senha', $dados['senha']);

			//Armazena os registro na variavel query
			$query = $this->db->get('tb_usuario');

			//Verifica se foi encontrado um registro com os dados igual a das condições
			if($query->num_rows == 1){
				return true;
			}
		}
	}
	/*
		Atualizar o ultimo login do usuário
	*/
	public function updateLastLogin($dados = null, $condition = null){
		if ($dados != null && $condition != null ){
			$this->db->update('tb_usuario', $dados, $condition);
		}
	}
	
} // fim class