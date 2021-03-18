<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Account extends CI_Controller {

	function __construct() {

      	parent::__construct();
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');

		$this->load->library('Laccount');
        //$this->load->model('Accounts');
    }

    /*public function demoTest(){
    	//$this->load->helper('email_configure');
    	$this->load->library('email');
    	$smtp_user    = 'h_M4xbz7SfWztc0V4WqaOA';
        $smtp_pass    = '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';
    	
    	$from = 'asifali16078692@gmail.com';
    	$to = 'asif160@ymail.com';
    	$subject = 'Subject Test Email';
    	$message = 'This is demo test email';

    	$this->email->initialize(
    		array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtp.sendgrid.net',
			  //'smtp_host' => 'smtp.googlemail.com',
			  'smtp_user' => 'ok4KlbRaTreCjeJdXiSFiQ',
			  //'smtp_user' => 'W7uk4GCvSoOQgSIzC9hEiA',    Old New User
			  //'smtp_pass' => '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',   Old New Pass
			  'smtp_pass' => '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',
			  'smtp_port' => 587,
			  //'smtp_port' => 465,
			  'crlf' => "\r\n",
			  'newline' => "\r\n",
			  //'smtp_crypto' => "ssl"
			  'smtp_crypto' => "tls"
		));

		$this->email->from($from, 'Your Name');
		$this->email->to($to);
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');
		$this->email->send();

		echo $this->email->print_debugger();
    	//$emailStatus = sendGridEMail($from,$to,"","",$subject,$message); 
        
	}*/
		/*$config['protocol'] = 'sendmail';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 587;
		$config['smtp_user'] = $sender_email;
		$config['smtp_pass'] = $user_password;

		// Load email library and passing configured values to email library
		$this->load->library('email', $config);
		$this->email->set_newline("rn");

		// Sender email address
		$this->email->from($from, 'ASIF ALI');
		// Receiver email address
		$this->email->to($to);
		// Subject of email
		$this->email->subject($subject);
		// Message in email
		$this->email->message($body);

		if ($this->email->send()) {
			echo 'Email Successfully Send !';
		} else {
			show_error($this->email->print_debugger());
		}*/

        /*$this->load->library('email');
        //$cnfG['protocol']   =   "smtp";
        $cnfG['useragent']    = 'CodeIgniter';
        $cnfG['mailpath']     = "/usr/sbin/sendmail";
        $cnfG['protocol']     =   'mail';
        $cnfG['smtp_host']    = "ssl://smtp.googlemail.com";
        //$cnfG['smtp_host']    =   'smtp.gmail.com';
        //$cnfG['smtp_port']    =   '587';
        $cnfG['smtp_port']    =   '465';
        $cnfG['_smtp_auth']   =   TRUE;
        $cnfG['smtp_user']    =   'ins.welnext@gmail.com';
        $cnfG['smtp_pass']    =   'GWLCRM@jAtIn123';
        //$cnfG['_smtp_auth'] = TRUE;
        $cnfG['smtp_crypto'] = 'tls';
        $cnfG['send_multipart'] = FALSE;
        $cnfG['charset']      =   "utf-8";
        $cnfG['newline']      =   "\r\n";
        $cnfG['mailtype']     =   "html"; 
        $cnfG['validation']   =   TRUE;
        $cnfG['wordwrap'] = TRUE;
        
        $this->email->initialize($cnfG);
        //$this->email->set_newline("\r\n");
        
        $this->email->from('asifali16078692@gmail.com','Hire-n-Work');
        $this->email->to('asif160@ymail.com');
        $this->email->cc('asifali16078692@gmail.com');
        $this->email->subject('Thanks for submitting your details on MyCityOnline.co.in');
        $this->email->message('Thanks for submitting');
        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }*/
        /*//send email
        $this->load->library('email');
        $conG['protocol'] = 'mail';
		$conG['smtp_host'] = 'smtp.gmail.com';
		$conG['smtp_user'] = 'amardeepk3@gmail.com';
		$conG['smtp_pass'] = '9835251157';
		$conG['smtp_port'] = 587;
		$conG['mailtype'] = 'html';
		$conG['wordwrap'] = TRUE;
		$conG['newline'] = "\r\n"; 
		$conG['crlf'] = "\r\n";
		$conG['smtp_timeout'] = '120';
		$conG['smtp_crypto'] = 'tls';

        $this->email->initialize($conG);
		
		$this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($body);

		if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }*/
	

	public function index(){
		if($this->auth->is_logged()) {		

			if($this->session->userdata('user_type') == 1){
				redirect('admin/dashboard', 'refresh');
			}else{
				redirect('dashboard', 'refresh');
			}
        }

        $this->form_validation->set_rules('fldEmail','Username', 'trim|required');

        $this->form_validation->set_rules('fldPassword','Password', 'required');

        if($this->form_validation->run() == false){
		    $content = $this->laccount->sign_in_page();
		    $data = array(
	            'content' => $content,
	            'title' => display('Sign-in :: Hire-n-Work'),
            );
		    $this->template->full_website_html_view($data);
		}else{
           $this->laccount->check_user_validty();
	    }
	}

	public function gmail_login() {
		echo "In";die;
	}

	// start by amar
	public function sign_up_as_choose_membership(){
		$parsedata = array();
		$content = $this->parser->parse('account/subscription_plan_as_signup',$parsedata,true);
		$data = array(
	        'content' => $content,
	        'title' => display('Choose Membership :: Hire-n-Work'),
        );

		$this->template->full_website_html_view($data);	
	}

	// end by amar

	public function sign_up_as(){
		/*if($this->session->userdata('user_type') == 1){
			redirect('admin/dashboard', 'refresh');
		}else{
			redirect('dashboard', 'refresh');
		}*/
		// print_r($_POST['membership']);exit;

		$content = $this->laccount->sign_up_as_page();
		$data = array(
	        'content' => $content,
	        'title' => display('Sign Up As :: Hire-n-Work'),
        );
		$this->template->full_website_html_view($data);		
	}	

	public function sign_up(){
		/*if($this->session->userdata('user_type') == 1){
			redirect('admin/dashboard', 'refresh');
		}else{
			redirect('dashboard', 'refresh');
		}*/

		$content = $this->laccount->sign_up_page();
		$data = array(
	        'content' => $content,
	        'title' => display('Sign Up :: Hire-n-Work'),
        );

		$this->template->full_website_html_view($data);		
	}

	

	public function confirm_sign_up() {

		$this->form_validation->set_rules('fldPassword','Password', 'required|min_length[8]|xss_clean|callback_valid_password');
	    $this->form_validation->set_rules('username','Username', 'required|is_unique[user_login.username]');

		if($this->form_validation->run() == false){
			$content = $this->laccount->sign_up_page();
			$data = array(
				'content' => $content,
				'title' => display('Sign Up Confirmation :: Hire-n-Work'),
			);		

			$this->template->full_website_html_view($data);

		} else{

						
			$content = $this->laccount->confirm_sign_up();
            //$content1 = $this->laccount->confirm_email_admin_singhup($user_name);
			//echo"<pre>";print_r($content);exit;
			if(!empty($content) && $content['userId'] !=""){

				$userId = $content['userId'];
				$profile_id = $content['profile_id'];
				$subscription_plan = $content['subscription_plan'];
				$user_type = $content['user_type'];
				$user_name = $content['user_name'];
				if($subscription_plan == 1){					
					//redirect('sign-in','refresh');
					redirect('sign-up-success/'.$user_name, 'refresh');
				}else{ 
					redirect('subscription/payment/'.$subscription_plan.'/'.$userId, 'refresh');

				}

			} else{
				redirect('sign-up-as', 'refresh');	
			}
		}
	}

	public function sign_up_success(){
		$data['userEmail'] = $this->uri->segment(2);
		//print_r($data['userEmail']);exit;
		
		//print_r($content);exit;
		$content = $this->parser->parse('account/sign_up_success',$data,true);
		//$content= $this->load->view('account/sign_up_success',$data);
		$data = array(
			'content' => $content,
			'title' => display('Subscription :: Hire-n-Work'),
		);
		$this->template->full_website_html_view($data);

		//$this->load->view('account/sign_up_success',$data);
	}


	public function valid_password($password = '')

	{

		$password = trim($password);



		$regex_lowercase = '/[a-z]/';

		$regex_uppercase = '/[A-Z]/';

		$regex_number = '/[0-9]/';

		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';



		if (empty($password))

		{

			$this->form_validation->set_message('valid_password', 'The {field} field is required.');



			return FALSE;

		}



		if (preg_match_all($regex_lowercase, $password) < 1)

		{

			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');



			return FALSE;

		}



		if (preg_match_all($regex_uppercase, $password) < 1)

		{

			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');



			return FALSE;

		}



		if (preg_match_all($regex_number, $password) < 1)

		{

			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');



			return FALSE;

		}



		if (preg_match_all($regex_special, $password) < 1)

		{

			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character');



			return FALSE;

		}



		if (strlen($password) < 8)

		{

			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 8 characters in length.');



			return FALSE;

		}



		if (strlen($password) > 32)

		{

			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');



			return FALSE;

		}



		return TRUE;

	}



	public function forgot_password()

	{

		/*if($this->session->userdata('user_type') == 1){

			redirect('admin/dashboard', 'refresh');

		}else{

			redirect('dashboard', 'refresh');

		}*/



        $this->form_validation->set_rules('fldEmail','Email', 'trim|required');

        if($this->form_validation->run() == false){		

		    $content = $this->laccount->forgot_password_page();

		    $data = array(

			            'content' => $content,

			            'title' => display('Forgot Password :: Hire-n-Work'),

		            );

		    $this->template->full_website_html_view($data);

		}

		else{

           $this->laccount->send_new_password();

	    }			    		

	}	



	public function logout()

	{

		$content = $this->laccount->logout();	

	}	



	public function verify($hashcode)

	{

		

		$content = $this->laccount->confirm_email($hashcode);	

	}

	public function admin_veryfiri($hashcode){

		$content = $this->laccount->confirm_email_admin();	

	}	



	public function resend_confirmation($aId)

	{

		$content = $this->laccount->resend_verificatin_email($aId);	

	}



	public function thank_you_mail($aId)

	{

		$content = $this->laccount->thank_you_mail($aId);	

	}		

}

