<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends CI_Controller{
	
	 function  __construct(){
		parent::__construct();
		
		// Load paypal library
		$this->load->library('paypal_lib');

		$this->load->model('Tasks');
	 }

	 function pay($taskid){

		// Set variables for paypal form
		$returnURL = base_url().'paypal/success'; //payment success url
		$cancelURL = base_url().'paypal/cancel'; //payment cancel url
		$notifyURL = base_url().'paypal/ipn'; //ipn url
		
		// Get product data from the database
		// $product = $this->product->getRows($id);
		// echo $this->uri->segment(3);exit;

		$product = $this->Tasks->getTaskDataById($this->uri->segment(3));
		// echo'<pre>';print_r($product);exit;
		
		// Get current user ID from the session (optional)
		$userID = !empty($this->session->all_userdata()['user_id'])?$this->session->all_userdata()['user_id']:1;
		
		// Add fields to paypal form
		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		// $this->paypal_lib->add_field('item_name', $product['name']);
		$this->paypal_lib->add_field('custom', $userID);
		$this->paypal_lib->add_field('item_number',  $product->task_id);
		$this->paypal_lib->add_field('amount',  $product->task_total_budget);

		  // echo'<pre>';print_r($this->paypal_lib);exit;
		// Render paypal form
		$this->paypal_lib->paypal_auto_form();
	}
	 
	public function success(){
		// echo 'hello success';exit;
		// print_r($this->input->get());exit;

		// Get the transaction data
		$paypalInfo= $this->input->get();
		$productData = $paymentData = array();
		if(!empty($paypalInfo['item_number']) && !empty($paypalInfo['tx']) && !empty($paypalInfo['amt']) && !empty($paypalInfo['cc']) && !empty($paypalInfo['st'])){
			$item_name = $paypalInfo['item_name'];
			$task_id = $paypalInfo['item_number'];
			$txn_id = $paypalInfo["tx"];
			$payment_amt = $paypalInfo["amt"];
			$currency_code = $paypalInfo["cc"];
			$status = $paypalInfo["st"];
			
			// Insert tansaction data into the database
			$orderData = array(
				// 'product_id' => $postData['id'],
				// 'buyer_name' => $name,
				// 'buyer_email' => $email,
				'task_id' => $paypalInfo['item_number'],
				// 'client_id' => $postData['client_id'],
				'amount' => $paypalInfo["amt"],
				'currency_code' => $paypalInfo["cc"],
				'txn_id' => $paypalInfo["tx"],
				'payment_status' => 'yes',
				'payment_type' => 'paypal',
				'created_date' => date('Y-m-d H-i-s'),
                'updated_date' => date('Y-m-d H-i-s'),
			);
			// echo"<pre>";print_r($orderData);exit;
			$this->db->insert('payments', $orderData);
			  // echo $this->db->last_query();exit;
			  $insertId = $this->db->insert_id();

			  $data = array(
				'hired_status' => 1,
				);
				
				$this->db->where('task_id', $task_id);
				$this->db->update('task_hired', $data);
				
				$data = array(
						'task_status' => 1,
						'task.task_hired' = 1,
						'task_is_ongoing' => 1,
				);
				
				$this->db->where('task_id', $task_id);
				$this->db->update('task', $data);

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

		$this->db->join('task', 'task.task_id = payments.task_id');

		$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');

        $this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');

		$this->db->where(['payments.id'=> $insertId]);

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
		$returnURL = base_url().'paypal/success_subscription'; //payment success url
		$cancelURL = base_url().'paypal/cancel'; //payment cancel url
		$notifyURL = base_url().'paypal/ipn'; //ipn url
		
		// Get product data from the database
		// $product = $this->product->getRows($id);
		//  echo $this->uri->segment(3);exit;
		$query = $this->db->get_where('subscription_plan',['id'=>$this->uri->segment(3)]);
		$product = $query->num_rows() > 0 ? $query->result_array() :array();
		// echo'<pre>';print_r($product[0]['id']);exit;
		
		// Get current user ID from the session (optional)
		$userID = !empty($this->session->all_userdata()['user_id'])?$this->session->all_userdata()['user_id']:1;
		
		// Add fields to paypal form
		$this->paypal_lib->add_field('return', $returnURL);
		$this->paypal_lib->add_field('cancel_return', $cancelURL);
		$this->paypal_lib->add_field('notify_url', $notifyURL);
		// $this->paypal_lib->add_field('item_name', $product['name']);
		$this->paypal_lib->add_field('custom', $userID);
		$this->paypal_lib->add_field('plan_id',  $product[0]['id']);
		$this->paypal_lib->add_field('plan_name',  $product[0]['name']);
		$this->paypal_lib->add_field('amount',  $product[0]['price']);
		$this->paypal_lib->add_field('client_id',  $userID);


		  // echo'<pre>';print_r($this->paypal_lib);exit;
		// Render paypal form
		$this->paypal_lib->paypal_auto_form();
	}

	public function success_subscription(){
		// echo 'hello success';exit;
		// print_r($this->input->get());exit;

		// Get the transaction data
		$paypalInfo= $this->input->get();
		$productData = $paymentData = array();
		// !empty($paypalInfo['plan_id']) && 
		if(!empty($paypalInfo['tx']) && !empty($paypalInfo['amt']) && !empty($paypalInfo['cc']) && !empty($paypalInfo['st'])){
			$item_name = $paypalInfo['item_name'];
			$task_id = $paypalInfo['item_number'];
			$txn_id = $paypalInfo["tx"];
			$payment_amt = $paypalInfo["amt"];
			$currency_code = $paypalInfo["cc"];
			$status = $paypalInfo["st"];
			
			// Insert tansaction data into the database
			$orderData = array(
				// 'product_id' => $postData['id'],
				// 'buyer_name' => $name,
				// 'buyer_email' => $email,
				//'task_id' => $paypalInfo['item_number'],
				'client_id' => $paypalInfo["cm"],
				// 'client_id' => $postData['client_id'],
				'amount' => $paypalInfo["amt"],
				'currency_code' => $paypalInfo["cc"],
				'txn_id' => $paypalInfo["tx"],
				'payment_status' => 'yes',
				'payment_type' => 'paypal',
				'created_date' => date('Y-m-d H-i-s'),
                'updated_date' => date('Y-m-d H-i-s'),
			);
			// echo"<pre>";print_r($orderData);exit;
			$this->db->insert('payments', $orderData);
			 //  echo $this->db->last_query();exit;
			  $insertId = $this->db->insert_id();

			  $data = array(
				'subscription_plan' => $paypalInfo['plan_id'],
				);
				
				$this->db->where('user_id', $this->input->post('client_id'));
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
		$this->db->join('user_login', 'payments.client_id = user_login.user_id');
		$this->db->join('subscription_plan', 'subscription_plan.id = user_login.subscription_plan');
		$this->db->where(['payments.id'=> $insertId]);
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
					'title' => display('Success :: Hire-n-Work'),
				);
		$this->template->full_customer_html_view($data);
	}
}