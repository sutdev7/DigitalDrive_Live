<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Admimodel');
		$this->load->model('Users');
		$this->load->model('Messages');
		if(!$this->auth->is_logged()) {
        	$this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You haven\'t login to the portal. Please login to proceed further.</div>');
        	redirect('sign-in', 'refresh');
        }
		 $this->load->library('encryption');
		 $this->load->model('Transaction');
		
	}
	
	public function index(){
	
	}
		
	public function sign_up(){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$this->form_validation->set_rules('username','Username', 'required');
			$this->form_validation->set_rules('userpass','Password', 'required');
			
			$submitData = $this->input->post();        
			
			if($this->form_validation->run() == false){ 
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Username or Password should not be empty </div>');
				//redirect('job-details/'.$this->input->post('user_task_id'),'refresh'); 
			}else{
				$return = $this->Admimodel->check_login($submitData);
				if($return){
					redirect('admin/dashboard','refresh'); 
				}else{
					redirect('admin/login','refresh'); 
				}
			}
		}
	}
		
	public function dashboard(){
				// Start Amardeep
				$data['txnlist'] = $this->Transaction->get_transaction_list($count = 1, $status);
				// End Amardeep
				$data['freelancer_count']       = $this->Admimodel->get_user_counts($usertype = 4, true);
                $data['client_count']           = $this->Admimodel->get_user_counts($usertype = 3, true);
                $data['naluacer_count']         = $this->Admimodel->get_user_counts($usertype = 5, true);
                $data['problem_ticket_count']   = $this->Admimodel->get_problem_ticket_count();

		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/dashboard', $data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	
	public function client_list($status = ""){
		$data['userlist'] = $this->Admimodel->get_client_list($usertype = 3, $status);
		 $this->Admimodel->Update_read_status($usertype = 3, '1');
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/user_list',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	// Start Amardeep
	public function transaction_list($status = ""){
		$data['txnlist'] = $this->Transaction->get_transaction_list($count = 0, $status);
		// $this->Admimodel->Update_read_status($usertype = 3, '1');
		// echo"<pre>";print_r(count($data['txnlist']));exit;
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/transaction_list',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}	
	// End Amardeep
	public function user_add(){
		
		$uricheck = base64_decode($this->uri->segment(4));
		
		if(trim($uricheck) == 'c'){
			$user_type = '3'; 
		}else{
			$user_type = '4'; 
		}
		
		
		$data['countrylist'] = $this->Admimodel->get_country_list();
		//echo '<pre>'; print_r($data['country']);die;
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/add',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	
	public function user_edit(){
		
		$uricheck = base64_decode($this->uri->segment(4));
		
		if(trim($uricheck) == 'c'){
			$user_type = '3'; $data['info'] = array();
		}else if(trim($uricheck) == 'f'){
			$user_type = '4'; $data['info'] = array();
		}else{
			$user_type = ''; $user_id = $uricheck;
			// get user info
			$data['info'] = $this->Admimodel->get_user_info($user_id);
			$data['bankinfo'] = $this->Admimodel->get_user_bank_info($user_id);
			$data['bankinfo'] = $this->Admimodel->get_user_bank_info($user_id);
			$data['portfolioData']=$this->Admimodel->get_user_portfolio_id($user_id);
			$data['taskDetails']=$this->Admimodel->get_user_tasko_id($user_id);
		}
		$upd_array=array(
			'notify_status' => 1
			);
			$this->db->where('user_id_from', $uricheck);
		    $this->db->update('admin_notification', $upd_array);
		$data['countrylist'] = $this->Admimodel->get_country_list();
		//echo '<pre>'; print_r($data['country']);die;
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/edit',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	
	public function user_delete(){
		$user_id = base64_decode($this->uri->segment(4));
		
		$user_info = $this->Admimodel->getDataByCondition($tablename='user_login',$condition='user_id = "'.$user_id.'"',array('user_type','email'),$limit = '0',$orderfield = '',$odertype = '');
		if(!empty($user_info)){
			$user_type = $user_info->user_type;
			$email = ($user_info->email).'_deleted';
			
		}else{
			$user_type = 0;
			$email = '';
		}
			//$this->db->where('id', $id);
			//$this->db->delete($tables);	
			 
		//$return = $this->Admimodel->update($tableName='user_login',array('email'=> $email, 'status' => 0),$chkfield='user_id',$user_id);
		//$return = $this->Admimodel->update($tableName='users',array('status' => 0),$chkfield='user_id',$user_id);
		$this->db->where('user_id', $user_id); 
		$return	= $this->db->delete('user_login'); 
		$this->db->where('user_id', $user_id); 
		$return	= $this->db->delete('users'); 
		if($return){
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> User deleted successfully.
	</div>');
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Please try again.</div>');
		}
				
		if($user_type == 3){
			redirect('admin/client-list');
		}else if($user_type == 4){
			redirect('admin/freelancer-list');
		}else if($user_type == 5){
			redirect('admin/naluacer-lists/freelancer');
		}else if($user_type == 6){
			redirect('admin/naluacer-lists/client');
		}
		else{
			redirect('admin/dashboard');
		}
				
	}
	
	public function add_user_info(){
				     

		$this->form_validation->set_rules('name','Name', 'required');
		$this->form_validation->set_rules('email','Email', 'required');
		if($this->form_validation->run() == false){ 
			redirect('admin/user/edit/'.base64_encode($this->input->post('user_id')));		
		}else{
			$return = $this->Admimodel->add_data($this->input->post());
			if(base64_decode($this->input->post('user_type')) == 'c'){
				redirect('admin/client-list');
			}else{
				redirect('admin/freelancer-list');
			}	
		}
	}
	
	public function edit_user_info(){
		
		$this->form_validation->set_rules('email','Email', 'required');
		//$this->form_validation->set_rules('password','Password', 'required');
		
		$submitData = $this->input->post();   //echo '<pre>'; print_r($this->input->post()); die;     
		
		if($this->form_validation->run() == false){ 
			redirect('admin/user/edit/'.base64_encode($this->input->post('user_id')));		
		}else{
			$return = $this->Admimodel->modify_data($submitData);

            if(isset($submitData['profile_status'] )){

            	$message = 'Dear User,<br><br> Your profile is activated now. please login and find your job<br><br>Thanks';

		        $this->load->library('email');
		        $this->email->set_newline("\r\n");
		        $this->email->from("admin@hirenwork.com");
		        $this->email->to($submitData['email']);
		        $this->email->subject('Account activated');
		        $this->email->message($message);
		        $this->email->send();

            }else{

            	$message = 'Dear User,<br><br> Your profile is deactivated now. please contact with administrator <br><br>Thanks';

            	$this->load->library('email');
		        $this->email->set_newline("\r\n");
		        $this->email->from("admin@hirenwork.com");
		        $this->email->to($submitData['email']);
		        $this->email->subject('Account deactivate');
		        $this->email->message($message);
		        $this->email->send();


            }
			
			if($return){
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Data update successfully.
	</div>');
			}else{
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> Please try again.</div>');
			}
			if($this->input->post('user_type') == 3){
				redirect('admin/client-list');
			}else{
				redirect('admin/freelancer-list');
			}
			
		}		
	}
		
	public function freelancer_list($status = ""){
		$data['userlist'] = $this->Admimodel->get_user_list($usertype = 4, $status);
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/user_list',$data);
		$this->load->view('admin/includes/admin_footer_all');			
	}
	#Abhishek
	public function microkey_details($taskID = ''){

		$CI =& get_instance();
        $CI->load->model('Microkeys');
		$CI->load->model('Users');
		$CI->load->model('Tasks');
		$CI->load->model('Reviews');

		$userData = $CI->Users->get_user_profile_info_by_id($CI->session->userdata('user_id'));
		$microkeyData = $CI->Microkeys->get_microkey_info_by_id($taskID);

		$userLoginData = $CI->Users->getUserLoginData('user_id', $CI->session->userdata('user_id'));
		if(!empty($userLoginData)){
			$connections = $userLoginData->total_connects;
			$total_positive_coins = $userLoginData->total_coins;
			$total_negative_coins = $userLoginData->total_negative_coins;
		}else{
			$connections = $total_positive_coins = $total_negative_coins = 0;
		}
		
		$user_profile_image = $CI->session->userdata('user_image');		
		if(empty($user_profile_image)) {
			$user_profile_image = base_url('assets/img/no-image.png');
		}else{
			$user_profile_image = base_url('uploads/user/profile_image/'.$user_profile_image);	    	
		}

		$microkey_image = $microkeyData->image;		
		if(empty($microkey_image)) {
			$microkey_image_path = base_url('assets/img/no-image.png');
		}else{
			$microkey_image_path = base_url('uploads/user/microkey_files/'.$microkey_image);	    	
		}

		if(empty($microkeyData->portfolio_img1)) {
			$microkey_image_path1 = base_url('assets/img/no-image.png');
		}else{
			$microkey_image_path1 = base_url('uploads/user/microkey_files/'.$microkeyData->portfolio_img1);	    	
		}
		if(empty($microkeyData->portfolio_img2)) {
			$microkey_image_path2 = base_url('assets/img/no-image.png');
		}else{
			$microkey_image_path2 = base_url('uploads/user/microkey_files/'.$microkeyData->portfolio_img2);	    	
		}
		if(empty($microkeyData->portfolio_img3)) {
			$microkey_image_path3 = base_url('assets/img/no-image.png');
		}else{
			$microkey_image_path3 = base_url('uploads/user/microkey_files/'.$microkeyData->portfolio_img3);	    	
		}
		if(empty($microkeyData->portfolio_img4)) {
			$microkey_image_path4 = base_url('assets/img/no-image.png');
		}else{
			$microkey_image_path4 = base_url('uploads/user/microkey_files/'.$microkeyData->portfolio_img4);	    	
		}

		$projectdata = $CI->Tasks->project_details($CI->session->userdata('user_id'));
		if(!empty($projectdata)){
			$projectCount = count($projectdata);
		}else{
			$projectCount = 0;
		}
		
		$user_sel_skills = $userData['user_selected_skills'];
				
			
				$user_skills="";
				if(!empty($user_sel_skills) && count($user_sel_skills) >0 ){
					
					foreach($user_sel_skills as $sk){
						$user_skills.=$sk['skill_name'].",";
					}
					
				}
				
				 $user_skills=rtrim($user_skills,",");
		
		

		$condition=array("review_received"=>$CI->session->userdata('user_id'),"show_review"=>1);
		$reviews_data=$CI->Reviews->get_reviews($condition);
		 
		$reviews=array();
		if(count($reviews_data)>0 ){
			
			foreach($reviews_data as $rv){
				$user_profile_image = $rv->profile_image;
				if(empty($user_profile_image)) {
					$user_profile_image = base_url('assets/img/no-image.png');
				}
				else {
					$user_profile_image = base_url('uploads/user/profile_image/'.$user_profile_image);          
				}

				$reviews[]=array(
					
					'user_id'=>$rv->review_received,
					'name'=>$rv->name,
					'review_provided'=>$rv->review_provided,
					'country'=>$rv->country,
					'state'=>$rv->state,
					'city'=>$rv->city,
					'profile_image'=>$user_profile_image,
					'profile_id'=>$rv->profile_id,
					
					'coins'=>$rv->coins	
				);
			}			
		}


                  $useid=$CI->Microkeys->get_microkey_info_by_id($taskID);
                 
                  $username = $CI->db->get_where('users',array('user_id'=>$useid->user_id))->row();
                 $skills=$useid->skills;
                $b = str_replace( ',', '', $skills );
                $c = strlen($skills); 
                $tyy = "";
                for($i=0;$i<$c;$i++){
                  $val= $skills[$i];
                  if($val!==','){
                   
                    $skils_name=$CI->db->get_where('area_of_interest',array('area_of_interest_id'=>$val))->row();
                  
                    $tyy .= '<a href="#">'.$skils_name->name.'</a>&nbsp;&nbsp;';
                  }
                }
              
                $data['portfolio_link1'] = $microkeyData->portfolio_link1;   
                $data['portfolio_link2'] = $microkeyData->portfolio_link2;   
                $data['portfolio_link3'] = $microkeyData->portfolio_link3;   
                $data['portfolio_link4'] = $microkeyData->portfolio_link4;   
                $data['portfolio_desc1'] = $microkeyData->portfolio_desc1;   
                $data['portfolio_desc2'] = $microkeyData->portfolio_desc2;   
                $data['portfolio_desc3'] = $microkeyData->portfolio_desc3;   
                $data['portfolio_desc4'] = $microkeyData->portfolio_desc4; 
                $data['microkey_freelicer_name']=$username->name;
                $data['microkey_skills'] = $microkeyData->skills;
                $data['microkey_id'] = $microkeyData->id;
                $data['title'] = $microkeyData->title; 
                $data['microkey_skills1'] = $tyy; 
				$data['microkey_category'] = $microkeyData->category;
				$data['microkey_subcategory'] = $microkeyData->subcategory;
				$data['microkey_description'] = $microkeyData->description;
				$data['microkey_image'] = $microkey_image_path;
				$data['portfolio_img1'] = $microkey_image_path1;
				$data['portfolio_img2'] = $microkey_image_path2;
				$data['portfolio_img3'] = $microkey_image_path3;
				$data['portfolio_img4'] = $microkey_image_path4;
				$data['user_name'] = $userData['basic_info']->name;
				$data['user_city'] = $userData['basic_info']->city;
				$data['user_state'] = $userData['basic_info']->state;
				$data['user_country'] = $userData['basic_info']->country;
				$data['user_total_positive_coins'] = $total_positive_coins;
				$data['user_total_negative_coins'] = $total_negative_coins;
				$data['user_image'] = $user_profile_image;
				$data['user_skills'] = $user_skills;
				$data['microkey_image'] = $microkey_image_path;
				$data['user_projects'] = $projectCount;
				$data['reviews'] = $reviews;
				$data['last_login'] = "Last Login 9.08.20, 10.30 P.M";

				
                #Abhishek
			
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/microkey-details',$data);
		$this->load->view('admin/includes/admin_footer_all');	
	
		
	} 
	#Client Micro Key Abhishek
	public function client_micro_list(){
		
		$data['categorylist'] = $this->Admimodel->get_micro_client_data();
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/client_micro_list',$data);
		$this->load->view('admin/includes/admin_footer_all');
	} 
	#Client Micro Key Abhishek
	#Abhishek 
	#Abhishek 
	public function freelancer_micro_list($status = ""){
		$data['userlist'] = $this->Admimodel->get_freelancer_micro_list($usertype = 4, $status);
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/user_micro_list',$data);
		$this->load->view('admin/includes/admin_footer_all');			
	}
	#change Micro Status  Abhishek
		public function change_status_micro_freelincer($id,$selectedData ){
		//$changeVal = $_POST['action'];
		//$response=array();
		$id = $id;
		
		$selectedData = $selectedData ; 
		
		$return = $this->Admimodel->update_micro_freelincer_status($id,$selectedData);
		
		if($return == 'updated'){
			echo "1";
			
		}else{
			echo "0";
		}
		
		
	}
#change Micro Status Abhishek
	public function naluacer_list(){
			$data['userlist'] = $this->Admimodel->get_user_list($usertype = 5);
			
			$this->load->view('admin/includes/admin_header_all');
			$this->load->view('admin/includes/navbar');
			$this->load->view('admin/pages/user_list',$data);
			$this->load->view('admin/includes/admin_footer_all');			
	}
	#Abhishek 
	public function category(){
		
		$data['categorylist'] = $this->Admimodel->get_category();
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/category',$data);
		$this->load->view('admin/includes/admin_footer_all');
	} 
	public function sub_category_listing($cat_val){
		
		$data['categorylist'] = $this->Admimodel->get_sub_category_data($cat_val);
		$data['CategoryName'] = $cat_val;
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/sub_category',$data);
		$this->load->view('admin/includes/admin_footer_all');
	} 
	public function subctgeory_data($cat_val){
		
		$sucateory_report = $this->Admimodel->get_sub_category_data($cat_val);
		foreach ($sucateory_report as $key => $row) {
			echo "<option value=".$row->category_name.">". $row->category_name."</option>";
		}
	}
#End Abhishek 
	public function category_list(){
		
		$data['categorylist'] = $this->Admimodel->get_category_list();
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/category_list',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	
	public function change_status(){
		//$changeVal = $_POST['action'];
		//$response=array();
		$row_id = $_POST['pk'];
		$selectedData = $_POST['selectedData']; 
		
		$return = $this->Admimodel->update_ticket_status($row_id,$selectedData);
		
		if($return == 'updated'){
			echo "1";
			
		}else{
			echo "0";
		}
		
		
	}
	
	public function category_add(){
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$this->form_validation->set_rules('name','Category Name', 'required');
			
			$submitData = array(
				'name' => $this->input->post('name'),
				'detail' => $this->input->post('detail'),
				'status' => $this->input->post('status'),
				'dom' => date('Y-m-d H:i:s'),
				'deleted' => 0
			); ;  
			
			$rowid = $this->input->post('row_id');
			if($this->form_validation->run() == false){ 
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '.validation_errors().'</div>');
				redirect('admin/category-add');
			}else{
				$return = $this->Admimodel->insert_data('area_of_interest',$submitData); 
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Data update successfully.
	</div>');
				redirect('admin/category-list');
			}
		}
			
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/category_add');
		$this->load->view('admin/includes/admin_footer_all');
		
	}
	#abhishek Jha
	public function category_add_skills(){
		
		$data['catgory_data'] = $this->Admimodel->get_category_skills();
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/category_add_skills',$data);
		$this->load->view('admin/includes/admin_footer_all');
		
	}
	public function category_skills_add(){
		$data =  array('category_name' => $this->input->post('category_name'),'parent_id'=>$this->input->post('parent_id'),'status'=>1 );
		
		$this->db->insert('skillcategory',$data);
		redirect('admin/category');
	}
	public function cat_id_data($category_id){
		$s_cat_id=$this->Admimodel->cat_id_data($category_id);
		return $s_cat_id->category_id;

	}
	public function category_edit_skills($category_id){
		
		$data['catgory_data'] = $this->Admimodel->get_sub_category_single($category_id);
		$data['skill_catgory_data'] = $this->Admimodel->get_category_skills();
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/category_edit_skills',$data);
		$this->load->view('admin/includes/admin_footer_all');
		
	}
	public function category_skills_update(){
		$id_data = $this->input->post('category_id');
		$data =  array('category_name' => $this->input->post('category_name'),'parent_id'=>$this->input->post('parent_id'),'status'=>1 );
		$this->db->where('category_id', $id_data);
		$this->db->update('skillcategory',$data);
		redirect('admin/category');
	}

	public function delete_catgory($category_id){
		$data =  array('status'=>0 );
		$this->db->where('category_id', $category_id);
		$this->db->update('skillcategory',$data);
		redirect('admin/category');
	}
	#abhishek Jha
	public function category_edit(){
		$rowid = ($this->uri->segment(3) !='') ? $this->uri->segment(3) : '';
		$data['info'] = $this->Admimodel->get_category_info($rowid);
		
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$this->form_validation->set_rules('name','Category Name', 'required');
			
			$submitData = array(
				'name' => $this->input->post('name'),
				'detail' => $this->input->post('detail'),
				'status' => $this->input->post('status'),
				'dom' => date('Y-m-d H:i:s'),
				'deleted' => $this->input->post('deleted')
			); ;  
			
			$rowid = $this->input->post('row_id');
			if($this->form_validation->run() == false){ 
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong> '.validation_errors().'</div>');
				redirect('admin/category-edit/'.$rowid);
			}else{
				$return = $this->Admimodel->update('area_of_interest',$submitData,$chkfield='area_of_interest_id',base64_decode($rowid)); 
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Data update successfully.
	</div>');
				redirect('admin/category-list');
			}
		}
			
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/category_edit',$data);
		$this->load->view('admin/includes/admin_footer_all');
		
	}
	
	public function task_list(){
		
		$data['info'] = $this->Admimodel->get_post_list();
		
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/task_list',$data);
		$this->load->view('admin/includes/admin_footer_all');
		
	}
	
	public function problem_ticket_list($problem_status = ""){
            $problem_status = trim(strtolower($problem_status));
             $data['status']=trim(strtolower($problem_status));
            if ($problem_status != "" && in_array($problem_status, array("solved", "unsolved"))) {
				$data['info'] = $this->Admimodel->get_problem_ticket_list($problem_status);
				$this->load->view('admin/includes/admin_header_all');
				$this->load->view('admin/includes/navbar');
				$this->load->view('admin/pages/problem_ticket_list',$data);
				$this->load->view('admin/includes/admin_footer_all');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You haven\'t login to the portal. Please login to proceed further.</div>');
				redirect('dashboard', 'refresh');                
            }
	}
	// public function user_messages($user_id = ""){
 //            $data['user_message'] = $this->Admimodel->get_message_users();
 //            $this->load->view('admin/includes/admin_header_all');
 //            $this->load->view('admin/includes/navbar');
 //            $this->load->view('admin/pages/messages_list',$data);
 //            $this->load->view('admin/includes/admin_footer_all');
	// }

	public function user_messages($user_id = ""){
            $data['user_message'] = $this->Admimodel->get_message_users_list();
            $this->load->view('admin/includes/admin_header_all');
            $this->load->view('admin/includes/navbar');
            $this->load->view('admin/pages/messages_list',$data);
            $this->load->view('admin/includes/admin_footer_all');
	}

	public function get_message_userss(){
		$data['user_message'] = $this->Admimodel->get_message_userss_model();
            $this->load->view('admin/includes/admin_header_all');
            $this->load->view('admin/includes/navbar');
            $this->load->view('admin/pages/all_messages_list',$data);
            $this->load->view('admin/includes/admin_footer_all');
	}
		public function get_message_users_outbox(){
		$data['user_message'] = $this->Admimodel->get_message_userss_outbox_model();
            $this->load->view('admin/includes/admin_header_all');
            $this->load->view('admin/includes/navbar');
            $this->load->view('admin/pages/outbox',$data);
            $this->load->view('admin/includes/admin_footer_all');
	}
	
	
	public function view_messages($user_id = ""){
            if ($user_id != "") {
				  $data['user_message'] = $this->Admimodel->get_message_users();
				$data['messages'] = $this->Admimodel->get_messages($user_id);
			     $get_user           = $this->Admimodel->get_user_info($user_id);
                $data['send_mail']  = isset($get_user->email) ? $get_user->email : '';
                $data['user_id']    = ($user_id != "") ? $user_id : '';
                $CI = & get_instance();
				$userData = $CI->Users->get_user_profile_info_by_id($user_id);
				$data['otheruserInfo'] = $userData;
			//dd($data);die;
				$this->load->view('admin/includes/admin_header_all');
				$this->load->view('admin/includes/navbar');
				$this->load->view('admin/pages/messages_view_list',$data);
				$this->load->view('admin/includes/admin_footer_all');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You haven\'t login to the portal. Please login to proceed further.</div>');
        	redirect('dashboard', 'refresh');                
            }
	}
		public function outbox_view_messages($user_id = ""){
            if ($user_id != "") {
		$data['messages'] = $this->Admimodel->outbox_get_user_messages($user_id);
                $this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/outbox_messages_view_list',$data);
		$this->load->view('admin/includes/admin_footer_all');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-info text-center">You haven\'t login to the portal. Please login to proceed further.</div>');
        	redirect('dashboard', 'refresh');                
            }
	}

	public function problem_ticket_history(){
		$data['info'] = $this->Admimodel->get_problem_ticket_history();
		
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/problem_ticket_history',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}



	
	public function faq_list(){
		$data['info'] = array();
		
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/faq_list',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	
	
	public function notification_list(){
		$data['info'] = array();
		
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/notification_list',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	
	public function notification_add(){
		$data['info'] = array();
		
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/notification_add',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	
	public function problem_ticket_answer(){
		$data['info'] = array();
		
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/problem_ticket_answer',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	
	public function faq_add(){
		$data['info'] = array();
		
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/faq_add',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	
	public function site_settings(){
		$data['info'] = array();
		
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/site_settings',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	
	public function user_query(){
		$data['info'] = $this->Admimodel->get_user_query();
		
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/user_query',$data);
		$this->load->view('admin/includes/admin_footer_all');
	}
	public function problem_ticket_details($id)
	{
		$data['info'] = $this->Admimodel->problem_ticket_details($id);
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/problem_ticket_details', $data);
		$this->load->view('admin/includes/admin_footer_all');
	}

	public function history_ticket_details_copy($id)
		{
			$data['info'] = $this->Admimodel->history_ticket_details($id);
			$this->load->view('admin/includes/admin_header_all');
			$this->load->view('admin/includes/navbar');
			$this->load->view('admin/pages/history_ticket_details', $data);
			$this->load->view('admin/includes/admin_footer_all');
		}
	public function history_ticket_details($problem_ticket_no)
		{
			$data['info'] = $this->Admimodel->history_ticket_details($problem_ticket_no);
			$data['user_details'] = $this->Admimodel->ticket_details($problem_ticket_no);
			$data['problem_ticket_no'] = $problem_ticket_no;

            $data['send_mail'] = isset($data['user_details']->email) ? $data['user_details']->email : '';
            $data['user_id'] = isset($data['user_details']->user_id) ? $data['user_details']->user_id : '';

		//echo "<pre>";Print_r($data);die;
			$this->load->view('admin/includes/admin_header_all');
			$this->load->view('admin/includes/navbar');
			$this->load->view('admin/pages/history_ticket_details', $data);
			$this->load->view('admin/includes/admin_footer_all');
		}


        public function compose_email($grievance_id) {
            $data['grievance_id'] = $grievance_id;

            $get_email = $this->Admimodel->get_ticket_email($grievance_id);
            $data['send_mail'] = isset($get_email->email) ? $get_email->email : '';
            $data['user_id'] = isset($get_email->user_id) ? $get_email->user_id : '';

            $this->load->view('admin/includes/admin_header_all');
            $this->load->view('admin/includes/navbar');
            $this->load->view('admin/pages/grievance_email', $data);
            $this->load->view('admin/includes/admin_footer_all');
        }

	public function compose_email_history($ticket_id)
	{
		$g_id = $this->Admimodel->get_grievance_id($ticket_id);
		$grievance_id = $g_id->id;
		$data['grievance_id'] = $grievance_id;
		$data['from'] = 'history';

		$get_email = $this->Admimodel->get_ticket_email($grievance_id);
                $data['send_mail'] = isset($get_email->email) ? $get_email->email : '';
 
		$this->load->view('admin/includes/admin_header_all');
		$this->load->view('admin/includes/navbar');
		$this->load->view('admin/pages/grievance_email', $data);
		$this->load->view('admin/includes/admin_footer_all');
	}

	public function send_email() {
            $post_data = $this->input->post();
			
            $this->load->model('Users');
            $this->load->model('Messages');
            $problem_ticket_no       = $this->input->post('problem_ticket_no');
            $userIdTo       = $this->input->post('user_id');
            $message_data   = array('msg' => $post_data['email_body'],'problem_ticket_no' => $problem_ticket_no);
					  $get_email = $this->Admimodel->store_ticket($post_data);
	
            $result         = $this->Messages->add_user_message($message_data, $userIdTo);
            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Email Send successfully.</div>');
            redirect(base_url() . 'admin/history_ticket_details/' . $problem_ticket_no, 'refresh');
    //        $get_email = $this->Admimodel->store_ticket_history($post_data);
    //        $from = $post_data['from'];
    //        $this->db->insert('grievance_emails', [
    //            'grievance_id' => $post_data['grievance_id'],
    //            //'email_from' => $post_data['email_from'],
    //            'email_to' => $post_data['email_to'],
    //            'email_cc' => $post_data['cc'],
    //            'email_bcc' => $post_data['bcc'],
    //            'email_subject' => $post_data['email_subject'],
    //            'email_body' => $post_data['email_body'],
    //            'doc' => date('Y-m-d h:i:s'),
    //            'dom' => null
    //        ]);


    //        $this->load->library('email');
    //        $this->email->set_newline("\r\n");
    //        $this->email->from("admin@hirenwork.com");
    //        $this->email->to($post_data['email_to']);
    //        if (!empty($post_data['cc']))
    //            $this->email->cc($post_data['cc']);
    //        if (!empty($post_data['bcc']))
    //            $this->email->cc($post_data['bcc']);
    //        $this->email->subject($post_data['email_subject']);
    //        $this->email->message($post_data['email_body']);
    //        if ($this->email->send()) {
    //            $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Email Send successfully.
    //			</div>');
    //
    //            if ($from == '')
    //                redirect('admin/problem-ticket');
    //            else
    //                redirect('admin/problem_ticket_list');
    //        }
//            show_error($this->email->print_debugger());
            return false;
            
        }
	public function replay_user_message($userIdTo = "") {

            if ($userIdTo != ""){
			
                if ($this->input->server('REQUEST_METHOD') == 'POST') {                
                    $post_data = $this->input->post();
                    $this->load->model('Users');
                    $this->load->model('Messages');
                    $userIdTo       = $this->input->post('user_id');
                    $message_data   = array('msg' => $post_data['email_body']);
					$message_id 	= $this->input->post('message_id');
					if($message_id == 0)
					$this->Messages->add_user_message($message_data, $userIdTo);
					else
					$this->Messages->update_user_message($message_data, $userIdTo, $message_id);	
                    $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Message successfully.</div>');
                    redirect('admin/view-messages/' .$userIdTo );
                }
                $get_user           = $this->Admimodel->get_user_info($userIdTo);
                $data['send_mail']  = isset($get_user->email) ? $get_user->email : '';
                $data['user_id']    = ($userIdTo != "") ? $userIdTo : '';

                $this->load->view('admin/includes/admin_header_all');
                $this->load->view('admin/includes/navbar');
                $this->load->view('admin/pages/replay_user_message', $data);
                $this->load->view('admin/includes/admin_footer_all');
            } else {
                redirect('dashboard', 'refresh');
            }
        }
	public function get_notification() {
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $this->load->model("Admin_notification");
                $sql            = "select admin_notification.* from admin_notification where admin_notification.is_read = 'N' order by id desc";
                $query          = $this->db->query($sql);
                $notifications  = $query->result();
                $data['notifications'] = $notifications;
                $notification_html = $this->load->view('admin/pages/notifications_html', $data, true);
                echo $notification_html;
            }
        }
		
		public function naluacer_detail(){
			$data['userlist'] = $this->Admimodel->naluacer_detail_model();
			$this->load->view('admin/includes/admin_header_all');
			$this->load->view('admin/includes/navbar');
			$this->load->view('admin/pages/naluncer_detail', $data);
			$this->load->view('admin/includes/admin_footer_all');
		}
		/*public function updatenotif(){
			$userId=$_GET['user_id'];
			$upd_array=array(
			'notify_status' => 1
			);
			$this->db->where('user_id_from', $userId);
		    $this->db->update('admin_notification', $upd_array);
			//$ui=base64_encode($row->user_id);
			//redirect('/admin/user/delete/'.$ui.'');
			return true;
		}*/
		public function client_task(){
			//$id=$this->uri->segment(4);
			$query= "SELECT * FROM microkey_client";
			$exe= $this->db->query($query);
			$result  = $exe->result();
			$data['tasks'] = $result;
			    $this->load->view('admin/includes/admin_header_all');
                $this->load->view('admin/includes/navbar');
                $this->load->view('admin/pages/client_task', $data);
                $this->load->view('admin/includes/admin_footer_all');
		}
		
		
		
		public function view_messages_ajax($user_id = ""){
            if ($user_id != "") {
				  $data['user_message'] = $this->Admimodel->get_message_users();
				$data['messages'] = $this->Admimodel->get_messages($user_id);
			     $get_user           = $this->Admimodel->get_user_info($user_id);
                $data['send_mail']  = isset($get_user->email) ? $get_user->email : '';
                $data['user_id']    = ($user_id != "") ? $user_id : '';
                $CI = & get_instance();
				$userData = $CI->Users->get_user_profile_info_by_id($user_id);
				$data['otheruserInfo'] = $userData;
			    //dd($data);die;
				$this->load->view('admin/pages/messages_view_list_ajax',$data);
            } 
	}
	
	
	
	public function get_frndlist($user_id_to) {
        $content = $this->Messages->get_friend_list_admin($user_id_to);
        $data = array(
            'content' => $content
        );
        $this->load->view('admin/pages/friendList_ajax', $data);
    }
	
	
	public function user_messages_ajax($user_id = ""){
            $data['user_message'] = $this->Admimodel->get_message_users_list_ajax();
            $this->load->view('admin/pages/messages_list_ajax',$data);
	}
}