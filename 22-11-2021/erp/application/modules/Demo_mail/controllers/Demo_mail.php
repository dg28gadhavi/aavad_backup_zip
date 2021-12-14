<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo_mail extends CI_Controller {
	 
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('email');
		$this->load->model('sale_quotation_model');
	}
	 
	public function index()
	{
		$right_status = $this->check_rights('view');
		if($right_status == false)
		{
			$this->session->set_flashdata('rights_error', "You Don't have rights to access Demo_mail VIew functionality");
			redirect(base_url());
		}
		$this->data['main_content'] = 'Demo_mail_grid_view';
		$this->load->view('includes/template',$this->data);
	}
	
	function encrypt_decrypt($action, $string)
	{
	    $output = false;

	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'This is my secret key';
	    $secret_iv = 'This is my secret iv';

	    // hash
	    $key = hash('sha256', $secret_key);
	    
	    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	    $iv = substr(hash('sha256', $secret_iv), 0, 16);

	    if( $action == 'encrypt' ) {
	        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	        $output = base64_encode($output);
	    }
	    else if( $action == 'decrypt' ){
	        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	    }

	    return $output;
	}

	public function mail()
	{
	  //  echo "hiii";die;
	  	$uid = $this->encrypt_decrypt('decrypt',$this->session->userdata['miconlogin']['userid']);
				;
				$mailerdata = $this->sale_quotation_model->get_mailer_detail($uid);
			//	echo $mailerdata['au_gmail_password'];die;
		$path=str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']);
		$config = array();
		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.googlemail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'purchase@aavadinstrument.com';
		$config['smtp_pass']    = '19071991vandana';
		$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
		$config['validation'] = TRUE; // bool whether to validate email or not
		$message = '';
		
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('purchase@aavadinstrument.com'); 
		$this->email->to("darshandave792@gmail.com");
		$message="<h1>Okkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk</h1>";
		$this->email->subject("Mail Test");
		$this->email->message($message);
		$this->email->set_mailtype("html");
      	if($this->email->send())
     	{
     	    echo '11111111111111';die;
		      echo 'Email sent.';die;
		     //redirect(base_url());
	     }
	     else
	    {
	        echo '22222222222222222222';die;
	     show_error($this->email->print_debugger());
	    }
	    die;
	}

	



}?>