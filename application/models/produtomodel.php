<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ProdutoModel extends CI_Model{

	public function insertProduto($dados = null){

		if($dados != null){

			$this->db->insert('tb_produto', $dados);

			$this->session->set_flashdata('cadastrook','Operação realizada com sucesso.');

			redirect('admin/produto');
		}
	}
	

	public function getById($id = null){

		if($id != null){
			
			$this->db->where('idJaqueta', $id);

			$this->db->limit(1);

			return $this->db->get('tb_produto');
		}
	}
		
	public function detalhesProduto($id = null){
		if($id != null){

			$this->db->where('idJaqueta', $id);

			$this->db->limit(1);

			$this->db->select('idJaqueta ,jaqueta , quantidade, valor,tbjaqueta.descricao as detalhes ,  marca, cor, tamanho, categoria, imagem');
	
	
			$this->db->from('tb_produto');
	
			$this->db->order_by('jaqueta');
	
			$this->db->join('tbmarca', 'tbjaqueta.idMarca = tbmarca.idMarca', 'inner');
			$this->db->join('tbcor', 'tbjaqueta.idCor = tbcor.idCor ', 'inner');
		    $this->db->join('tbtamanho', 'tbjaqueta.idTamanho = tbtamanho.idTamanho', 'inner');
			$this->db->join('tbCategoria', 'tbjaqueta.idCategoria = tbCategoria.idCategoria', 'inner');
	
			return $this->db->get();
							
		}
	}
		

	
	public function getLojaJaqueta(){

     	$this->db->from('tb_produto');

		$this->db->order_by('Jaqueta');

		//$this->db->where('ativo', 1);

		return $this->db->get();
	
	
	}
	
	
	
	public function getAllProduto(){

		$this->db->select('idtb_produto,
							tb_produto.nome as nome,
							tb_produto.slug as slug,
							tb_produto.descricao as detalhes,
							tb_categoria.nome as categoria,
							tb_produto.dt_cadastro as cadastro,
							tb_produto.dt_update as atualizacao,
							tb_usuario.nome as usuario,
							imagem');


		$this->db->from('tb_produto');

		$this->db->order_by('nome');

		$this->db->join('tb_categoria', 'tb_produto.fk_categoria = tb_categoria.idtb_categoria', 'inner');
		$this->db->join('tb_usuario', 'tb_produto.fk_usuario = tb_usuario.id_usuario', 'inner');

		return $this->db->get();

/*//$this->db->join('tb_docente', 'tb_docente.id = ta_mapeamento.id_docente', 'inner');
inner join tbmarca on(tbjaqueta.idMarca = tbmarca.idMarca)
inner join tbcor on(tbjaqueta.idCor = tbcor.idCor )
inner join tbstatus on(tbjaqueta.idStatus = tbstatus.idStatus)
inner join tbtamanho on(tbjaqueta.idTamanho = tbtamanho.idTamanho)*/



	}



	public function JaquetasDisponiveis($id=null)
	{
		if($id != null){

			$query = $this->db->query("SELECT count(*) as quant FROM tbpedido where idJaqueta = $id");
			$row = $query->row();
			$quantPedido = $row->quant;

			$query2 = $this->db->query("SELECT quantidade  FROM tbjaqueta where idJaqueta = $id");
			$row2 = $query2->row();
			$quantJaqueta = $row2->quantidade;

			return $quantJaqueta - $quantPedido;
		}
	}


	public function getJaquetaByCategoria($idCategoria = null)
	{

		if($idCategoria != null){
		
			$this->db->where('idCategoria', $idCategoria);
			$this->db->from('tb_produto');

			$this->db->order_by('Jaqueta');

			//$this->db->where('ativo', 1);

			return $this->db->get();	
		}

	}
}