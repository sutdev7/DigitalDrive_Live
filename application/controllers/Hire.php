<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Hire extends CI_Controller {

	function __construct() {

      	parent::__construct();

		header('Cache-Control: no-cache, must-revalidate, max-age=0');

		header('Cache-Control: post-check=0, pre-check=0',false);

		header('Pragma: no-cache');

		$this->load->library('Lhire');
		// Load Stripe library 
		$this->load->library('stripe_lib'); // Added by Amar
		$this->load->library('Lfreelancer'); // Added  by Amar
    }


	public function refundRequest(){
		$milestone_id = $this->uri->segment(3);
		$user_id = $this->session->userdata('user_id');
		$milestone_id = base64_decode($milestone_id);
		$this->load->model('Hires');
		$paymentdetails = $this->Hires->getPaymentDetails($milestone_id,"");

		if(!empty($paymentdetails) && $paymentdetails !=false){

			$payment_type = $paymentdetails[0]['payment_type'];
			$txn_id = $paymentdetails[0]['txn_id'];
			$hired_id = base64_encode($paymentdetails[0]['hired_id']);
			$refund_status =['withdrawal_status'=>'Canceled','refund_status'=>'requested','refund_request_at'=>date('Y-m-d H:i:s'),'refund_request_by'=>$user_id];
			
			$Pwhere =['milestone_id'=>$milestone_id,'txn_id'=>$txn_id];
			$this->db->update('payments',$refund_status,$Pwhere);
			$updatedid = $this->db->affected_rows();
			if($updatedid){
				$this->form_validation->set_rules('msg', 'Your milestone payment Refund requeste send Successfull');
				$updatemilstone = ['milestone_current_status'=>'CM','milestone_status'=>'Canceled','payment_status'=>'Refund'];
				$Mwhere =['milestone_id'=>$milestone_id];
				$this->db->update('task_proposal_milestone',$updatemilstone,$Mwhere);
				redirect('view-contract/'.$hired_id);	
			} else{
				redirect('view-contract/'.$hired_id);
			}
		} else{
			$redirect = $_SERVER['HTTP_REFERER'];
			redirect($redirect);
		}

		//echo "<pre>"; print_r($paymentdetails); exit();

	}

	

	public function direct_hire($pageIndex = 0){

		

    	$content = $this->lhire->hire($this->session->all_userdata());

		$data = array(

					'content' => $content,

					'title' => display('Direct Hire :: Hire-n-Work'),

				);		

		$this->template->full_customer_html_view($data);

    }

	

	public function add_direct_hire_step1(){



		$data = array();

        		

		$this->form_validation->set_rules('contract_title','Contract Title','required');
		//	$this->form_validation->set_rules('fldJobTitle','Select Task','required');
		$this->form_validation->set_rules('terms','Hired Terms','required');
		$this->form_validation->set_rules('deposit','Deposit','required');
		//	$this->form_validation->set_rules('fldJobTitle', 'Job Title','required', 'callback_jobtitle_check['.$_REQUEST['fldJobTitle'],$_REQUEST['freelancer_id'].']');
	 	$this->form_validation->set_rules('fldJobTitle', 'Job Title', 'required|callback_jobtitle_check[' .$_REQUEST['fldJobTitle']. ']');
		$submitData = $this->input->post(); 
        if($this->form_validation->run() == false){ 
	        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">'.validation_errors().'</div>');
		 	redirect('search-freelancer');
		}else{      	

        	$this->lhire->add_direct_hire($submitData);

	    }

		

	}

	

	public function add_hire_step1(){



		$data = array();

        		

		$this->form_validation->set_rules('contract_title','Contract Title','required');
	//	$this->form_validation->set_rules('fldJobTitle','Select Task','required');
		$this->form_validation->set_rules('terms','Freelancer Terms','required');
	 // $this->form_validation->set_rules('deposite_milestone','Deposit','required');
		//$this->form_validation->set_rules('fldJobTitle', 'Job Title','required',  'callback_jobtitle_check['.$_REQUEST['fldJobTitle'],$_REQUEST['freelancer_id'].']');

	 	$this->form_validation->set_rules('fldJobTitle', 'Job Title', 'required|callback_jobtitle_check[' .$_REQUEST['fldJobTitle']. ']');
		$submitData = $this->input->post(); 
		//echo "<pre>"; print_r($submitData); exit();

		if($this->form_validation->run() == false){ 
	        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">'.validation_errors().'</div>');
		 	redirect('search-freelancer');
		}else{ 
        	$this->lhire->add_hire($submitData);
        }		

	}

	

	public function jobtitle_check($fldJobTitle)

	{

		

		//echo $fldJobTitle;

	//	 echo "<br/>";

		 $notification_from=$_REQUEST['freelancer_id'];

		 $notification_to=$this->session->userdata("user_id");

		 

		/*  echo "SELECT * FROM task_notification JOIN task ON task_notification.task_id=task.task_id WHERE notification_master_id=15 AND notification_from='".$notification_from."' AND notification_to='".$notification_to."' AND task.user_task_id='".$fldJobTitle."'";  */

	

		  $q=$this->db->query("SELECT * FROM task_notification JOIN task ON task_notification.task_id=task.task_id WHERE notification_master_id=15 AND notification_from='".$notification_from."' AND notification_to='".$notification_to."' AND task.user_task_id='".$fldJobTitle."'");

		  $r=$q->num_rows();



		 if($r>0){

			 $this->form_validation->set_message('jobtitle_check', 'Freelancer already rejected the selected task.You cannot hire. Please try another task');

			 return FALSE;

		 }else{

			return TRUE;

		 }

		  

		 

		 exit;

		//	$this->form_validation->set_message('username_check', 'The %s field can not be the word "test"');

		//	return FALSE;

	 

	}

	

	

	public function direct_hire_step2($pageIndex = 0){

		

    	$content = $this->lhire->direct_hire_step2($this->session->all_userdata());

		$data = array(

					'content' => $content,

					'title' => display('Direct Hire :: Hire-n-Work'),

				);		

		$this->template->full_customer_html_view($data);

    }

	

	public function hire_step2($pageIndex = 0){
		$content = $this->lhire->hire_step2($this->session->all_userdata());
		$data = array(
			'content' => $content,
			'title' => display('Direct Hire :: Hire-n-Work'),
		);
		$this->template->full_customer_html_view($data);
	}



	public function hire_freelancer(){

		$content = $this->lhire->hire_freelancers($this->session->all_userdata());
		$data = array(
			'content' => $content,
			'title' => display('Direct Hire :: Hire-n-Work'),
		);		

		$this->template->full_customer_html_view($data);

	}



	public function direct_hire_freelancer(){
		$FR_id = $this->uri->segment(2);
		
		$content = $this->lhire->direct_hire_freelancers($FR_id, $this->session->all_userdata());
		$data = array(
			'content' => $content,
			'title' => display('Direct Hire :: Hire-n-Work'),
		);		
		$this->template->full_customer_html_view($data);
	}

	

	public function rehire_freelancer(){

		$content = $this->lhire->rehire_freelancers($this->session->all_userdata());

		$data = array(

					'content' => $content,

					'title' => display('Rehire :: Hire-n-Work'),

				);		

		$this->template->full_customer_html_view($data);

	}

	

	public function view_contract(){

		$content = $this->lhire->view_contract($this->uri->segment(2),$this->uri->segment(3));

		$data = array(
			'content' => $content,
			'title' => display('View Contract :: Hire-n-Work'),
		);		
		$this->template->full_customer_html_view($data);

	}

	

	public function release_approve(){

		$content = $this->lhire->release_approve($this->uri->segment(2));
		$data = array(
			'content' => $content,
			'title' => display('Release Approve:: Hire-n-Work'),
		);		

		$this->template->full_customer_html_view($data);

	}

	

	public function submit_release_approve(){

		$this->lhire->submit_release_approve();

	}

	

	public function ajax_change_milestone_date(){ 

		echo $this->lhire->ajax_change_milestone_date();

	}

	

	public function ajax_add_new_milestone(){ 

		echo $this->lhire->ajax_add_new_milestone();

	}

	

	public function close_contract(){ 
		$content = $this->lhire->close_contract_page($this->uri->segment(2));
		// echo'<pre>';print_r($content);exit;
		$data = array(
			'content' => $content,
			'title' => display('Release Approve:: Hire-n-Work'),
		);		
		$this->template->full_customer_html_view($data);
	}

	public function save_problem_ticket(){
		if(!empty($_POST) && is_array($_POST)){
			
			$ll = $this->lfreelancer->add_ticket($this->session->all_userdata());

		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Unable to generate ticket. Please try again.</div>');
			$ll = false;
		}

		redirect('close-contract/'.base64_encode($_POST['hired_id']), 'refresh');

		/*$this->form_validation->set_rules('grievance_id','Issue Type', 'required');

        $this->form_validation->set_rules('grievance_content','Description','required');       



        if($this->form_validation->run() == false){ 

			$this->lfreelancer->add_ticket($this->session->all_userdata());

		}

		redirect('close-contract/Nw==');*/

	}

	

	public function submit_close_contract(){

		$this->lhire->submit_close_contract();

	}



	#Abhishek

	public function hire_freelancer_rehire($freelancer_id){
		$content = $this->lhire->hire_freelancers_rehire($freelancer_id,$this->session->all_userdata());
		$data = array(
			'content' => $content,
			'title' => display('Direct Hire :: Hire-n-Work'),
		);		

		$this->template->full_customer_html_view($data);

	}

	

}