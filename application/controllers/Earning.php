<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Earning extends CI_Controller {

	function __construct() {
      	parent::__construct();

		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');	
		
		// Load transaction model
		$this->load->model('transaction');
    }

	public function index(){
		$data["inescrowdata"]=$this->transaction->get_freelancer_inescrow_data(0,"");
		// echo '<pre>';print_r($data);exit;
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/earning',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}


	public function coins_wallet(){

	}
		
}
