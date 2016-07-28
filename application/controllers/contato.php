<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends CI_Controller {

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
	//
	//public function index(){

	//}
	//
	public function __construct(){
        parent::__construct();
    
        /* Load the libraries and helpers */
//        $this->load->driver("session");
        $this->load->helper('captcha');
    }
	  /* The default function that gets called when visiting the page */
	public function index(){
    
    /* Set a few basic form validation rules */
    $this->form_validation->set_rules('name', "Name", 'required');
    $this->form_validation->set_rules('captcha', "Captcha", 'required');
    
    /* Get the user's entered captcha value from the form */
    $userCaptcha = set_value('captcha');
    
    /* Get the actual captcha value that we stored in the session (see below) */
    $word = $this->session->userdata('captchaWord');
      
      
      
    /* Check if form (and captcha) passed validation*/
    if ($this->form_validation->run() == TRUE &&
        strcmp(strtoupper($userCaptcha),strtoupper($word)) == 0)
    {
      /** Validation was successful; show the Success view **/
      
      
      /* Clear the session variable */
      $this->session->unset_userdata('captchaWord');
      
      
      /* Get the user's name from the form */
      $name = set_value('name');
    
      /* Pass in the user input to the success view for display */
      $data = array('name' => $name);
      $this->load->view('success-view', $data);


    }
    else 
    {
      
      /** Validation was not successful - Generate a captcha **/
      
      /* Setup vals to pass into the create_captcha function */
      $vals = array(
        'img_path' => 'captcha/',
        'img_url' => base_url().'captcha/',
        );
        
      /* Generate the captcha */
      $captcha = create_captcha($vals);
      
      /* Store the captcha value (or 'word') in a session to retrieve later */
      $this->session->set_userdata('captchaWord', $captcha['word']);
      
      $dados = array('pasta' => 'site/contato', 'view' => 'contato');

      $dados = $dados + $captcha;
	     $this->load->view('principal', $dados);
	  
	  //echo $captcha['image'];
	  

      /* Load the captcha view containing the form (located under the 'views' folder) */
      //$this->load->view('principal', $captcha);

    }
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */