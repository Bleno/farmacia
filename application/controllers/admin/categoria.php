<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends CI_Controller {

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
		$this->load->model('CategoriaModel');
		$this->load->library('Datatables');
	}


	public function index()
	{
		
		$dados = array(
		'pasta' =>'categoria',
		'view'  =>'categoria',
		'js' => array('dataTables/jquery.dataTables.min.js',
						'dataTables/dataTables.materialize.js',
						'js/categoria.js',),
		'css' => array('dataTables/dataTables.materialize.css',),
		);
	
		$this->load->view('admin', $dados);
	}


	public function cadastrar(){

		$Categoria = elements(array('categoria'), $this->input->post());

		$this->form_validation->set_rules('categoria', 'Categoria', 'trim|required|max_length[45]|callback_slug_exists');//|is_unique[TbCategoria.categoria]

		//$this->form_validation->set_message('is_unique', "A descrição da". $Categoria['categoria'] ." já existe.");


		if($this->form_validation->run()){


			$dados = elements(array('categoria'), $this->input->post());

			$insert['nome'] = $dados['categoria'];
			$insert['slug'] = $this->slugify($dados['categoria']);
			$insert['dt_cadastro'] = date("Y-m-d H:i:s");
			$insert['dt_update'] = date("Y-m-d H:i:s");
			$insert['fk_usuario'] = $this->session->userdata('id_usuario');
			$insert['ativo'] = 1;

			$this->CategoriaModel->insertCategoria($insert);
		}else{
			$this->session->set_flashdata('erro', 'Categoria já existe!');
		}

		$dados = array(
			'pasta' => 'categoria',
			'view' => 'categoria',
			);
		//$this->load->view('admin', $dados);
		$this->index();



	}

	public function editar(){

		$this->form_validation->set_rules('categoria', 'Categoria', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('slug', 'slug', 'required');

		if($this->form_validation->run()){

			$dados = elements(array('categoria'), $this->input->post());
			$update['nome'] = $this->input->post('categoria');
			//$update['slug'] = $this->slugify($this->input->post('categoria'));
			$update['dt_update'] = date("Y-m-d H:i:s");

			$this->CategoriaModel->updateCategoria($update, array('slug' => $this->input->post('slug')));
		
		}else{
				$this->session->set_flashdata('erro', 'Categoria já existe!EDIT');
		}



		$dados = array(
					'pasta' => 'categoria',
					'view' => 'editar',
					'js' => array('dataTables/jquery.dataTables.min.js',
									'dataTables/jquery.dataTables.bootstrap.js',
									'js/categoria.js',),
					'css' => array('dataTables/dataTables.material.min.css',),
			 	);
		$this->load->view('admin', $dados);

	}
	
    public function datatable(){
        $this->datatables->select('id_categoria, tb_categoria.nome as categoria, slug, tb_categoria.dt_cadastro, tb_categoria.dt_update,tb_categoria.ativo as ativo ,tb_usuario.nome as usuario', TRUE)
            ->unset_column('id_categoria')
            ->join('tb_usuario', 'tb_categoria.fk_usuario = tb_usuario.id_usuario', 'join')
            ->from('tb_categoria');
 
        echo $this->datatables->generate();
    }


	//http://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
	static public function slugify($text){
  		// replace non letter or digits by -
  		$text = preg_replace('~[^\pL\d]+~u', '-', $text);

  		// transliterate
  		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  		// remove unwanted characters
  		$text = preg_replace('~[^-\w]+~', '', $text);

  		// trim
  		$text = trim($text, '-');

  		// remove duplicate -
  		$text = preg_replace('~-+~', '-', $text);

  		// lowercase
  		$text = strtolower($text);

  		if (empty($text)) {
  		  return 'n-a';
  		}

  		return $text;
	}


	public function slug_exists($str){
		$slug = $this->slugify($str);
		$query = $this->db->query("SELECT slug FROM tb_categoria WHERE slug = '$slug'");

		if ($query->num_rows() > 0){
			$this->form_validation->set_message('slug_exists', 'Essa categoria já existe!');
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function ativar(){
    	$id = $this->input->post('id_categoria');
    	$result = $this->CategoriaModel->ativarCategoria($id);
    	if($result){
    		echo "ATIVADO";
    	}else{
    		echo "ERROR";
    	}
    }

    public function inativar(){
    	$id = $this->input->post('id_categoria');
    	$result =  $this->CategoriaModel->inativarCategoria($id);
    	if($result){
    		echo "DELETED";
    	}else{
    		echo "ERROR";
    	}
    }

}//End class categoria
