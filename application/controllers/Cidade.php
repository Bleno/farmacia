<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cidade extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 public function __construct(){
		parent::__construct();
		$this->load->model('ClienteModel');
		$this->load->model('CategoriaModel');
	}
	 
	 
	public function index()
	{
		
		$dados = array(
		'pasta' => 'lojaCliente',
		'view' => 'clienteCidade',
		'Estado' => $this->ClienteModel->getAllEstado()->result(),
		//'cidade' => $this->ClienteModel->getAllCidade()->result(),
		);
	
		$this->load->view('Principal', $dados);
	}
	
	public function Cadastrar(){

		$cidade = elements(array('cidade','idEstado'), $this->input->post());

		$this->form_validation->set_rules('cidade', 'Cidade', 'trim|required|max_length[45]|ucwords|]');
		//Seta uma mensagem se já existir no banco.
		$this->form_validation->set_message('is_unique', "O marca ". $cidade['cidade'] ." já existe.");

		//Verifica se o formmulário é válido
		if($this->form_validation->run()){

			//Pega os campos e recebe os valores do post
			$dados = elements(array('cidade','idEstado'), $this->input->post());

			//setando flagAtivo para True
			//$dados['flagAtivo'] = 1;

			$this->ClienteModel->insertCidade($dados);
		}else{
			$this->session->set_flashdata('erro', 'Marca já existe!');
		}

		/*$dados = array(
			'pasta' => 'lojaCliente',
			'view' => 'clienteCidade',
			 );
		$this->load->view('Principal', $dados);*/


	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */