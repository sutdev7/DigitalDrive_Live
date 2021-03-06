<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stripe extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('stripe_lib');
	}
	public function index(){
		$data = array();
	}

	public function pay(){
		
		$data = array();

		if($this->input->post('stripeToken')){
			// Retrieve stripe token and user info from the posted form data
			$postData = $this->input->post();
			$postData["name"] = $_SESSION["user_name"];
			$postData["email"] = $_SESSION["user_email"];
			$postData["client_id"] = $this->input->post('client_id');
			$postData["amount"] = $this->input->post('amount');
			$postData["task_id"] = $this->input->post('task_id');
			$postData["milestone_id"] =  explode("-",$this->input->post('usertaskid_milestoneid'))[1];
			// Make payment
            $paymentID = $this->payment($postData);
            // echo"<pre>";print_r($paymentID);
			
			if($paymentID){
				redirect('stripe/payment_status/'.$paymentID);
			}else{
				$apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':'';
				$data['error_msg'] = 'Transaction has been failed!'.$apiError;
			}
		}
	}

	function payment($postData){

		if(!empty($postData)){

			$token  = $postData['stripeToken'];
			$name = $postData['name'];
			$email = $postData['email'];
			$milestone_id = $postData['milestone_id'];
		// Add customer to stripe
			$customer = $this->stripe_lib->addCustomer($email, $token);

			if($customer){
				$charge = $this->stripe_lib->createCharge($customer->id, $postData['name'], $postData['amount']);
				if($charge){

					if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){
						
						$transactionID = $charge['balance_transaction'];
						$paidAmount = $charge['amount'];
						$paidAmount = ($paidAmount/100);
						$paidCurrency = $charge['currency'];
						$payment_status = $charge['status'];
						
						$orderData = array(
							'task_id' => $postData['task_id'],
							'user_id' => $postData['client_id'],
							'amount' => $paidAmount,
							'currency_code' => $paidCurrency,
							'txn_id' => $transactionID,
							'payment_status' => 'yes',
							'payment_type' => 'Stripe',
							'milestone_id' => $milestone_id
						);
						$this->db->insert('payments', $orderData);
						//   echo $this->db->last_query();exit;
						  $insertId = $this->db->insert_id();
						  $data = array('hired_status' => 1 );
						  $this->db->where('task_id', $postData['task_id']);
						  $this->db->update('task_hired', $data);
						  $data = array(
						  	'task_status' => 1,
						  	'task.task_hired' => 1,
						  	'task_is_ongoing' => 1
						  );
						  $this->db->where('task_id', $postData['task_id']);
						  $this->db->update('task', $data);

						  $updateArr = array(
					      'milestone_current_status' => 'AR',
					      'milestone_approval_date' => date('Y-m-d H-i-s'),
					      'milestone_dom' => date('Y-m-d H-i-s'),
					      'payment_status' => '1',
					    );
					    $this->db->where('milestone_id',$milestone_id);
					    $this->db->update('task_proposal_milestone',$updateArr);

						  if($payment_status == 'succeeded' || $insertId > 0){
						  	return $insertId;
						  }
						}
					}
				}
			}
			return false;
		}

	function payment_status($id){
		// $result= $this->db->get_where('payments', ['id'=>$id]);
		$this->db->select('*');
		$this->db->from('payments');
		$this->db->join('task', 'task.task_id = payments.task_id');
		$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');
		$this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');
		$this->db->where(['payments.id'=> $id]);
		$result = $this->db->get();
		if($result->num_rows() > 0){
			$parsedata['result'] = $result->result();
		}else{
			$parsedata['result'] = array();
		}
	    $content = $this->parser->parse('account/payment_success',$parsedata,true);
	    $data = array(
	    	'content' => $content,
	    	'title' => display('payment status :: Hire-n-Work'),
	    );
	    $this->template->full_customer_html_view($data);
	}

	function cancel(){
		$parsedata = array();
		$content = $this->parser->parse('account/payment_cancel',$parsedata,true);
		$data = array(
			'content' => $content,
			'title' => display('Sign Up As :: Hire-n-Work'),
		);
		$this->template->full_customer_html_view($data);
	}

	function pay_subscription(){
	 	$data = array();
	 	if($this->input->post('stripeToken')){
	 		$postData = $this->input->post();
			$postData["name"] = $_SESSION["user_name"];
			$postData["email"] = $_SESSION["user_email"];
			$postData["client_id"] = $this->input->post('client_id');
			$postData["amount"] = $this->input->post('amount', true);
			$postData["plan_id"] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
			// Make payment
            $paymentID = $this->payment_subscription($postData);
            // echo"<pre>";print_r($paymentID);
			// print_r($_POST);exit;
			// If payment successful
			if($paymentID){
				redirect('stripe/payment_status_subscription/'.$paymentID);
			}else{
				$apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':'';
				$data['error_msg'] = 'Transaction has been failed!'.$apiError;
			}
		}
		// Pass product data to the details view
		// $data['product'] = $product;
        // $this->load->view('products/details', $data);
    }

	function payment_subscription($postData){
		if(!empty($postData)){
			$token  = $postData['stripeToken'];
			$name = $postData['name'];
			$email = $postData['email'];
			// Add customer to stripe
			$customer = $this->stripe_lib->addCustomer($email, $token);
			// echo"<pre>"; print_r($postData);
			if($customer){
				$charge = $this->stripe_lib->createCharge($customer->id, $postData['name'], $postData['amount']);
				if($charge){
					if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){
						$transactionID = $charge['balance_transaction'];
						$paidAmount = $charge['amount'];
						$paidAmount = ($paidAmount/100);
						$paidCurrency = $charge['currency'];
						$payment_status = $charge['status'];
						$orderData = array(
							'user_id' => $postData['client_id'],
							'amount' => $paidAmount,
							'paid_for' => $postData['paid_for'],
							'currency_code' => $paidCurrency,
							'txn_id' => $transactionID,
							'payment_status' => 'yes',
							'payment_type' => 'Stripe',
							'created_date' => date('Y-m-d H-i-s'),
							'updated_date' => date('Y-m-d H-i-s'),
						);
						// echo"<pre>";print_r($orderData);exit;
						$this->db->insert('payments', $orderData);
						// echo $this->db->last_query();exit;
						$insertId = $this->db->insert_id();
						$data = array('subscription_plan' => $postData['plan_id'],'status'=>1);
						$this->db->where('user_id', $postData['client_id']);
						$this->db->update('user_login', $data);
						if($payment_status == 'succeeded' || $insertId > 0){
							return $insertId;
						}
					}
				}
			}
		}
		return false;
	}

	function payment_status_subscription($id){
		// $result= $this->db->get_where('payments', ['id'=>$id]);
		$this->db->select('*');
		$this->db->from('payments');
		$this->db->join('user_login', 'payments.user_id = user_login.user_id');
		$this->db->join('subscription_plan', 'subscription_plan.id = user_login.subscription_plan');
		$this->db->where(['payments.id'=> $id]);
		$result = $this->db->get();
		if($result->num_rows() > 0){
			$parsedata['result'] = $result->result();
		}else{
			$parsedata['result'] = array();
		}
		$content = $this->parser->parse('account/payment_success',$parsedata,true);
		$data = array(
			'content' => $content,
			'title' => display('payment status :: Hire-n-Work'),
		);
		$this->template->full_website_html_view($data);
	}



	public function refund(){

		$this->stripe_lib->refund();

	}	



}