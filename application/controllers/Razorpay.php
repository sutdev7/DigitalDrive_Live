<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  
class Razorpay extends CI_Controller {
  
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('form_validation','session'));
        $this->load->helper(array('url','html','form'));
             
     }
  
    public function index()
    {
        $this->load->view('razorpay');
    }   
    public function razorPaySuccess()
    { 
     $data = [
               'client_id' => $this->input->post('client_id'),
               'txn_id' => $this->input->post('razorpay_payment_id'),
               'amount' => $this->input->post('totalAmount'),
               'payment_type'=>$this->input->post('payment_type'),
               'task_id' => $this->input->post('task_id'),
               'payment_status' => 'yes',
               'created_date' => date('Y-m-d H-i-s'),
               'updated_date' => date('Y-m-d H-i-s'),
            ];
      $this->db->insert('payments', $data);
    //   echo $this->db->last_query();exit;
      $insertId = $this->db->insert_id();
      $data = array(
        'hired_status' => 1,
        );
        
        $this->db->where('task_id', $this->input->post('task_id'));
        $this->db->update('task_hired', $data);
        
        $data = array(
                'task_status' => 1,
                'task_is_ongoing' => 1,
        );
        
        $this->db->where('task_id', $this->input->post('task_id'));
        $this->db->update('task', $data);
        // check already hired
			// $checkData = $this->db->select('hired_id')->from('task_hired')->where('task_id',$task_id)->where('freelancer_id',$postValue['freelancer_id'])->get();
			
			// if($checkData->num_rows() == 0){
        // $job_details_link = '<a href="'.base_url().'hired-job-details/'.$user_task_id.'">'.$task_name.'</a>';
				
				// // insert notification
				// $notidata = array(
				// 	'task_id' => $task_id,
				// 	'offer_id' => 0,
				// 	'notification_master_id' => 11,
				// 	'notification_from' => $this->session->userdata('user_id'),
				// 	'notification_to' => $postValue['freelancer_id'],
				// 	'notification_details' => 'SEND HIRED ',
				// 	'notification_message' => '<strong>'.'<a href="'.base_url().'public-profile/'.$this->session->userdata('profile_id').'">'.$this->session->userdata('user_name').'</a></strong> wants to hire you for <strong> '.$job_details_link.' </strong>',
				// 	'notification_doc' => date('Y-m-d H:i:s')
				// );
        // $this->db->insert('task_notification',$notidata);
      //   return array('status' => TRUE, 'message' => 'Hire request has been sent successfully.');
			// }else{
			// 	return array('status' => FALSE, 'message' => 'Request has been sent already.');
			// }
     if($insertId > 0){
        $arr = array('msg' => 'Payment successfully credited', 'status' => true, 'id' => $insertId);  
        print_r(json_encode($arr));exit;
     }else{
                // echo $this->db->last_query();exit;
        $arr = array('msg' => 'Payment unsuccessfull', 'status' => false);  
        print_r(json_encode($arr));exit;
     }

    }
    
    public function RazorThankYou($id)
    {
     // $this->load->view('razorthankyou');
     
		// $result= $this->db->get_where('payments', ['id'=>$id]);
		$this->db->select('*');
    $this->db->from('payments');
    $this->db->join('task', 'task.task_id = payments.task_id');
    $this->db->join('task_hired', 'task_hired.task_id = payments.task_id');
        $this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');
    $this->db->where(['payments.id'=> $id]);
    // $this->db->join('user_login', 'user_login.user_id = users.user_id');
    // $this->db->join('country', 'country.country_id = users.country','left');
    // $this->db->order_by('user_login.unique_id','asc');
    $result = $this->db->get();
    //echo $this->db->last_query();exit;
    // echo'<pre>';print_r($result->result());exit;
    if($result->num_rows() > 0){
      $parsedata['result'] = $result->result();
    }else{
      $parsedata['result'] = array();
    }

     $content = $this->parser->parse('account/payment_success',$parsedata,true);
     $data = array(
                 'content' => $content,
                 'title' => display('Sign Up As :: Hire-n-Work'),
             );
     $this->template->full_customer_html_view($data);
    }

    function cancel(){
      // Load payment failed view
      $parsedata = array();
      $content = $this->parser->parse('account/payment_cancel',$parsedata,true);
      $data = array(
            'content' => $content,
            'title' => display('Sign Up As :: Hire-n-Work'),
          );
      $this->template->full_customer_html_view($data);
     }

     public function razorPaySubscription()
    { 
     $data = [
               'client_id' => $this->input->post('client_id'),
               'txn_id' => $this->input->post('razorpay_payment_id'),
               'amount' => $this->input->post('totalAmount'),
               'payment_type'=>$this->input->post('payment_type'),
               'paid_for' => $this->input->post('paid_for'),
               //'plan_id' => $this->input->post('plan_id'),
               'currency_code' => 'inr',
               'payment_status' => 'yes',
               'created_date' => date('Y-m-d H-i-s'),
               'updated_date' => date('Y-m-d H-i-s'),
            ];
      $this->db->insert('payments', $data);
      // echo $this->db->last_query();exit;
      $insertId = $this->db->insert_id();
      $data = array(
        'subscription_plan' => $this->input->post('plan_id'),
        );
        
        $this->db->where('user_id', $this->input->post('client_id'));
        $this->db->update('user_login', $data);
        
        
        // check already hired
			// $checkData = $this->db->select('hired_id')->from('task_hired')->where('task_id',$task_id)->where('freelancer_id',$postValue['freelancer_id'])->get();
			
			// if($checkData->num_rows() == 0){
        // $job_details_link = '<a href="'.base_url().'hired-job-details/'.$user_task_id.'">'.$task_name.'</a>';
				
				// // insert notification
				// $notidata = array(
				// 	'task_id' => $task_id,
				// 	'offer_id' => 0,
				// 	'notification_master_id' => 11,
				// 	'notification_from' => $this->session->userdata('user_id'),
				// 	'notification_to' => $postValue['freelancer_id'],
				// 	'notification_details' => 'SEND HIRED ',
				// 	'notification_message' => '<strong>'.'<a href="'.base_url().'public-profile/'.$this->session->userdata('profile_id').'">'.$this->session->userdata('user_name').'</a></strong> wants to hire you for <strong> '.$job_details_link.' </strong>',
				// 	'notification_doc' => date('Y-m-d H:i:s')
				// );
        // $this->db->insert('task_notification',$notidata);
      //   return array('status' => TRUE, 'message' => 'Hire request has been sent successfully.');
			// }else{
			// 	return array('status' => FALSE, 'message' => 'Request has been sent already.');
			// }
     if($insertId > 0){
        $arr = array('msg' => 'Payment successfully credited', 'status' => true, 'id' => $insertId);  
        print_r(json_encode($arr));exit;
     }else{
                // echo $this->db->last_query();exit;
        $arr = array('msg' => 'Payment unsuccessfull', 'status' => false);  
        print_r(json_encode($arr));exit;
     }

    }

    public function RazorSubscriptionSuccess($id)
    {
		$this->db->select('*');
    $this->db->from('payments');
    $this->db->join('user_login', 'payments.client_id = user_login.user_id');
    $this->db->join('subscription_plan', 'subscription_plan.id = user_login.subscription_plan');
    $this->db->where(['payments.id'=> $id]);
    $result = $this->db->get();
    // echo $this->db->last_query();exit;
    // echo'<pre>';print_r($result->result());exit;
    if($result->num_rows() > 0){
      $parsedata['result'] = $result->result();
    }else{
      $parsedata['result'] = array();
    }

     $content = $this->parser->parse('account/payment_success',$parsedata,true);
     $data = array(
                 'content' => $content,
                 'title' => display('Sign Up As :: Hire-n-Work'),
             );
     $this->template->full_customer_html_view($data);
    }
}