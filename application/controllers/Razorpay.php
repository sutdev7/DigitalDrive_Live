<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

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
      $arr = [];
      if($this->input->post('usertaskid_milestoneid') != ""){
        $str = $this->input->post('usertaskid_milestoneid');
        $arr = explode('-',$str);
        $user_task_id = array_shift($arr);
      }

     $data = [

               'client_id' => $this->input->post('client_id'),
               'txn_id' => $this->input->post('razorpay_payment_id'),
               'amount' => $this->input->post('totalAmount'),
               'payment_type'=>$this->input->post('payment_type'),
               'task_id' => $this->input->post('task_id'),
               'milestone_id' => serialize($arr) ,
               'payment_status' => 'yes',
               'created_date' => date('Y-m-d H-i-s'),
               'updated_date' => date('Y-m-d H-i-s'),

            ];

      $this->db->insert('payments', $data);

      // echo $this->db->last_query();exit;

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

        // // project title
				// $task_query = $this->db->select('task.*')->from('task')->where('task_id',$this->input->post('task_id'))->get();
				// if($task_query->num_rows() >0){
				// 	$task_info = $task_query->row();
				// 	$task_name = $task_info->task_name;
				// 	$user_task_id = $task_info->user_task_id;
				// }else{
				// 	$task_name = $user_task_id = '';
				// }
        
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


    public function refund(){
      // curl -u <YOUR_KEY_ID>:<YOUR_KEY_SECRET> \
      // -X POST https://api.razorpay.com/v1/payments/pay_29QQoUBi66xm2f/refund \
      // -H 'Content-Type: application/json' \
      // -d '{
      //   "amount": 500100
      // }'

      // curl -u <YOUR_KEY_ID>:<YOUR_KEY_SECRET>
      // -X POST https://api.razorpay.com/v1/payments/pay_CeYgivxMLqdrKM/refund
      // -H "Content-Type: application/json"
      // -d '{
      //   "amount": 100,
      //   "speed": "optimum"
      // }'
      // var_dump((int)number_format(10.00,2));exit;
        $id=$this->uri->segment('3');
        $query=$this->db->get_where('payments',['id'=> $id]);
        $paymentsdata = $query->num_rows() > 0 ? $query->result_array(): [];
        //  echo'<pre>';print_r($paymentsdata);
         // exit;
      $url="https://api.razorpay.com/v1/payments/".$paymentsdata[0]["txn_id"]."/refund"; //pay_CeYgivxMLqdrKM
      $YOUR_KEY_ID='rzp_test_6zWahD2t7IjCvW';
      $YOUR_KEY_SECRET='VD3GNYIQqVgK13dXmv50hYxF';
      /*
      $data=[
              "amount"=> (int)number_format(10.00,2),//$paymentsdata[0]['amount'],
              // 'payment_id'=>$paymentsdata[0]['txn_id'],
              "speed"=>"optimum"
            ];
      $data = json_encode($data);
      // print_r($data);exit;

      $ch = curl_init();
      $curlConfig = array(
          CURLOPT_URL            => $url,
          CURLOPT_USERPWD => $YOUR_KEY_ID. ":".$YOUR_KEY_SECRET,
          CURLOPT_HTTPHEADER     => array('Content-Type: application/json'),
          CURLOPT_POST           => true,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POSTFIELDS     => $data,
          CURLOPT_SSL_VERIFYPEER => true,
      );
      curl_setopt_array($ch, $curlConfig);
      $result = curl_exec($ch);
      if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        }
      curl_close($ch);
      echo $result;exit;
*/

      $api = new Api($YOUR_KEY_ID, $YOUR_KEY_SECRET);
      try{
      $payment = $api->payment->fetch($paymentsdata[0]["txn_id"]);
      // $refund = $payment->refund();
        // (int)number_format($paymentsdata[0]['amount']* 100,2)
        
      $refund = $payment->refund(array('amount' => 1* 100 )); // for partial refund
      //  echo'<pre>';print_r($refund);
       //exit;
        }catch(Exception $e){
          // echo $e->getMessage();exit;
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">'.$e->getMessage().'</div>');
          redirect('earnings');
        }
        $amount = (string)((int)$refund['amount'] /100);
      $data = [
        'payments_id' => $paymentsdata[0]['id'],
        // 'client_id' => $paymentsdata['client_id'],
        'txn_id' => $refund['id'],
        'amount' =>  $amount,
        'payment_type'=>'Razor',
        'task_id' => $paymentsdata[0]['task_id'],
        'currency_code' => $refund['currency'],
        'payment_status' => $refund['entity'],
        'created_date' => date('Y-m-d H-i-s'),
        'updated_date' => date('Y-m-d H-i-s'),
      ];
      $this->db->insert('payments_withdra', $data);
      // echo $this->db->last_query();exit;
      $insertId = $this->db->insert_id();

      if($insertId > 0){
        $this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You have successfully widraw '.$refund['currency'].' '.$amount.' </div>');
        redirect('earnings');
      }else{
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Oops !! Smoething went wrong please contact to admin </div>');
        redirect('earnings');
      }

    }

    public function refund_request(){
      $id=$this->uri->segment('3');
      $query=$this->db->get_where('payments',['id'=> $id]);
      $paymentsdata = $query->num_rows() > 0 ? $query->result_array(): [];
      //  echo'<pre>';print_r($paymentsdata);exit;
      // $data = [
      //   'payments_id' => $paymentsdata[0]['id'],
      //   // 'client_id' => $paymentsdata['client_id'],
      //   'txn_id' => $paymentsdata[0]['txn_id'], //$refund['id'],
      //   'amount' =>  '',
      //   'payment_type'=>'Razor',
      //   'task_id' => $paymentsdata[0]['task_id'],
      //   // 'currency_code' => $refund['currency'],
      //   'payment_status' => 'processing',// $refund['entity'],
      //   'created_date' => date('Y-m-d H-i-s'),
      //   'updated_date' => date('Y-m-d H-i-s'),
      // ];
      // $this->db->insert('payments_withdra', $data);
      // // echo $this->db->last_query();exit;
      // $insertId = $this->db->insert_id();
      if($paymentsdata[0]['withdrawal_status'] != 'requested'){
      $this->db->update('payments',['withdrawal_status'=> 'requested','updated_date'=>date('Y-m-d H:i:s')],['id'=> $paymentsdata[0]['id'], 'withdrawal_status !='=> 'paid']);
      //  echo $this->db->last_query();exit;
      $updatedid = $this->db->affected_rows();
      }else{
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Already requested !! Contact to admin </div>');
        redirect('earnings');
      }

      if($updatedid > 0){
        $this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You have successfully requested for withdrawal </div>');
        redirect('earnings');
      }else{
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Already requested !! Contact to admin </div>');
        redirect('earnings');
      }
           
    }

    public function refund_request_admin(){
      $id=$this->uri->segment('3');
      $query=$this->db->get_where('payments',['id'=> $id]);
      $paymentsdata = $query->num_rows() > 0 ? $query->result_array(): [];

      // $this->db->update('payments',['withdrawal_status'=> 'paid','updated_date'=>date('Y-m-d H:i:s')],['id'=> $paymentsdata[0]['id']]);
      // $updatedid = $this->db->affected_rows();

      if($paymentsdata[0]['withdrawal_status'] != 'paid'){
        $this->db->update('payments',['withdrawal_status'=> 'paid','updated_date'=>date('Y-m-d H:i:s')],['id'=> $paymentsdata[0]['id'], 'withdrawal_status !='=> 'paid']);
        //  echo $this->db->last_query();exit;
        $updatedid = $this->db->affected_rows();
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Already paid</div>');
          redirect('earning');
        }

      if($updatedid > 0){
        $this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You have successfully paid for withdrawal </div>');
        redirect('earning');
      }else{
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Already paid </div>');
        redirect('earning');
      }
    }

    public function refund_request_coins(){
      $id=$this->uri->segment('3');
      $query=$this->db->get_where('user_login',['user_id'=> $id]);
      $data = $query->num_rows() > 0 ? $query->result_array(): [];
      $coinsforwithdraw = $this->uri->segment('4');
      // $remainingcoin = $data[0]['total_coins'] % 10 
      //  echo'<pre>';print_r($data);exit;//&& int($data[0]['total_coins'] >= 500
       if($data[0]['coins_withdrawal_status'] != 'requested' ){
        $this->db->update('user_login',['coins_withdrawal_status'=> 'requested','no_of_coins_withdrawal'=>$coinsforwithdraw,'modified'=>date('Y-m-d H:i:s')],
        ['user_id'=> $data[0]['user_id'], 'coins_withdrawal_status !='=> 'paid']);
        //  echo $this->db->last_query();exit;
        $updatedid = $this->db->affected_rows();
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Already requested !! Contact to admin </div>');
          redirect('wallets');
        }
  
        if($updatedid > 0){
          $this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You have successfully requested for withdrawal </div>');
          redirect('wallets');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Already requested !! Contact to admin </div>');
          redirect('wallets');
        }
    }

}