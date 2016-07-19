<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CategoriaModel extends CI_Model{

	public function insertCategoria($dados = null){

		if($dados != null){

			$this->db->insert('tb_categoria', $dados);

			$this->session->set_flashdata('cadastrook','Operação realizada com sucesso.');
			
			redirect('admin/categoria');
		}
	}
	
	/* Mostrar as categorias para um select html
	    Tras só categorias ativas
	 */
	public function getAllCategoria(){

		$this->db->from('tb_categoria');

		$this->db->order_by('nome');

		$this->db->where(array('ativo' => 1));

		return $this->db->get();
	}
	
	public function DropDownCategoria(){
		
		
		$this->db->from('tb_categoria');
		
		$result = $this->db->get();
		
		$return = array();

  		//Verifica se a quantidade de registros e maior que 0
  		if($result->num_rows > 0){

	   //Varivavel $return com o primeiro indice 0 com o valor 'Selecione'
	   //$return[''] = 'Selecione';
	
		   //Percore os valores 
		   foreach($result->result_array() as $row){
		    //O indice que será o id receberá o valor
		    $return[$row['idCategoria']] = $row['categoria'];
		   }
  		}

  		return $return;
	
	}
	   
	   //objeto impressão categoria de fotos
	   //Descrição e preço dos produtos.
	   
	public function getAllCategoriaView(){

		$this->db->from('tb_categoria');

		return $this->db->get();
	}
	
	public function getByIdCategoria($id = null){

		if($id != null){
			
			$this->db->where('idCategoria', $id);

			$this->db->limit(1);

			return $this->db->get('tb_categoria');
		}
	}

	public function getById($id = null){

		if($id != null){
			
			$this->db->where('id_categoria', $id);

			$this->db->limit(1);

			return $this->db->get('tb_categoria');
		}
	}

	public function getBySlug($slug = null){

		if($slug != null){
			
			$this->db->where('slug', $slug);

			$this->db->limit(1);

			return $this->db->get('tb_categoria');
		}
	}


	public function updateCategoria($dados = null, $condition = null){

		if($dados != null && $condition != null){

			$this->db->update('tb_categoria', $dados, $condition);

			$this->session->set_flashdata('edicaook', 'Alteração realizada com sucesso.');

			redirect('admin/categoria');
		}
	}

	public function inativarCategoria($id = null){
		if($id != null){
			$dados = array('ativo' => 0, 'dt_update' => date("Y-m-d H:i:s"));
			$condition = array('id_categoria' => $id);
			$this->db->update('tb_categoria', $dados, $condition);
			return true;

		}
	}

	public function ativarCategoria($id = null){
		if($id != null){
			$dados = array('ativo' => 1, 'dt_update' => date("Y-m-d H:i:s"));
			$condition = array('id_categoria' => $id);
			$this->db->update('tb_categoria', $dados, $condition);
			return true;

		}
	}
		
}