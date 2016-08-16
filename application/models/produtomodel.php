<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProdutoModel extends CI_Model{

	public function insertProduto($dados = null){

		if($dados != null){

			$this->db->insert('tb_produto', $dados);

			$this->session->set_flashdata('cadastrook','Operação realizada com sucesso.');

			redirect('admin/produto');
		}
	}

	public function updateProduto($dados = null, $condition = null){

		if($dados != null && $condition != null){

			$this->db->update('tb_produto', $dados, $condition);

			$this->session->set_flashdata('edicaook', 'Alteração realizada com sucesso.');

			redirect('admin/produto');
		}
	}
	

	public function getById($id = null){

		if($id != null){
			
			$this->db->where('id_produto', $id);

			$this->db->limit(1);

			return $this->db->get('tb_produto');
		}
	}

	public function get_descricao($id = null){
		if($id != null){
			$this->db->where('id_produto', $id);
			$this->db->select('descricao');
			$this->db->from('tb_produto');
			return $this->db->get();
		}
	}

	public function get_argumento($id = null){
		if($id != null){
			$this->db->where('id_produto', $id);
			$this->db->select('argumento');
			$this->db->from('tb_produto');
			return $this->db->get();
		}
	}
		
	public function getBySlug($slug = null){

		if($slug != null){
			
			$this->db->where('slug', $slug);

			$this->db->limit(1);

			return $this->db->get('tb_produto');
		}
	}
			
	/*
	  Pega o produto por uma determinada categoria
	 */
	public function getProdutoByCategoria($id_categoria){

		$this->db->select('id_produto,
							tb_produto.nome as nome,
							tb_produto.slug as slug,
							tb_produto.descricao as detalhes,
							tb_categoria.nome as categoria,
							tb_produto.dt_cadastro as cadastro,
							tb_produto.dt_update as atualizacao,
							tb_categoria.slug as categoria_slug,
							argumento,
							valor,
							imagem');
		$this->db->from('tb_produto');
		$this->db->order_by('nome');
		$this->db->join('tb_categoria', 'tb_produto.fk_categoria = tb_categoria.id_categoria', 'inner');

		$this->db->order_by('tb_produto.nome');

		$this->db->where('fk_categoria', $id_categoria);
		$this->db->where('tb_produto.ativo', 1);

		return $this->db->get();
	}
	
	
	
	public function getAllProduto(){

		$this->db->select(' id_produto,
							tb_produto.nome as nome,
							tb_produto.slug as slug,
							tb_produto.descricao as detalhes,
							tb_categoria.nome as categoria,
							tb_produto.dt_cadastro as cadastro,
							tb_produto.dt_update as atualizacao,
							tb_categoria.slug as categoria_slug,
							argumento,
							valor,
							imagem');
		$this->db->from('tb_produto');
		$this->db->order_by('nome');
		$this->db->join('tb_categoria', 'tb_produto.fk_categoria = tb_categoria.id_categoria', 'inner');

		$this->db->order_by('tb_produto.nome');

		//$this->db->where('fk_categoria', $id_categoria);
		$this->db->where('tb_produto.ativo', 1);

		return $this->db->get();
	}


	public function inativarProduto($id = null){
		if($id != null){
			$dados = array('ativo' => 0, 'dt_update' => date("Y-m-d H:i:s"));
			$condition = array('id_produto' => $id);
			$this->db->update('tb_produto', $dados, $condition);
			return true;

		}
	}

	public function ativarProduto($id = null){
		if($id != null){
			$dados = array('ativo' => 1, 'dt_update' => date("Y-m-d H:i:s"));
			$condition = array('id_produto' => $id);
			$this->db->update('tb_produto', $dados, $condition);
			return true;

		}
	}

	public function deleteProduto($id=null){
		if ($id != null) {
			$this->db->where('id_produto', $id);
			$this->db->delete('tb_produto');
			return true;
		}
	}



	//Destinado a paginação no codeigniter
    public function record_count() {
        return $this->db->count_all("tb_produto");
    }


    public function fetch_countries($limit, $start) {
        $this->db->limit($limit, $start);

        $this->db->select(' id_produto,
							tb_produto.nome as nome,
							tb_produto.slug as slug,
							tb_produto.descricao as detalhes,
							tb_categoria.nome as categoria,
							tb_produto.dt_cadastro as cadastro,
							tb_produto.dt_update as atualizacao,
							tb_categoria.slug as categoria_slug,
							argumento,
							valor,
							imagem');
		#$this->db->from('tb_produto');
		$this->db->order_by('nome');
		$this->db->join('tb_categoria', 'tb_produto.fk_categoria = tb_categoria.id_categoria', 'inner');

		$this->db->order_by('tb_produto.nome');

		$this->db->where('tb_produto.ativo', 1);
        $query = $this->db->get("tb_produto");

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
}