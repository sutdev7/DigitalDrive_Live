<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Subscription extends CI_Controller {

    

    function __construct() {

        parent::__construct();
		// Load Stripe library
		$this->load->library('stripe_lib');
		$this->userID = isset($_SESSION['user_id']) ? $_SESSION['user_id']:$this->uri->segment(4);

		// if(!$this->auth->is_logged()) {

        // 	$this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You haven\'t login to the portal. Please login to proceed further.</div>');

        // 	redirect('sign-in', 'refresh');
		// }	

		// if($this->auth->is_logged()) {
		// 	if($this->session->userdata('user_type') == 1){
		// 		redirect('admin/dashboard', 'refresh');
		// 	}else{

		// 		redirect('dashboard', 'refresh');

		// 	}

        // }

		// Get user ID from current SESSION
    }

    

    public function index(){

        $parsedata = array();
		$content = $this->parser->parse('account/subscription_plan',$parsedata,true);
		$data = array(

			'content' => $content,
			'title' => display('Subscription :: Hire-n-Work'),
		);
		if($this->session->userdata('user_type')==4){
			$this->template->full_freelancer_html_view($data);
		}else if($this->session->userdata('user_type')==3){
			$this->template->full_customer_html_view($data);
		}else{
			$this->template->full_website_html_view($data);		
		}
		//$this->template->full_website_html_view($data);	

    }

	

	public function payment(){

		// echo $this->uri->segment(3);exit;
		$subscription_plan = $this->uri->segment(3);
		if($subscription_plan !=""){
			$query = $this->db->get_where('subscription_plan',['id'=>$subscription_plan]);
			if($query->num_rows() > 0){
				$parsedata["planinfo"] = $query->result_array();	
			} else{
				$parsedata["planinfo"] = [];
			}
		} else{
			$parsedata["planinfo"] = [];
		}				
		
		$parsedata["planinfo"][0]["user_id"] = $this->userID;
		// echo"<pre>";print_r($parsedata["planinfo"]);exit;
		$content = $this->parser->parse('account/subscription_payment',$parsedata,true);//$this->laccount->sign_up_as_page();
		$data = array(
			'content' => $content,
			'title' => display('Subscription :: Hire-n-Work'),
		);
		
		if($this->session->userdata('user_type')==4){
			$this->template->full_freelancer_html_view($data);
		}else if($this->session->userdata('user_type')==3){
			$this->template->full_customer_html_view($data);
		}else{
			$this->template->full_website_html_view($data);		
		}
		//$this->template->full_website_html_view($data);

	}

}