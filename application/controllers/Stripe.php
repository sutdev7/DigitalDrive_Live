<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stripe extends CI_Controller {
    
    function __construct() {
        parent::__construct();
		
		// Load Stripe library
        $this->load->library('stripe_lib');
        
        // Load product model
		$this->load->model('product');
    }
    
    public function index(){
        $data = array();
		
		// Get products from the database
		$data['products'] = $this->product->getRows();
		
		// Pass products data to the list view
        $this->load->view('products/index', $data);
    }
	
	function pay(){
		$data = array();
		// Get product data from the database
        // $product = $this->product->getRows($id);
		// If payment form is submitted with token
		if($this->input->post('stripeToken')){
            
			// Retrieve stripe token and user info from the posted form data
			$postData = $this->input->post();
			$postData["name"] = $_SESSION["user_name"];
			$postData["email"] = $_SESSION["user_email"];
			$postData["client_id"] = $this->input->post('client_id');
			$postData["amount"] = $this->input->post('amount', true);
			$postData["task_id"] = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
		
			// Make payment
            $paymentID = $this->payment($postData);
            // echo"<pre>";print_r($paymentID);
			// print_r($_POST);exit;
			// If payment successful
			if($paymentID){
				redirect('stripe/payment_status/'.$paymentID);
			}else{
				$apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':'';
				$data['error_msg'] = 'Transaction has been failed!'.$apiError;
			}
		}
        
        // Pass product data to the details view
		// $data['product'] = $product;
        // $this->load->view('products/details', $data);
    }
	
	function payment($postData){
		
		// If post data is not empty
		if(!empty($postData)){
			// Retrieve stripe token and user info from the submitted form data
			$token  = $postData['stripeToken'];
			$name = $postData['name'];
			$email = $postData['email'];
	
			// Add customer to stripe
			$customer = $this->stripe_lib->addCustomer($email, $token);
			// echo"<pre>";
			// print_r($postData);
			// print_r($customer);
			if($customer){
				
				// Charge a credit or a debit card
				$charge = $this->stripe_lib->createCharge($customer->id, $postData['name'], $postData['amount']);
				// echo'charge';print_r($charge);exit;
				if($charge){
					
					// Check whether the charge is successful
					if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){
						// Transaction details 
						$transactionID = $charge['balance_transaction'];
						$paidAmount = $charge['amount'];
						$paidAmount = ($paidAmount/100);
						$paidCurrency = $charge['currency'];
						$payment_status = $charge['status'];
						
						// Insert tansaction data into the database
						$orderData = array(
							// 'product_id' => $postData['id'],
							// 'buyer_name' => $name,
							// 'buyer_email' => $email,
							'task_id' => $postData['task_id'],
							'client_id' => $postData['client_id'],
							'amount' => $paidAmount,
							'currency_code' => $paidCurrency,
							'txn_id' => $transactionID,
							'payment_status' => 'yes',
							'payment_type' => 'Stripe'
						);
						// echo"<pre>";print_r($orderData);exit;
						$this->db->insert('payments', $orderData);
						//   echo $this->db->last_query();exit;
						  $insertId = $this->db->insert_id();
						  $data = array(
							'hired_status' => 1,
							);
							
							$this->db->where('task_id', $postData['task_id']);
							$this->db->update('task_hired', $data);
							
							$data = array(
									'task_status' => 1,
									'task_is_ongoing' => 1,
							);
							
							$this->db->where('task_id', $postData['task_id']);
							$this->db->update('task', $data);
						// If the order is successful
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
                 'title' => display('payment status :: Hire-n-Work'),
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

	 function pay_subscription(){
		$data = array();
		// Get product data from the database
        // $product = $this->product->getRows($id);
		// If payment form is submitted with token
		if($this->input->post('stripeToken')){
            
			// Retrieve stripe token and user info from the posted form data
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
		
		// If post data is not empty
		if(!empty($postData)){
			// Retrieve stripe token and user info from the submitted form data
			$token  = $postData['stripeToken'];
			$name = $postData['name'];
			$email = $postData['email'];
	
			// Add customer to stripe
			$customer = $this->stripe_lib->addCustomer($email, $token);
			// echo"<pre>";
			// print_r($postData);
			// print_r($customer);
			if($customer){
				
				// Charge a credit or a debit card
				$charge = $this->stripe_lib->createCharge($customer->id, $postData['name'], $postData['amount']);
				// echo'charge';print_r($charge);exit;
				if($charge){
					
					// Check whether the charge is successful
					if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){
						// Transaction details 
						$transactionID = $charge['balance_transaction'];
						$paidAmount = $charge['amount'];
						$paidAmount = ($paidAmount/100);
						$paidCurrency = $charge['currency'];
						$payment_status = $charge['status'];
						
						// Insert tansaction data into the database
						$orderData = array(
							// 'product_id' => $postData['id'],
							// 'buyer_name' => $name,
							// 'buyer_email' => $email,
							// 'task_id' => $postData['task_id'],
							'client_id' => $postData['client_id'],
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
						$data = array(
						'subscription_plan' => $postData['plan_id'],
						);
						
						$this->db->where('user_id', $postData['client_id']);
						$this->db->update('user_login', $data);
						// If the order is successful
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
		$this->db->join('user_login', 'payments.client_id = user_login.user_id');
		$this->db->join('subscription_plan', 'subscription_plan.id = user_login.subscription_plan');
		$this->db->where(['payments.id'=> $id]);
		$result = $this->db->get();
		// echo $this->db->last_query();exit;
		// echo'<pre>';print_r($result->result());exit;
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
                 'title' => display('payment status :: Hire-n-Work'),
             );
     $this->template->full_customer_html_view($data);
	}
	
}