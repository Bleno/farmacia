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
						'dataTables/dataTables.materialize.js',
						'js/produto.js',),
		'css' => array('dataTables/dataTables.materialize.css',),
		);
	
		$this->load->view('admin', $dados);
	}
	
	public function cadastrar(){
				
		$this->form_validation->set_rules('fk_categoria', 'categoria', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('nome', 'produto', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('valor', 'valor', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('argumento', 'argumento', 'trim|max_length[45]');
		$this->form_validation->set_rules('descricao', 'descrição', 'trim|required');
		if(empty($_FILES['imagem']['name'])){
		    $this->form_validation->set_rules('imagem', 'imagem', 'required');
		}
			
		if($this->form_validation->run()){

			$dados = elements(array('fk_categoria','nome', 'valor', 'argumento','descricao','imagem'), $this->input->post());
			$dados['fk_usuario'] = $this->session->userdata('id_usuario');
			$dados['slug'] = $this->slugify($this->input->post('nome'));
			$dados['imagem'] = $this->upload_foto();
			$date = date("Y-m-d H:i:s");
			$dados['dt_cadastro'] = $date;
			$dados['dt_update'] = $date;
			$dados['ativo'] = 1;
	
			$this->ProdutoModel->insertProduto($dados);
		}else{
			$this->session->set_flashdata('erro', 'Produto já existe!');
		}

		// $dados = array(
		// 		'pasta' => 'produto',
		// 		'view' => 'produto',
		// 		'categorias' => $this->CategoriaModel->getAllCategoria()->result(),
		// 		 );
		// $this->load->view('admin', $dados);
		$this->index();
			
	}

	public function editar(){

		$this->form_validation->set_rules('fk_categoria', 'categoria', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('nome', 'produto', 'trim|required|max_length[45]');
		$this->form_validation->set_rules('valor', 'valor', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('argumento', 'argumento', 'trim|max_length[45]');
		$this->form_validation->set_rules('descricao', 'descrição', 'trim|required');
			
		if($this->form_validation->run()){

			$update = elements(array('fk_categoria','nome', 'valor', 'argumento','descricao'), $this->input->post());
			$update['fk_usuario'] = $this->session->userdata('id_usuario');
			$update['slug'] = $this->slugify($this->input->post('nome'));
			if(!empty($_FILES['imagem']['name'])){
				$this->delete_file($this->input->post('id_produto'));
				$update['imagem'] = $this->upload_foto();
			}
			$update['dt_update'] = date("Y-m-d H:i:s");
	
			$this->ProdutoModel->updateProduto($update, array('id_produto'=> $this->input->post('id_produto') ));
		}else{
			$this->session->set_flashdata('erro', 'Produto já existe!');
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
						'dataTables/dataTables.materialize.js',
						'js/produto.js',),
		'css' => array('dataTables/dataTables.materialize.css',),
		);
		$this->load->view('admin', $dados);

	}

	function upload_foto(){
		$config['upload_path'] = './produtos_images';
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
			$img = $this->resize_image($data['upload_data']['file_name'], 295, 240);

			error_log($img);
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
        						 tb_produto.valor as valor,
        						 argumento,
        						 descricao,
        						 tb_usuario.nome as usuario,
        						 tb_produto.ativo as ativo,
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


    public function get_descricao(){

    	$id = $this->uri->segment(4);
    	$result = $this->ProdutoModel->get_descricao($id)->row();
    	echo $result->descricao;
    }

    public function get_argumento(){

    	$id = $this->uri->segment(4);
    	$result = $this->ProdutoModel->get_argumento($id)->row();
    	if($result->argumento != ""){
    		echo $result->argumento;
    	}else{
    		echo "Não há argumento para este produto";
    	}
    }

    /*
    	Redimenciona imagem
    	$img = resize_image(‘/path/to/some/image.jpg’, 200, 200);
     */
    private function resize_image($file, $w, $h, $crop=FALSE) {
	    list($width, $height) = getimagesize($file);
	    $r = $width / $height;
	    if ($crop) {
	        if ($width > $height) {
	            $width = ceil($width-($width*abs($r-$w/$h)));
	        } else {
	            $height = ceil($height-($height*abs($r-$w/$h)));
	        }
	        $newwidth = $w;
	        $newheight = $h;
	    } else {
	        if ($w/$h > $r) {
	            $newwidth = $h*$r;
	            $newheight = $h;
	        } else {
	            $newheight = $w/$r;
	            $newwidth = $w;
	        }
	    }
	    $src = imagecreatefromjpeg($file);
	    $dst = imagecreatetruecolor($newwidth, $newheight);
	    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	    return $dst;
	}

    private function delete_file($id = null){
    	//$this->load->helper('file');
    	if($id != null){
    		$produto = $this->ProdutoModel->getById($id)->row();
    		$path = './produtos_images/'.$produto->imagem;
    		error_log($path);
    		unlink($path);
    	}
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
    	$id = $this->input->post('id_produto');
    	$result = $this->ProdutoModel->ativarProduto($id);
    	if($result){
    		echo "ATIVADO";
    	}else{
    		echo "ERROR";
    	}
    }

    public function inativar(){
    	$id = $this->input->post('id_produto');
    	$result =  $this->ProdutoModel->inativarProduto($id);
    	if($result){
    		echo "DELETED";
    	}else{
    		echo "ERROR";
    	}
    }

    public function delete(){
    	$this->delete_file($this->input->post('id_produto'));
    	$result = $this->ProdutoModel->deleteProduto($this->input->post('id_produto'));
    	if($result){
    		echo "DELETED";
    	}else{
    		echo "ERROR";
    	}
    }

} //Fim class


       
	
	