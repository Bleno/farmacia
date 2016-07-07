<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuario extends CI_Controller {

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
		$this->load->model('UsuarioModel');
		$this->load->library('Datatables');
	}


	public function index()
	{
		
		$dados = array(
		'pasta' =>'usuario',
		'view'  =>'cadastrar',
		'js' => array('dataTables/jquery.dataTables.min.js',
						'dataTables/jquery.dataTables.bootstrap.js',
						'js/usuario.js',),
		'css' => array('dataTables/dataTables.material.min.css',),
		);
	
		$this->load->view('admin', $dados);
	}


	public function cadastrar(){

		//$login = elements(array('email'), $this->input->post());
		//$email = elements(array('senha'), $this->input->post());
		
		$this->form_validation->set_rules('nome', 'nome', 'trim|required|max_length[45]|ucwords');
		$this->form_validation->set_rules('email', 'email', 'trim|required|max_length[45]|strtolower|is_unique[tb_usuario.email]');
		$this->form_validation->set_rules('senha', 'senha', 'trim|required|max_length[45]|matches[conf_senha]');
		$this->form_validation->set_rules('conf_senha', 'conf_senha', 'trim|required|max_length[45]');
		$this->form_validation->set_message('is_unique', "O Email ". $this->input->post('email') ." já existe!");
		$this->form_validation->set_message('matches', "As senhas precisam ser iguais!");


		if($this->form_validation->run()){

			$dados = elements(array('nome', 'email', 'senha'), $this->input->post());
			$dados['senha'] = md5($dados['senha']);
			$dados['dt_cadastro'] = date("Y-m-d H:i:s");
			$dados['dt_update'] = date("Y-m-d H:i:s");

		    $this->UsuarioModel->insertUsuario($dados);
		}else{
			$this->session->set_flashdata('erro', 'Campo(s) obrigatório(s) não preenchido(s)');
		}

        $dados = array(
			'pasta' => 'usuario',
			'view' => 'cadastrar',
			);
		$this->load->view('admin', $dados);


	}

	public function editar(){

		$this->form_validation->set_rules('nome', 'nome', 'trim|required|max_length[45]|ucwords');
		$this->form_validation->set_rules('senha', 'senha', 'trim|required|max_length[45]|matches[conf_senha]');
		$this->form_validation->set_rules('conf_senha', 'conf_senha', 'trim|required|max_length[45]');
		$this->form_validation->set_message('matches', "As senhas precisam ser iguais!");
			
		if($this->form_validation->run()){

			$update = elements(array('nome','senha'), $this->input->post());
			$update['senha']= md5($update['senha']);
			$update['dt_update'] = date("Y-m-d H:i:s");
						
			$this->UsuarioModel->updateUsuario($update, array('id_usuario' => $this->input->post('id_usuario')));
					
		}else{
			$this->session->set_flashdata('erro', 'Login já existe!EDIT');
		}
			
		$dados = array(
					'pasta' => 'usuario',
					'view' => 'editar',
					'js' => array('dataTables/jquery.dataTables.min.js',
					'dataTables/jquery.dataTables.bootstrap.js',
					'js/usuario.js',),
					'css' => array('dataTables/dataTables.material.min.css',),
		);

		$this->load->view('admin', $dados);
			
	}
	public function datatable(){
        $this->datatables->select('id_usuario, nome, email, dt_cadastro, dt_update')
            ->from('tb_usuario');
 
        echo $this->datatables->generate();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */