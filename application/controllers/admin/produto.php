<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produto extends CI_Controller {
		
	public function __construct(){
		parent::__construct();
		$this->load->model('ProdutoModel');
		$this->load->model('CategoriaModel');
		$this->load->library('Datatables');
	}


	public function index()
	{
		
		$dados = array(
		'pasta' =>'produto',
		'view'  =>'produto',
		'categorias'  => $this->CategoriaModel->getAllCategoria()->result(),
		'js' =>  array('ckeditor/ckeditor.js',
						'ckeditor/samples/js/sample.js',
						'ckeditor/config.js',
						'ckeditor/lang/pt-br.js',
						'ckeditor/styles.js',
						'dataTables/jquery.dataTables.min.js',
						'dataTables/jquery.dataTables.bootstrap.js',
						'js/produto.js',),
		'css' => array('dataTables/dataTables.material.min.css',),
		);
	
		$this->load->view('admin', $dados);
	}
	
	public function cadastrar(){
				
		$this->form_validation->set_rules('nome', 'nome', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('descricao', 'descricao', 'trim|required');
		$this->form_validation->set_rules('fk_categoria', 'fk_categoria', 'required|is_natural_no_zero');
			
		if($this->form_validation->run()){

			$dados = elements(array('nome','descricao','fk_categoria','imagem'), $this->input->post());
			$dados['fk_usuario'] = $this->session->userdata('id_usuario');
			$dados['slug'] = $this->slugify($this->input->post('nome'));
			$dados['imagem'] = $this->upload_foto();
			$dados['dt_cadastro'] = date("Y-m-d H:i:s");
			$dados['dt_update'] = date("Y-m-d H:i:s");
	
			$this->ProdutoModel->insertProduto($dados);
		}else{
			$this->session->set_flashdata('erro', 'Produto já existe!');
		}

		$dados = array(
				'pasta' => 'produto',
				'view' => 'produto',
				'produtos' => $this->ProdutoModel->getAllProduto()->result(),
				'categorias' => $this->CategoriaModel->getAllCategoria()->result(),
				 );
		$this->load->view('admin', $dados);
			
	}

	public function editar(){

		$this->form_validation->set_rules('Jaqueta', 'Jaqueta', 'trim|required|max_length[45]|strtolower|ucwords');
		$this->form_validation->set_rules('idJaqueta', 'idJaqueta', 'required');

			if($this->form_validation->run()){
				
				$dados = elements(array('marca','flagAtivo'), $this->input->post());

				$this->MarcaModel->updateMarca($dados, array('idJaqueta' => $this->input->post('idJaqueta')));

		}else{
			$this->session->set_flashdata('erro', 'Jaqueta já existe!');
		}

			
		$dados = array(
		'pasta' => 'produto',
		'view' => 'editar',
		'categorias'  => $this->CategoriaModel->getAllCategoria()->result(),
		'js' =>  array('ckeditor/ckeditor.js',
						'ckeditor/samples/js/sample.js',
						'ckeditor/config.js',
						'ckeditor/lang/pt-br.js',
						'ckeditor/styles.js',
						'dataTables/jquery.dataTables.min.js',
						'dataTables/jquery.dataTables.bootstrap.js',
						'js/produto.js',),
		'css' => array('dataTables/dataTables.material.min.css',),
		);
		$this->load->view('admin', $dados);

	}

	function upload_foto(){
		$config['upload_path'] = './produtos';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['encrypt_name'] = true;		
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('imagem')){
			$error = array('error' => $this->upload->display_errors());			
			print_r($error);
			exit();
		}	
		else{
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
		}
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

	public function datatable(){
        $this->datatables->select('id_produto,
        						 imagem,
        						 tb_produto.nome,
        						 tb_categoria.nome as categoria,
        						 tb_produto.slug as slug,
        						 tb_produto.valor_venda as valor,
        						 argumento,
        						 descricao,
        						 tb_usuario.nome as usuario,
        						 tb_produto.dt_cadastro as dt_cadastro,
        						 tb_produto.dt_update as dt_update', TRUE)
            ->unset_column('id_produto')
            //->order_by('tb_produto.nome')
            ->join('tb_usuario', 'tb_produto.fk_usuario = tb_usuario.id_usuario', 'join')
            ->join('tb_categoria', 'tb_produto.fk_categoria = tb_categoria.id_categoria', 'join')
            ->from('tb_produto');
 		header('Content-Type: application/json');
        echo $this->datatables->generate();
    }


}


       
	
	