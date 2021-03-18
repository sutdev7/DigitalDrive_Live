<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtest extends CI_Controller {

	function __construct() {

      	parent::__construct();
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
    }

    public function demoTest(){
    	//$this->load->library('email');
    	
    	//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
    	$from = 'asif160@ymail.com';
    	$to = 'asifali16078692@gmail.com';
    	$subject = 'Subject Test Email';
    	$message = 'This is demo test email';
    	$this->load->helper('email_configure');
    	$returnData = sendGridEMail($from,$to,"","",$subject,$message,"","");
    	print_r($returnData);exit;
    	
    	/*$smtp_user    = 'h_M4xbz7SfWztc0V4WqaOA';
        $smtp_pass    = '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';*/
    	
    	/*$this->email->initialize(
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
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();

		echo $this->email->print_debugger(); */       
	}
}