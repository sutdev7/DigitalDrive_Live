<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Freelancerearnings extends CI_Controller {

    

    function __construct() {

        parent::__construct();
		if(!$this->auth->is_logged()) {
        	$this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You haven\'t login to the portal. Please login to proceed further.</div>');
        	redirect('sign-in', 'refresh');

        }
		

		// Load pagination library

        $this->load->library('ajax_pagination');

		

		// Load transaction model
		$this->load->model('transaction');

		

		// Per page limit

		$this->perPage = 4;

    }

    

    public function index(){

        // print_r($_SESSION);exit;

        $parsedata = array();

        $parsedata["inescrow_count"]=$this->transaction->get_freelancer_inescrow_income(2,"");
        $parsedata["net_income_count"]=$this->transaction->get_freelancer_net_income(2,"");
        $parsedata["budget_count"]=$this->transaction->get_freelancer_budget(2,"");
      
        // echo'<pre>';print_r($parsedata["budget_count"]);exit;

		// Get record count
        $conditions['where']['user_login.user_id']=$_SESSION["user_id"];
		$conditions['returnType'] = 'count';
		$totalRec = $this->transaction->getRows($conditions);

        // Pagination configuration
        $config['target']      = '#dataList';
        $config['base_url']    = base_url('Freelancerearnings/ajaxPaginationData');
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
        $conditions['where']['user_login.user_id']=$_SESSION["user_id"];
        $parsedata['posts'] = $this->transaction->getRows($conditions);

        // echo'<pre>';print_r($parsedata);exit;

        // Load the list page view

        // $this->load->view('posts/index', $data);

		$content = $this->parser->parse('freelancer/earnings',$parsedata,true);
		$data = array(
					'content' => $content,
					'title' => display('My earning :: Hire-n-Work'),
				);
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
        $conditions['where']['user_login.user_id']=$_SESSION["user_id"];
		$totalRec = $this->transaction->getRows($conditions);

        
        // Pagination configuration

        $config['target']      = '#dataList';
        $config['base_url']    = base_url('Freelancerearnings/ajaxPaginationData');
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
        $parsedata['posts'] = $this->transaction->getRows($conditions);     

        // Load the data list view

        $this->load->view('freelancer/earnings-ajax', $parsedata, false);

        // $parsedata = array();

		// $content = $this->parser->parse('freelancer/earnings-ajax',$parsedata,true);

		// $data = array(

		// 			'content' => $content,

		// 			'title' => display('Sign Up As :: Hire-n-Work'),

		// 		);

		// $this->template->full_freelancer_html_view($data);

	}

	

	public function inescrow(){

        $parsedata["posts"]=$this->transaction->get_freelancer_inescrow_income(0,"");

		$content = $this->parser->parse('freelancer/earning_net_income',$parsedata,true);

		$data = array(

					'content' => $content,

					'title' => display('My earning inescrow :: Hire-n-Work'),

				);

		$this->template->full_freelancer_html_view($data);

	}



	public function netincome(){

        $parsedata["posts"]=$this->transaction->get_freelancer_net_income(0,"");

		$content = $this->parser->parse('freelancer/earning_net_income',$parsedata,true);

		$data = array(

					'content' => $content,

					'title' => display('My earning netincome :: Hire-n-Work'),

				);

		$this->template->full_freelancer_html_view($data);

	}



	public function budget(){

        $parsedata["posts"]=$this->transaction->get_freelancer_budget(0,"");

		$content = $this->parser->parse('freelancer/earning_net_income',$parsedata,true);

		$data = array(

					'content' => $content,

					'title' => display('My earning budget :: Hire-n-Work'),

				);

		$this->template->full_freelancer_html_view($data);

	}

}