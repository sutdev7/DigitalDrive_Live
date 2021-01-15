<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends CI_Controller {
    
    function __construct() {
        parent::__construct();
		
		// Load Stripe library
        $this->load->library('stripe_lib');
		
		// Get user ID from current SESSION
		$this->userID = isset($_SESSION['user_id'])?$_SESSION['user_id']:1;
    }
    
    public function index(){
        $parsedata = array();
		$content = $this->parser->parse('account/subscription_plan',$parsedata,true);//$this->laccount->sign_up_as_page();
		$data = array(
			        'content' => $content,
			        'title' => display('Payment :: Hire-n-Work'),
		        );
		$this->template->full_website_html_view($data);	
    }
	
	public function payment(){
		// echo $this->uri->segment(3);exit;
		$query = $this->db->get_where('subscription_plan',['id'=>$this->uri->segment(3)]);
		$parsedata["planinfo"] = $query->num_rows() > 0 ? $query->result_array() :array();
		$parsedata["planinfo"][0]["user_id"] = $_SESSION["user_id"];
		// echo"<pre>";print_r($parsedata["planinfo"]);exit;

		$content = $this->parser->parse('account/subscription_payment',$parsedata,true);//$this->laccount->sign_up_as_page();
		$data = array(
			        'content' => $content,
			        'title' => display('Payment :: Hire-n-Work'),
		        );
		$this->template->full_website_html_view($data);
	}
}