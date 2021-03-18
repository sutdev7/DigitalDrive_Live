<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Paypal extends CI_Controller{

	 function  __construct(){

		parent::__construct();
		// Load paypal library
		$this->load->library('paypal_lib');
		$this->load->model('Tasks');

	 }



	public function pay(){
		// Set variables for paypal form
		//echo "<pre>";print_r($_POST); exit();

		$cancelURL = base_url().'paypal/cancel'; //payment cancel url
		$notifyURL = base_url().'paypal/ipn'; //ipn url
		$task_id = $_POST['task_id'];
		$milestone_id = explode("-", $_POST['usertaskid_milestoneid'])[1];

		$payableamount = $_POST['payableamount'];
		$userID = !empty($this->session->userdata('user_id'))?$this->session->userdata('user_id'):1;
		$product = $this->Tasks->getTaskDataById($task_id);
		// echo'<pre>';print_r($product);exit;

		$returnURL = base_url().'paypal/success?item_number='.$task_id.'&custom='.$userID.'&milestone_id='.$milestone_id; //payment success url		
		// Add fields to paypal form
		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		$this->paypal_lib->add_field('item_name', $product->task_name);
		$this->paypal_lib->add_field('custom', $userID);
		$this->paypal_lib->add_field('item_number',  $product->task_id);
		$this->paypal_lib->add_field('amount', $payableamount);
		//echo'<pre>';print_r($this->paypal_lib);exit;
		// Render paypal form
		$this->paypal_lib->paypal_auto_form();

	}

	 

	public function success(){
		
		$insertId ="";
		$paypalInfo= $this->input->get();
		//print_r($paypalInfo); exit();
		$productData = $paymentData = array();
		$task_id = $paypalInfo['item_number'];
		$milestone_id = $paypalInfo['milestone_id'];

		if(!empty($paypalInfo['tx']) && !empty($paypalInfo['amt']) && !empty($paypalInfo['cc']) && !empty($paypalInfo['st'])){
			
			$orderData = array(				
				'task_id' => $paypalInfo['item_number'],
				'user_id' => $paypalInfo['custom'],
				'amount' => $paypalInfo["amt"],
				'currency_code' => $paypalInfo["cc"],
				'txn_id' => $paypalInfo["tx"],
				'milestone_id'=>$milestone_id,
				'payment_status' => 'yes',
				'payment_type' => 'paypal',
				'created_date' => date('Y-m-d H-i-s'),
                'updated_date' => date('Y-m-d H-i-s'),
			);

			// echo"<pre>";print_r($orderData);exit;

			$this->db->insert('payments', $orderData);
		    // echo $this->db->last_query();exit;
			$insertId = $this->db->insert_id();
			$data1 = array( 'hired_status' => 1);
			$this->db->where('task_id', $task_id);
			$this->db->update('task_hired', $data1);

			$data2 = array('task_status' => 1, 'task.task_hired' => 1, 'task_is_ongoing' => 1);
			$this->db->where('task_id', $task_id);
			$this->db->update('task', $data2);

			$updateArr = array(
		      'milestone_current_status' => 'AR',
		      'milestone_approval_date' => date('Y-m-d H-i-s'),
		      'milestone_dom' => date('Y-m-d H-i-s'),
		      'payment_status' => '1',
		    );
		    $this->db->where('milestone_id',$milestone_id);
		    $this->db->update('task_proposal_milestone',$updateArr);


		}

		$this->db->select('*');
        $this->db->from('payments');
		$this->db->join('task', 'task.task_id = payments.task_id');
		$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');
        $this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');
		$this->db->where(['payments.id'=> $insertId]);
		$result = $this->db->get();
		//echo $this->db->last_query();exit;
		// echo'<pre>';print_r($result->result());exit;
		if($result->num_rows() > 0){
			$parsedata1 = $result->result();
			$parsedata['result'] = $parsedata1;

			//Updating Notification 
			$freelancer_id = $parsedata1->freelancer_id;
			$task_query = $this->db->select('task.*')->from('task')->where('task_id',$task_id)->get();
		      if($task_query->num_rows() >0){
		        $task_info = $task_query->row();
		        $task_name = $task_info->task_name;
		        $user_task_id = $task_info->user_task_id;
		      }else{
		        $task_name = $user_task_id = '';
		      }
						
		    $job_details_link = '<a href="'.base_url().'hired-job-details/'.$user_task_id.'">'.$task_name.'</a>';

		      // check already hired  &  insert notification
			$checkData = $this->db->select('hired_id')->from('task_hired')->where('task_id',$task_id)->where('freelancer_id',$freelancer_id)->get();

		    if($checkData->num_rows() > 0){

		        $notidata = array(
		  		 'task_id' => $task_id,
		         'offer_id' => 0,
		         'notification_master_id' => 11,
		         'notification_from' => $this->session->userdata('user_id'),
		         'notification_to' => $freelancer_id,
		         'notification_details' => 'SEND HIRED ',
		         'notification_message' => '<strong>'.'<a href="'.base_url().'public-profile/'.$this->session->userdata('profile_id').'">'.$this->session->userdata('user_name').'</a></strong> wants to hire you for <strong> '.$job_details_link.' </strong>',
		         'notification_doc' => date('Y-m-d H:i:s')
		        );

		       // print_r($notidata); exit();		        
		        $this->db->insert('task_notification',$notidata);
		    }

		    }else{

			$parsedata['result'] = array();
		}

		$content = $this->parser->parse('account/payment_success',$parsedata,true);
		$data = array(
			'content' => $content,
			'title' => display('Sign Up As :: Hire-n-Work'),
		);
		//$this->template->full_website_html_view($data);
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

		$this->template->full_website_html_view($data);
	 }

	 

	 function ipn(){

		// Retrieve transaction data from PayPal IPN POST

		$paypalInfo = $this->input->post();
		// echo'<pre>';print_r($paypalInfo);exit;
		if(!empty($paypalInfo)){
			// Validate and get the ipn response
			$ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);
			// Check whether the transaction is valid
			if($ipnCheck){
				// Check whether the transaction data is exists
				$prevPayment = $this->payment->getPayment(array('txn_id' => $paypalInfo["txn_id"]));
				// print_r($prevPayment);exit;
				if(!$prevPayment){
					// Insert the transaction data in the database
					$data['user_id']	= $paypalInfo["custom"];

					$data['product_id']	= $paypalInfo["item_number"];

					$data['txn_id']	= $paypalInfo["txn_id"];

					$data['payment_gross']	= $paypalInfo["mc_gross"];

					$data['currency_code']	= $paypalInfo["mc_currency"];

					$data['payer_name']	= trim($paypalInfo["first_name"].' '.$paypalInfo["last_name"], ' ');

					$data['payer_email']	= $paypalInfo["payer_email"];

					$data['status'] = $paypalInfo["payment_status"];

					$this->payment->insertTransaction($data);

				}

			}

		}

	}

	

	function pay_subscription($taskid){
		// Set variables for paypal form

		
		$cancelURL = base_url().'paypal/cancel'; //payment cancel url
		$notifyURL = base_url().'paypal/ipn'; //ipn url
	
		$subscription_plan =$this->uri->segment(3);
		$userID =$this->uri->segment(4);

		$userdata = $this->db->get_where('users',['user_id'=>$userID]);
		if($userdata->num_rows() > 0){
			$UserR = $userdata->result_array();
			$custom = $userID; 


			$query = $this->db->get_where('subscription_plan',['id'=>$subscription_plan]);
			if($query->num_rows() > 0){

				$product = $query->result_array();
				// Add fields to paypal form
				$returnURL = base_url().'paypal/success_subscription?item_number='.$product[0]['id'].'&custom='.$custom; //payment success url
				$this->paypal_lib->add_field('return', $returnURL);
				$this->paypal_lib->add_field('cancel_return', $cancelURL);
				$this->paypal_lib->add_field('notify_url', $notifyURL);
				$this->paypal_lib->add_field('item_name', $product['name']);
				$this->paypal_lib->add_field('custom', $custom);
				$this->paypal_lib->add_field('item_number',  $product[0]['id']);
				$this->paypal_lib->add_field('amount',  $product[0]['price']);
				//$this->paypal_lib->add_field('plan_id',  $product[0]['id']);
				//$this->paypal_lib->add_field('plan_name',  $product[0]['name']);
				//$this->paypal_lib->add_field('client_id',  $userID);
				$this->paypal_lib->image("");

			  // echo'<pre>';print_r($this->paypal_lib);exit;
				// Render paypal form
				$this->paypal_lib->paypal_auto_form();



			} else{
				redirect($cancelURL);
			}
		} else{
			redirect($cancelURL);
		}
		
		
		//$userID = !empty($this->session->all_userdata()['user_id'])?$this->session->all_userdata()['user_id']:1;
		
		

	}



	public function success_subscription(){

		// echo 'hello success';exit;
		 //print_r($this->input->get());exit;
		// Get the transaction data
		$paypalInfo = $this->input->get();
		//print_r($paypalInfo);exit;
		
		$productData = $paymentData = array();
		$insertId ="";
	

		if(!empty($paypalInfo['tx']) && !empty($paypalInfo['amt']) && !empty($paypalInfo['cc']) && !empty($paypalInfo['st'])){

			$orderData = array(
				// 'product_id' => $postData['id'],
				//'buyer_name' => $name,
				// 'buyer_email' => $email,
				//'task_id' => $paypalInfo['item_number'],
				'user_id' => $paypalInfo["custom"],
				'amount' => $paypalInfo["amt"],
				'currency_code' => $paypalInfo["cc"],
				'txn_id' => $paypalInfo["tx"],
				'payment_status' => 'yes',
				'payment_type' => 'paypal',
				'created_date' => date('Y-m-d H-i-s'),
                'updated_date' => date('Y-m-d H-i-s')

			);

			// echo"<pre>";print_r($orderData);exit;

			$this->db->insert('payments', $orderData);
			//  echo $this->db->last_query();exit;
			$insertId = $this->db->insert_id();
			$data = array('subscription_plan' => $paypalInfo['item_number'],'status'=>1);
			$this->db->where('user_id', $paypalInfo["custom"] );
			$this->db->update('user_login', $data);
			// Get product info from the database
			// $productData = $this->product->getRows($item_number);
			// Check if transaction data exists with the same TXN ID
			// $paymentData = $this->payment->getPayment(array('txn_id' => $txn_id));
		}		

		// Pass the transaction data to view
		// $data['product'] = $productData;
		// $data['payment'] = $paymentData;
		// $this->load->view('paypal/success', $data);
		$this->db->select('*');
		$this->db->from('payments');
		$this->db->join('user_login', 'payments.user_id = user_login.user_id');
		$this->db->join('subscription_plan', 'subscription_plan.id = user_login.subscription_plan');
		$this->db->where(['payments.id'=> $insertId]);
		$result = $this->db->get();
		//echo $this->db->last_query();exit;
		//echo'<pre>';print_r($result->result());exit;
		if($result->num_rows() > 0){
			$parsedata['result'] = $result->result();
		}else{
			$parsedata['result'] = array();
		}
		$content = $this->parser->parse('account/payment_success',$parsedata,true);
		$data = array(
			'content' => $content,
			'title' => display('Success :: Hire-n-Work'),
		);

		$this->template->full_website_html_view($data);

	}

}