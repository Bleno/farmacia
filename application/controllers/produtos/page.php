<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {

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
		$this->load->library("pagination");
	}

	public function index(){


		$this->pg();

	}



	public function pg(){

		$config = array();
        $config["base_url"] = base_url()."produtos/page/pg";
        $config["total_rows"] = $this->ProdutoModel->record_count();
        $config["per_page"] = 6;
        $config["uri_segment"] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li class="waves-effect">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active  indigo darken-4 white-text">';
		$config['cur_tag_close'] = '<li>';
		$config['prev_link'] = '<i class="material-icons">chevron_left</i>';
		$config['prev_tag_open'] = '<li class="waves-effect">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '<i class="material-icons">chevron_right</i>';
		$config['next_tag_open'] = '<li class="waves-effect">';
		$config['next_tag_close'] = '</li>';

		$config['first_tag_open'] = '<li class="waves-effect">';
		$config['first_link'] = 'Primeira';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="waves-effect">';
		$config['last_link'] = 'Última';
		$config['last_tag_close'] = '</li>';

		$config['use_page_numbers'] = TRUE;
        
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$dados = array( 'pasta' => 'site/produtos',
						'view' => 'produtos',
						'categorias' => $this->CategoriaModel->getAllCategoria()->result(),
						//'produtos'  => $this->ProdutoModel->getAllProduto()->result()
						 );
		$dados["produtos"] = $this->ProdutoModel->fetch_countries($config["per_page"], $page);
		$dados["links"] = $this->pagination->create_links();
		$this->load->view('principal', $dados);
	}
}