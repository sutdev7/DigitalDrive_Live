<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	function __construct() {
      	parent::__construct();
		header('Cache-Control: no-cache, must-revalidate, max-age=0');
		header('Cache-Control: post-check=0, pre-check=0',false);
		header('Pragma: no-cache');
		$this->load->library('Luser');

        if(!$this->auth->is_logged()) {
        	$this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You haven\'t login to the portal. Please login to proceed further.</div>');
        	redirect('sign-in', 'refresh');
        }		
    }

	public function index(){		
		if($this->session->userdata('user_type') == 1){
			redirect('admin/dashboard','refresh');
		}else if($this->session->userdata('user_type') == 3){
			// $content = $this->luser->dashboard_page();
			// $data = array(
			// 	'content' => $content,
			// 	'title' => display('Dashboard :: Hire-n-Work'),
			// );
			// $this->template->full_customer_html_view($data);	

			redirect('client-dashboard/'.$this->session->userdata('username'),'refresh');

		}elseif($this->session->userdata('user_type') == 4){
			redirect('freelancer-dashboard/'.$this->session->userdata('username'),'refresh');
		}elseif($this->session->userdata('user_type') == 5){
			redirect('nlancer-dashboard/'.$this->session->userdata('username'),'refresh');
		}
	}

	public function upcoming_projects($pageIndex = 0){
		$content = $this->luser->upcoming_projects_page();
		$data = array(
			'content' => $content,
			'title' => display('Upcoming Projects :: Hire-n-Work'),
		);
		$this->template->full_customer_html_view($data);
	}
	public function hired($pageIndex = 0){
		$content = $this->luser->hired();
		$data = array(
			'content' => $content,
			'title' => display('Hired :: Hire-n-Work'),
		);
		$this->template->full_customer_html_view($data);
	}
	public function search_freelancer(){
        $content = $this->luser->search_freelancer_page();
		$data = array(
		    'content' => $content,
		    'title' => display('Search Freelancer :: Hire-n-Work'),
		);
		$this->template->full_customer_html_view($data);
	}		
	public function client_bio(){
		$content = $this->luser->client_bio_page();
		$data = array(
			'content' => $content,
			'title' => display('Client Bio :: Hire-n-Work'),
		);
		$this->template->full_customer_html_view($data);		
	}


	public function portfolio(){
		$content = $this->luser->client_portfolio_page();
		$data = array(
			'content' => $content,
			'title' => display('Portfolio :: Hire-n-Work'),
		);
		$this->template->full_customer_html_view($data);		
	}
	public function gender(){
        $this->form_validation->set_rules('fldUserGender','Gender', 'required');
        if($this->form_validation->run() == false){        
		    $content = $this->luser->gender_page();
		    $data = array(
			    'content' => $content,
			    'title' => display('Gender :: Hire-n-Work'),
		    );
		}else{
		    $this->luser->updateUserData($this->session->all_userdata());
		    $content = $this->luser->gender_page();
		    $data = array(
			    'content' => $content,
			    'title' => display('Gender :: Hire-n-Work'),
		    );
	    }
		$this->template->full_customer_html_view($data);
	}
	public function payment_details(){
        $this->form_validation->set_rules('fldCreditCardNo','Card No', 'trim|required|numeric|min_length[13]|max_length[16]');
        $this->form_validation->set_rules('fldCardExpiryMonth','Expiry Month', 'required');
        $this->form_validation->set_rules('fldCardExpiryYear','Expiry Year', 'required');
        $this->form_validation->set_rules('fldCreditCardCvv','CVV No', 'trim|required|numeric|min_length[3]|max_length[4]');                        
        if($this->form_validation->run() == false){        
		    $content = $this->luser->payment_details_page();
		    $data = array(
			    'content' => $content,
			    'title' => display('Payment Details :: Hire-n-Work'),
		    );
		}else{
		    $this->luser->updateUserCardData($this->session->all_userdata());
		    $content = $this->luser->payment_details_page();
		    $data = array(
			    'content' => $content,
			    'title' => display('Payment Details :: Hire-n-Work'),
		    );
	    }
		$this->template->full_customer_html_view($data);
	}
	public function public_profile(){	
        $content = $this->luser->public_profile_page();
		$data = array(
		   'content' => $content,
		    'title' => display('Public Profile :: Hire-n-Work'),
		);	          
		$this->template->full_customer_html_view($data);
	}	
	public function settings(){
        $this->form_validation->set_rules('fldCurrentPassword','Current Password', 'trim|required');
        $this->form_validation->set_rules('fldNewPassword','New Password', 'trim|required');
        $this->form_validation->set_rules('fldConfirmPassword','Expiry Year', 'trim|required|matches[fldNewPassword]');                       
        if($this->form_validation->run() == false){        
		    $content = $this->luser->settings_page();
		    $data = array(
			    'content' => $content,
			    'title' => display('User Profile Settings :: Hire-n-Work'),
		    );	
		}
		$this->template->full_customer_html_view($data);	    			
	}
    public function change_password() {
		$this->luser->updateUserPassword($this->session->all_userdata());
		$content = $this->luser->settings_page();
		$data = array(
		    'content' => $content,
		    'title' => display('User Profile Settings :: Hire-n-Work'),
		);	
		$this->template->full_customer_html_view($data);			
    }

	public function messages(){
		if($this->uri->segment(2) !=''){
			$user_id_to = $this->uri->segment(2);
		}else{
			$user_id_to = '';
		}
		$content = $this->luser->messages($user_id_to);

//		echo '<pre>'; print_r($content); echo '</pre>'; die;
		$data = array(
			'content' => $content,
			'title' => display('Messages :: Hire-n-Work'),
		);
		$this->template->full_website_message_view($data);		
	}

	public function saveMsgData() {
		return $this->luser->addMsgUserData();
	}

	public function saveUserData() {
		return $this->luser->updateUserData($this->session->all_userdata());
	}

	public function activeUserProfile() {
		return $this->luser->activeUserProfile($this->session->all_userdata());
	}

	public function savePortfolioData() {
		return $this->luser->insertPortfolioData($this->session->all_userdata());
	}
	
	public function saveProfile_title() {
		return $this->luser->UpdateProfile_title($this->session->all_userdata());
	}

	public function removeUserSkillData() {
		return $this->luser->removeUserSkillData();
	}

	public function save_validate_mobile_no() {
		echo $this->luser->save_validate_mobile_no($this->session->all_userdata());
	}	

	public function save_transactional_notification() {
		echo $this->luser->save_transactional_notification($this->session->all_userdata());
	}

	public function save_task_update_notification() {
		echo $this->luser->save_task_update_notification($this->session->all_userdata());
	}			

	public function save_task_reminder_notification() {
		echo $this->luser->save_task_reminder_notification($this->session->all_userdata());
	}

	public function save_helpful_notification() {
		echo $this->luser->save_helpful_notification($this->session->all_userdata());
	}

	public function uploadUserProfileImage() {
        echo $this->luser->save_user_profile_image($this->session->all_userdata());
	}

    public function ajax_search_freelancer() {
    	echo $this->luser->ajax_search_freelancer();
    }  
	public function addSkill(){

		 $response = "";
		 $data = array(
            'name' => $this->input->post('title'),
			'status'=>1,
			'deleted'=>0,
			'doc'=>date('Y-m-d H:i:s')
         );

        $result = $this->db->insert('area_of_interest',$data);  

        $insert_id = $this->db->insert_id();

		$response = array('lastinsertid'=>$insert_id,'title'=>$this->input->post('title'));	
		echo json_encode($response);
		exit;
		
	}
    public function analytics()
	{
		$content = $this->luser->analytics();
		$data = array(
			'content' => $content,
			'title' => display('Analytics :: Hire-n-Work'),
		);
		$this->template->full_customer_html_view($data);
	}

	public function see_all_projects()
	{
		$content = $this->luser->analytics_all();
		$data = array(
			'content' => $content,
			'title' => display('Analytics :: Hire-n-Work'),
		);
		$this->template->full_customer_html_view($data);
	}
}

