<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/produtos
	 *	- or -  
	 * 		http://example.com/index.php/produtos/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/produtos/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct(){
		parent::__construct();
		$this->load->model('CategoriaModel');
		$this->load->model('ProdutoModel');
	}

	public function index(){
		$dados = array( 'pasta' => 'site/produtos',
						'view' => 'produtos',
						'categorias' => $this->CategoriaModel->getAllCategoria()->result(),
						'produtos'  => $this->ProdutoModel->getAllProduto()->result()
						 );
		$this->load->view('principal', $dados);
	}

}