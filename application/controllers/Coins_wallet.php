<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coins_wallet extends CI_Controller {

    public function __construct(){
        parent::__construct();
		if(!$this->auth->is_logged()) {
        	$this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You haven\'t login to the portal. Please login to proceed further.</div>');
        	redirect('sign-in', 'refresh');

        }
        // Load pagination library
        $this->load->library('ajax_pagination');
		// Load post model
		$this->load->model('coinswallet');
		// Per page limit
		$this->perPage = 4;

     }

     public function index(){
		
		$parsedata = array();
		$query= $this->db->get_where('user_login',['user_id'=>$_SESSION["user_id"]]);
		$parsedata['coins_data']= $query->num_rows() ? $query->result_array(): [];
		// echo '<pre>';print_r($parsedata);exit;

        $conditions['where']['user_login.user_id']=$_SESSION["user_id"];
        // Get record count
		$conditions['returnType'] = 'count';
		$totalRec = $this->coinswallet->getRows($conditions);
        
        // Pagination configuration
        $config['target']      = '#dataList';
        $config['base_url']    = base_url('Coins_wallet/ajaxPaginationData');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';

        /* config for bootstrap pagination class integration */
		$config['full_tag_open'] = '<ul class="pagination  pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		// Initialize pagination library
        $this->ajax_pagination->initialize($config);

		// Get records
		$conditions = array(
			'limit' => $this->perPage
		);
       // $conditions['limit']    = $this->perPage;
		

		$parsedata['posts'] = $this->coinswallet->getRows($conditions);
		// echo "<pre>";print_r($parsedata['posts']);exit;
        $content = $this->parser->parse('account/coins_wallet',$parsedata,true);
        $data = array(
                    'content' => $content,
                    'title' => display('Coins Wallet :: Hire-n-Work'),
                );
        // $this->template->full_customer_html_view($data);
		$this->template->full_freelancer_html_view($data);

	 }
	 

	 function ajaxPaginationData(){

		// Define offset

        $page = $this->input->post('page');

        if(!$page){

            $offset = 0;

        }else{

            $offset = $page;

        }

		
        $conditions['where']['user_login.user_id']=$_SESSION["user_id"];

		// Set conditions for search and filter

        $keywords = $this->input->post('keywords');

        $sortBy = $this->input->post('sortBy');

        if(!empty($keywords)){

            $conditions['search']['keywords'] = $keywords;

        }

        if(!empty($sortBy)){

            $conditions['search']['sortBy'] = $sortBy;

        }

        

        // Get record count

        $conditions['returnType'] = 'count';
		$totalRec = $this->coinswallet->getRows($conditions);

        

        // Pagination configuration

        $config['target']      = '#dataList';
        $config['base_url']    = base_url('Coins_wallet/ajaxPaginationData');
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';

        

        /* config for bootstrap pagination class integration */

		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
        

		// Initialize pagination library
        $this->ajax_pagination->initialize($config);

		// Get records
		$conditions['start'] = $offset;
		$conditions['limit'] = $this->perPage;
		unset($conditions['returnType']);
        $parsedata['posts'] = $this->coinswallet->getRows($conditions);
        

        // Load the data list view
        $this->load->view('account/coins_wallet-ajax', $parsedata, false);


	}

  

}