<?php 
/* Faz a união dos arquivos que estão separados */
/* 
	Verifica se a sessão existe 
	Se existir mostra o admin com seu conteudo e as outras view
	Se não redireciona para a tela de login
*/
//if($this->session->userdata('is_logged_in') && $this->session->userdata('nivelAcesso') == 2){

	//Inclue o arquivo de cabeçalho
	$this->load->view('admin/header');

	//Inclue o arquivo de corpo
	$this->load->view('admin/body');

	//Inclue o arquivo que for chamado pela controladora
	if($pasta != '') $this->load->view('admin/'.$pasta .'/'. $view);
	if($pasta != '' && $pasta !== "inicio") $this->load->view('admin/'.$pasta .'/listagem');

	//Inclue o arquivo de rodapé
	$this->load->view('admin/footer');

//}else if($this->session->userdata('is_logged_in') && $this->session->userdata('nivelAcesso') == 1){
	//Não descomentar//$this->session->set_flashdata('loginInvalido', 'Usuário ou Senha invalidos.');
//	redirect('Principal');
//}else{
	//redirect('admin/login');
//}
?>



