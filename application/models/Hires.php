<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Hires extends CI_Model {



	public function __construct(){
		parent::__construct();
        $this->load->model('Users');
	}	

	public function get_task_data_by_user($freelancer_id =""){

		$user_id = $this->session->userdata('user_id');

		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('task_proposal','task.task_id=task_proposal.task_id');

		if($freelancer_id !=""){
			$this->db->join('task_hired','task.task_id=task_hired.task_id');
			$this->db->where('task_hired.freelancer_id',$freelancer_id);	
		}
		$this->db->where('task.task_created_by',$user_id);
		$this->db->where('task.task_is_ongoing',0);	
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_is_complete',0);
		$this->db->where('task.task_is_cancelled',0);
		$this->db->where('task.task_is_deleted',0);
		$this->db->group_by('task.task_id');
		
		$query = $this->db->get();
		//echo $this->db->last_query(); exit();

		if($query->num_rows() >0){
			return $query->result();

		}else{

			return array();

		}

	}

	public function task_data_for_directHire(){

		$user_id = $this->session->userdata('user_id');

		$this->db->select('*');
		$this->db->from('task');
		$this->db->where('task.task_created_by',$user_id);
		$this->db->where('task.task_hired',0);
		$this->db->where('task.task_is_ongoing',0);
		$this->db->where('task.task_status',1);
		$this->db->where('task.task_is_complete',0);
		$this->db->where('task.task_is_cancelled',0);
		$this->db->where('task.task_is_deleted',0);
		$this->db->group_by('task.task_id');
		//echo $this->db->last_query(); exit();
		$query = $this->db->get();
		if($query->num_rows() >0){
			return $query->result();

		}else{

			return array();

		}

	}



	public function get_task_data_by_usertaskid($usertaskid){

		$user_id = $this->session->userdata('user_id');

		$this->db->select('*');

		$this->db->from('task');

		$this->db->where('task_created_by',$user_id);

		$this->db->where('user_task_id',$usertaskid);

		// $this->db->where('task_is_ongoing',0);

		// $this->db->where('task_status',1);

		$query = $this->db->get();

		// echo $this->db->last_query();exit;

		if($query->num_rows() >0){

			 //return $query->result_array();

			 

			 foreach ($query->result() as $row){



				$task_attachments = $task_requirements = array();

	

	

				$this->db->select('task_attachments.*');

	

				$this->db->from('task_attachments');

	

				$this->db->where('task_attachments.task_id', $row->task_id);

	

				$this->db->where('task_attachments.is_deleted',0);

	

				$query_task_attach = $this->db->get();

	

				//echo $this->db->last_query();

	

				foreach ($query_task_attach->result() as $row_task_attach){

	

					//$arrFileName = explode('_', $row_task_attach->task_attach_filename);

					//$arrFileName = $row_task_attach->task_attach_filename;

					

					$arrFileName = explode('_', $row_task_attach->task_attach_filename);

					

					$task_attachments[] = array('file_name' => $row_task_attach->task_attach_filename, 'file_display_name' => end($arrFileName) , 'task_attachment_id' => $row_task_attach->task_attachment_id);

	

				} 

	

				 

				$c=count($query_task_attach->result());

				$t=4-$c;

				$new_attachment="";

				for($i=0;$i<$t;$i++){

					 $new_attachment.='<div class="col-sm-3"><input type="file" name="fldTaskDocuments[]"  class="dropify" multiple /></div>';

				}

				

	

	 

				$this->db->select('task_requirements.area_of_interest_id,area_of_interest.name,task_requirements.task_id');

	

				$this->db->from('task_requirements');

	

				$this->db->join('area_of_interest', 'area_of_interest.area_of_interest_id = task_requirements.area_of_interest_id');

	

				$this->db->where('task_requirements.task_id', $row->task_id);

	

				$this->db->where('task_requirements.deleted',0);

	

				$query_task_requirements = $this->db->get();

	

				//echo $this->db->last_query();

	

				foreach ($query_task_requirements->result() as $row_task_requirement){

	

					$task_requirements[] = array('skill_id' => $row_task_requirement->area_of_interest_id, 'skill_name' => $row_task_requirement->name, 'task_id' => $row_task_requirement->task_id);

	

				}

	

				$basic_info = array('task_name'=> $row->task_name, 'task_id' => $row->task_id, 'user_task_id' => $row->user_task_id, 'task_keywords' => $row->task_keywords,'task_details' => $row->task_details, 'task_due_date' => date('m-d-Y', strtotime($row->task_due_date)), 'task_origin_location' => $row->task_origin_location, 'task_origin_country' => $row->task_origin_country, 'task_total_budget' => $row->task_total_budget,'milestone_type' => $row->milestone_type,'task_hired'=>$row->task_hired,'task_is_ongoing'=>$row->task_is_ongoing,'task_status'=>$row->task_status, "task_duration" => $row->task_duration, "task_duration_type" => $row->task_duration_type);

	

	

	

				$task_details[] = array('basic_info' => $basic_info, 'task_attachments' => $task_attachments,'new_attachment'=>$new_attachment, 'task_requirements' => $task_requirements);

	

			}



			return $task_details;

		}else{

			return array();

		}

	}



	public function hire_direct_data_insert($postValue = array()){

        $date_of_creation = date("Y-m-d H:i:s");

		if(empty($postValue)){
        	$response =  array('status' => FALSE, 'message' => 'invalid_data');

		}else{
			$user_task_id= $postValue['fldJobTitle'];
			$freelancer_id= $postValue['freelancer_id'];

			$get_info = $this->Tasks->get_task_info_by_user_task_id($user_task_id);
			//print_r($get_info); exit();
			if(!empty($get_info)){
				$task_id = $get_info->task_id;
				$task_budget = $get_info->task_total_budget;
			}	
			//check already hired

			$checkData = $this->db->select('hired_id')->from('task_hired')->where('task_id',$task_id)->where('freelancer_id',$freelancer_id)->get();
			//echo "<pre>";echo $checkData->num_rows();  exit();

			if($checkData->num_rows()== 0){

				if($postValue['terms'] == 'pay_by_milestone'){
					$deposit = $postValue['deposit'];

				}else{
					$deposit = $postValue['deposit'];
				}

				if($postValue['task_duration_type'] == "Hourly") {

					$madu = "hours";

				} else if($postValue['task_duration_type'] == "Daily") {

					$madu = "days";

				} else if($postValue['task_duration_type'] == "Monthly"){

					$madu = "months";

				} else {

					$madu = "years";

				}

				$his = date("H:i:s");
				$hire_start_date = date("Y-m-d $his", strtotime($postValue['hire_date']));
				$mdur = "+".$postValue['task_duration']." ".$madu;
				$hired_end_date = date("Y-m-d H:i:s", strtotime($mdur, strtotime($hire_start_date)));


				$proposaldata = array(
					'task_id' => $task_id,
					'user_id' => $postValue['freelancer_id'],
					'terms_amount_max' => $task_budget,
					'cover_letter' =>'SEND HIRED',
					'doc' => $date_of_creation,
					'dom' => $date_of_creation,
				);

				 $proposal_id = $this->addNewRecord('task_proposal',$proposaldata);

				$hiredata = array(
					'task_id' 	   => $task_id,
					'proposal_id' => $proposal_id,
					'user_task_id' => $user_task_id,
					'freelancer_id'=> $postValue['freelancer_id'],
					'hired_title'  => "SEND HIRED",
					'agreed_term'  => $postValue['terms'],
					'agreed_budget'=> $task_budget,
					'term_amount'  => $postValue['amount'],
					'deposit' 	   => $deposit,
					'hire_date'    => $hire_start_date,
					'hired_end_date'=> $hired_end_date,
					'hired_details'=> $postValue['hire_details'],
					'hired_doc'    => $date_of_creation,
					'hired_dom'	   => $date_of_creation,
				);
				//print_r($hiredata); exit();
				$hired_id = $this->addNewRecord('task_hired',$hiredata);

				if($postValue['terms'] == 'pay_by_milestone'){

					if(isset($postValue['milestone_title'])){
						$mlsno=1;

						foreach($postValue['milestone_title'] as $key => $row){		 //echo $key; echo $row;	

							$date = date_parse_from_format("m-d-Y", $postValue['milestone_end_date'][$key]);

							$milestone_date=$date['year']."-".$date["month"]."-".$date["day"];

							$data_milestone = array(

								'proposal_id' => $proposal_id,
								'hired_id' => $hired_id,
								'milestone_title' => $postValue['milestone_title'][$key],
								'milestone_end_date' => date('Y-m-d H:i:s',strtotime($milestone_date)),
								'milestone_agreed_budget' => $postValue['milestone_agreed_budget'][$key],
								'milestone_type' => 'milestone',
								'milestone_doc' => $date_of_creation,
								'milestone_created_by' => $this->session->userdata('user_id'),
								'milestone_current_status'=>'NR'

							);

							//echo '<pre>'; print_r($data_milestone);
							$firstmils = $this->addNewRecord('task_proposal_milestone',$data_milestone);
							if(trim($postValue['deposit']) == 'deposit_fund_now' && $mlsno==1){
								$milestone_id = $user_task_id.'-'.$firstmils;
							}

							$mlsno++;
						}

					}else{

						return array('status' => FALSE, 'message' => 'Something Wrong');
					}


				}else{

					$data_milestone = array(
						'proposal_id' => $proposal_id,
						'hired_id' => $hired_id,
						'milestone_title' => $postValue['contract_title'],
						'milestone_end_date' => $hired_end_date,
						'milestone_agreed_budget' => $postValue['amount'],
						'milestone_type' => 'fixed',
						'milestone_approval_date' => $date_of_creation,
						'milestone_doc' => $date_of_creation,
						'milestone_created_by' => $this->session->userdata('user_id')
					);
					//echo '<pre>'; print_r($data_milestone);
					$firstmils = $this->addNewRecord('task_proposal_milestone',$data_milestone);

					if(trim($postValue['deposit']) == 'deposit_fund_now'){
						$milestone_id = $user_task_id.'-'.$firstmils;
					}					
				}

				// project title

				$task_query = $this->db->select('task.*')->from('task')->where('task_id',$task_id)->get();

				if($task_query->num_rows() >0){

					$task_info = $task_query->row();
					$task_name = $task_info->task_name;
					$user_task_id = $task_info->user_task_id;
				}else{
					$task_name = $user_task_id = '';
				}

				$job_details_link = '<a href="'.base_url().'hired-job-details/'.$user_task_id.'">'.$task_name.'</a>';
				// // insert notification
				 $notidata = array(
				 	'task_id' => $task_id,
				 	'offer_id' => 0,
				 	'notification_master_id' => 11,
				 	'notification_from' => $this->session->userdata('user_id'),
				 	'notification_to' => $postValue['freelancer_id'],
				 	'notification_details' => 'SEND HIRED ',
				 	'notification_message' => '<strong>'.'<a href="'.base_url().'public-profile/'.$this->session->userdata('profile_id').'">'.$this->session->userdata('user_name').'</a></strong> wants to hire you for <strong> '.$job_details_link.' </strong>',
				 	'notification_doc' => date('Y-m-d H:i:s')
				 );

					$this->db->insert('task_notification',$notidata);
					
					$response = array('status' => TRUE, 'message' => 'Hire request has been sent successfully.','milestone_id'=>$milestone_id);

				}else{
					$response = array('status' => FALSE, 'message' => 'Request has been sent already.','milestone_id'=>"");
				}
			}
			return $response;

		}

	public function addNewRecord($table,$data) {
	  $this->db->insert($table, $data);
	  //echo $this->db->last_query(); //exit();
	  $last_id = $this->db->insert_id();
	  return $last_id;
	}

	public function hire_data_new_insert($postValue = array()){

        

		// echo '<pre>';	print_r($postValue);exit;
		//echo date('Y-m-d H:i:s',strtotime($postValue['milestone_end_date'][2]));
		/* 	 $date = date_parse_from_format("m-d-Y", $postValue['milestone_end_date'][1]);
		 $m= $date['year']."-".$date["month"]."-".$date["day"];
		 echo date('Y-m-d H:i:s',strtotime($m));
		 echo "<pre/>";
		 print_r($date);
		 die('model'); */

		if(empty($postValue)){
        	return array('status' => FALSE, 'message' => 'invalid_data');
		}else{
			// get task_id by user_task_id
			$get_info = $this->Tasks->get_task_info_by_user_task_id($user_task_id = $postValue['fldJobTitle']);

			if(!empty($get_info)){

				$task_id = $get_info->task_id;
				$task_budget = $get_info->task_total_budget;
			}
			// check already hired
			$checkData=$this->db->select('hired_id')->from('task_hired')->where('task_id',$task_id)->where('freelancer_id',$postValue['freelancer_id'])->get();

			if($checkData->num_rows() == 0){

				$date_of_creation = date("Y-m-d H:i:s");

				if($postValue['task_duration_type'] == "Hourly") {
					$madu = "hours";
				} else if($postValue['task_duration_type'] == "Daily") {
					$madu = "days";
				} else if($postValue['task_duration_type'] == "Monthly"){
					$madu = "months";
				} else {
					$madu = "years";
				}
				$his = date("H:i:s");
				$hire_start_date = date("Y-m-d $his", strtotime($date_of_creation)); // $postValue['hire_date']

				$mdur = "+".$postValue['task_duration']." ".$madu;

				$hired_end_date = date("Y-m-d H:i:s", strtotime($mdur, strtotime($hire_start_date)));

				$data = array(

					'task_id' => $task_id,
					'user_task_id' => $postValue['fldJobTitle'],
					'freelancer_id' => $postValue['freelancer_id'],
					'hired_title' => $postValue['contract_title'],
					'agreed_term' => $postValue['terms'],
					'agreed_budget' => $task_budget,
					'term_amount' => $postValue['amount'],
					// 'deposit' => $postValue['deposit'],
					'proposal_id' => $postValue['proposal_id'],
					// 'hired_end_date' => date('Y-m-d H:i:s',strtotime($postValue['due_date'])),
					'hire_date' => $hire_start_date,
					'hired_end_date' => $hired_end_date,
					'hired_details' => $postValue['hire_details'],
					'hired_doc' => $date_of_creation,
					'hired_dom' => $date_of_creation,

				);

				//echo '<pre>';	print_r($data);exit;



				$this->db->insert('task_hired',$data);

				$insert_id = $this->db->insert_id();

				

				// if($postValue['terms'] == 'pay_by_milestone'){

				// 	if(isset($postValue['milestone_title'])){

				// 		$this->db->insert('task_hired',$data);

				// 		$insert_id = $this->db->insert_id();

						

				// 		foreach($postValue['milestone_title'] as $key => $row){		 //echo $key; echo $row;	

				// 			$date = date_parse_from_format("m-d-Y", $postValue['milestone_end_date'][$key]);

				// 			$milestone_date=$date['year']."-".$date["month"]."-".$date["day"];

				// 			$data_milestone = array(

				// 				'hired_id' => $insert_id,

				// 				'milestone_title' => $postValue['milestone_title'][$key],

				// 				'milestone_end_date' => date('Y-m-d H:i:s',strtotime($milestone_date)),

				// 				'milestone_agreed_budget' => $postValue['milestone_agreed_budget'][$key],

				// 				'milestone_doc' => $date_of_creation,

				// 				'milestone_created_by' => $this->session->userdata('user_id')

				// 			);

							

				// 			//echo '<pre>'; print_r($data_milestone);

							

				// 			$this->db->insert('task_hired_milestone',$data_milestone);

				// 		}

				// 	}else{

				// 		return array('status' => FALSE, 'message' => 'Something Wrong');

				// 	}

				// }else{

				// 	$this->db->insert('task_hired',$data);

				// 	$insert_id = $this->db->insert_id();

					

				// 	$data_milestone = array(

				// 		'hired_id' => $insert_id,

				// 		'milestone_title' => $postValue['contract_title'],

				// 		'milestone_end_date' => $hired_end_date,

				// 		'milestone_agreed_budget' => $postValue['amount'],

						

				// 		'milestone_approval_date' => $date_of_creation,

				// 		'milestone_doc' => $date_of_creation,

				// 		'milestone_created_by' => $this->session->userdata('user_id')

				// 	);

					

				// 	//echo '<pre>'; print_r($data_milestone);

					

				// 	$this->db->insert('task_hired_milestone',$data_milestone);					

				// }

				

				// project title

				$task_query = $this->db->select('task.*')->from('task')->where('task_id',$task_id)->get();

				if($task_query->num_rows() >0){

					$task_info = $task_query->row();

					$task_name = $task_info->task_name;

					$user_task_id = $task_info->user_task_id;

				}else{

					$task_name = $user_task_id = '';

				}

				

				// $job_details_link = '<a href="'.base_url().'hired-job-details/'.$user_task_id.'">'.$task_name.'</a>';

				

				// // insert notification

				// $notidata = array(

				// 	'task_id' => $task_id,

				// 	'offer_id' => 0,

				// 	'notification_master_id' => 11,

				// 	'notification_from' => $this->session->userdata('user_id'),

				// 	'notification_to' => $postValue['freelancer_id'],

				// 	'notification_details' => 'SEND HIRED ',

				// 	'notification_message' => '<strong>'.'<a href="'.base_url().'public-profile/'.$this->session->userdata('profile_id').'">'.$this->session->userdata('user_name').'</a></strong> wants to hire you for <strong> '.$job_details_link.' </strong>',

				// 	'notification_doc' => date('Y-m-d H:i:s')

				// );

				// $this->db->insert('task_notification',$notidata);

				

				return array('status' => TRUE, 'message' => 'Hire request has been sent successfully.');

			}else{

				return array('status' => FALSE, 'message' => 'Request has been sent already.');

			}

		}

    }

	

	

	public function get_freelancer_info_by_id($freelancer_id = 0) {
        $freelancerList = array();
        $this->db->select('users.*,user_login.*,country.name as country');
        $this->db->from('users');
        $this->db->join('user_login', 'user_login.user_id = users.user_id');
		$this->db->join('country','country.country_id = users.country', 'left');
        $this->db->where('user_login.user_type', 4);
        $this->db->where('user_login.status', 1);
        $this->db->where_in('users.user_id',$freelancer_id);
        $query = $this->db->get();
        if($query->num_rows() > 0){
			$row = $query->row_array();
            $user_languages = $user_skills = array();
            // Get user selected languages
            $this->db->select('user_languages.language_id,languages.name');
            $this->db->from('user_languages');
            $this->db->join('languages', 'languages.language_id = user_languages.language_id');
            $this->db->where('user_languages.user_id', $freelancer_id);
            $query_lang = $this->db->get();
            foreach ($query_lang->result() as $row_lang){
                $user_languages[] = $row_lang->name;
            } 
            // Get user selected skills
            $this->db->select('user_area_of_interest.area_of_interest_id,area_of_interest.name,user_area_of_interest.user_id');

            $this->db->from('user_area_of_interest');

            $this->db->join('area_of_interest', 'area_of_interest.area_of_interest_id = user_area_of_interest.area_of_interest_id');

            $this->db->where('user_area_of_interest.user_id', $freelancer_id);

            $query_skill = $this->db->get();

            foreach ($query_skill->result() as $row_skill){

                $user_skills[] = array('skill_id' => $row_skill->area_of_interest_id, 'skill_name' => $row_skill->name, 'user_id' => $row_skill->user_id);

            }

            $freelancerData = array('basic_info' => $row, 'user_selected_languages' => $user_languages, 'user_selected_skills' => $user_skills);
		}

        return $freelancerData; 

	}	

	public function get_client_info_by_id($user_id = 0) {

        $freelancerList = array();

		        

        $this->db->select('users.*,user_login.*,country.name as country');

        $this->db->from('users');

        $this->db->join('user_login', 'user_login.user_id = users.user_id');

		$this->db->join('country','country.country_id = users.country', 'left');

        $this->db->where('user_login.user_type', 3);

        $this->db->where('user_login.status', 1);    

        $this->db->where_in('users.user_id',$user_id);            

        $query = $this->db->get();

        

        if($query->num_rows() > 0){

			

			$row = $query->row_array();

			

            $user_languages = $user_skills = array();



            // Get user selected languages

            $this->db->select('user_languages.language_id,languages.name');

            $this->db->from('user_languages');

            $this->db->join('languages', 'languages.language_id = user_languages.language_id');

            $this->db->where('user_languages.user_id', $user_id);

            $query_lang = $this->db->get();

            foreach ($query_lang->result() as $row_lang){

                $user_languages[] = $row_lang->name;

            } 



            // Get user selected skills

            $this->db->select('user_area_of_interest.area_of_interest_id,area_of_interest.name,user_area_of_interest.user_id');

            $this->db->from('user_area_of_interest');

            $this->db->join('area_of_interest', 'area_of_interest.area_of_interest_id = user_area_of_interest.area_of_interest_id');

            $this->db->where('user_area_of_interest.user_id', $user_id);

            $query_skill = $this->db->get();

            foreach ($query_skill->result() as $row_skill){

                $user_skills[] = array('skill_id' => $row_skill->area_of_interest_id, 'skill_name' => $row_skill->name, 'user_id' => $row_skill->user_id);

            }

			

			



            $freelancerData = array('basic_info' => $row, 'user_selected_languages' => $user_languages, 'user_selected_skills' => $user_skills);

        }

		

        return $freelancerData; 

	}

	

	public function get_contract_details_by_id($hired_id = 0){
		$hired_id = base64_decode($hired_id);
		$total_fund_deposited = $total_fund_spend = 0;
		if($hired_id != 0){
			$this->db->select('task_hired.*');
			$this->db->from('task_hired');
			$this->db->where('hired_id',$hired_id);
			$query = $this->db->get();
			if($query->num_rows() > 0){
				$return['contract_details'] = $query->row_array();
			}
		}else{
			$return['contract_details'] = array();
		}

		return $return;
	}	

	public function get_contract_details_by_task_id($task_id = 0){



		if($task_id != 0){

			$this->db->select('task_hired.*');

			$this->db->from('task_hired');

			$this->db->where('task_id',$task_id);

			$query = $this->db->get();

			if($query->num_rows() > 0){

				$return['contract_details'] = $query->row_array();

			}

		}else{

			$return['contract_details'] = array();

		}

		return $return;

	}	

	public function get_contract_details($hired_id = 0){

		$hired_id = base64_decode($hired_id);

		$total_fund_deposited = $total_fund_spend = 0;

		if($hired_id != 0){

			$this->db->select('task_hired.*');
			$this->db->from('task_hired');
			$this->db->where('hired_id',$hired_id);
			$query = $this->db->get();

		if($query->num_rows() > 0){

				$dataa = $query->result_array();
				//print_r($dataa); exit();
				$proposal_id = $dataa[0]['proposal_id']; 
				$user_task_id = $dataa[0]['user_task_id']; 
				$return['contract_details'] = $query->row_array();			
				
				/*$this->db->select('task_hired_milestone.*');
				$this->db->from('task_hired_milestone');
				$this->db->where('hired_id',$hired_id);
				$this->db->where('milestone_is_deleted',0);*/

				$this->db->select('task_proposal_milestone.*');
				$this->db->from('task_proposal_milestone');
				$this->db->where('proposal_id',$proposal_id);
				$this->db->where('milestone_is_deleted',0);

				$query2 = $this->db->get();
				//echo $this->db->last_query(); exit();

				$return['contract_details']['milestone_cnt'] = $query2->num_rows();

				if($query2->num_rows() >0){

					$milestonedata = $query2->result_array();	
					//echo "<pre>"; print_r($milestonedata); exit();			

					foreach($milestonedata as $row){

						$status = ''; $payment = '';
						$paymentMilstone = $user_task_id."-".$row['milestone_id'];

						if($row['milesone_payment_request_date'] !="" && $row['milesone_payment_request_date']!='0000-00-00 00:00:00'){
							$milesone_payment_request_date = date('d/m/Y',strtotime($row['milesone_payment_request_date']));
						} else{
							$milesone_payment_request_date = "NA";
						}

						//echo $milesone_payment_request_date ;

						if($row['milestone_agreed_budget'] > $row['milestone_fund_deposited']){
							$funddepositelink = '<a class="RNR DF" href="'.base_url().'hire/step-2/'.$paymentMilstone .'"> Deposit Fund</a>';
						}else{
							$funddepositelink = 'Fund Deposited';
						}
						
						if($row['milestone_current_status'] == 'NR'){

							$status = '<big> Payment Pending </big>';
							$payment = $funddepositelink;

						}else if($row['milestone_current_status'] == 'FS'){

							$status = '<small>In Escrow</small><p> Payment Requested: '.$milesone_payment_request_date.'</p>';
							$payment = '<a class="RNR" href="'.base_url().'release-approve/'.base64_encode($row['milestone_id']).'">Review & Release</a>';
							$total_fund_deposited = (int)$total_fund_deposited + (int)$row['milestone_agreed_budget'];

						}else if($row['milestone_current_status'] == 'RC'){

							$status = '<small><i class="fa fa-undo"></i> Change Request Send</small>';
							$payment='<a class="RNR" href="'.base_url().'release-approve/'.base64_encode($row['milestone_id']).'">Review & Release</a>&nbsp;<a class="RNR" href="'.base_url().'Hire/refundRequest/'.base64_encode($row['milestone_id']).'">Refund</a>';

						}else if($row['milestone_current_status'] == 'AR'){

							$status = '<span> <i class="fa fa-check-circle"></i> Approved </span>';
							$payment = '<a class="RNR" href="'.base_url().'Hire/refundRequest/'.base64_encode($row['milestone_id']).'">Cancel & Refund</a>';
							$total_fund_spend = $total_fund_spend + $row['milestone_agreed_budget'];

						}else if($row['milestone_current_status'] == 'CC'){

							$status = 'Contract Closed';
							$payment = '';

						}else if($row['milestone_current_status'] =='CM'){

							$status = 'Payment Canceled';
							$payment = 'Refund Requested';

						}

						if( $row['milestone_end_date'] !='' && $row['milestone_end_date'] !='0000-00-00 00:00:00'){
							$milestone_end_date = date('d/m/Y',strtotime($row['milestone_end_date']));
						} else{
							$milestone_end_date = "NA";
						}

						$details[] = array(
							'proposal_id'=>$proposal_id,
							'title' => $row['milestone_title'],
							'milestone_id' => $row['milestone_id'],
							'due_date' => $milestone_end_date, 
							'amount' => $row['milestone_agreed_budget'],
							'status' => $status,
							'payment_status' => $payment,
							'milestone_fund_deposited' => $row['milestone_fund_deposited'],
							'milestone_approval_date' => $row['milestone_approval_date'],
							'milesone_payment_request_date' => $milesone_payment_request_date,
							'request_change_in_milestone' => $row['request_change_in_milestone'],
							'milestone_status' => $row['milestone_status'],
							'milestone_is_deleted' => $row['milestone_is_deleted']

						);						

						

					}

					$return['contract_details']['contract_total_budget_escrow'] = $total_fund_deposited;
					$return['contract_details']['contract_total_budget_spend'] = $total_fund_spend;
					$return['milestone_details'] = $details;
					$return['hired_proposal'] = $proposal_id;

				}else{

					$return['contract_details']['contract_total_budget_escrow'] = 0;
					$return['contract_details']['contract_total_budget_spend'] = 0;
					$return['milestone_details'] = array();
					$return['hired_proposal'] = 0;

				}

				return $return;

			}else{			

				return array();

			}

		}else{

			return array();

		}

	}

	public function getPaymentDetails($milestone_id="",$transaction_id=""){
		$this->db->select('p.*,pm.hired_id');
		$this->db->from('payments p');
		$this->db->join('task_proposal_milestone AS pm','p.milestone_id=pm.milestone_id');

		if($milestone_id !=""){
			$this->db->where('pm.milestone_id',$milestone_id);
		}
		if($transaction_id !=""){
			$this->db->where('p.txn_is',$transaction_id);
		}
		$this->db->where('p.withdrawal_status !="paid"');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		if($query->num_rows() >0){
			return $query->result_array();
		}else{
			return false;
		}

	}

	public function get_old_hire_list($user_id = ''){

		$this->db->select('task_hired.*, task.*, users.*,user_login.*, country.name as country');

		$this->db->from('task_hired');

		$this->db->join('task','task.task_id = task_hired.task_id');

		$this->db->join('users','users.user_id = task_hired.freelancer_id');

		$this->db->join('user_login','user_login.user_id = users.user_id');

		$this->db->join('country','country.country_id = users.country','left');

		

		$this->db->where('task.task_created_by',$user_id);

		$this->db->group_by('users.user_id');

		$query = $this->db->get();

		//echo $this->db->last_query();die;

		if($query->num_rows() >0){

			return $query->result();

			

		}else{

			return array();

		}

	}

	

	##Find All Changes  old freelincer Comparition Jha

	public function get_old_hire_list_byskills($main_val,$user_id = '',$user_task=''){



		$this->db->select('task_hired.*, task.*, users.*,user_login.*, country.name as country');

		$this->db->from('task_hired');

		$this->db->join('task','task.task_id = task_hired.task_id');

		$this->db->join('users','users.user_id = task_hired.freelancer_id');

		$this->db->join('user_login','user_login.user_id = users.user_id');

		$this->db->join('country','country.country_id = users.country','left');

		

		$this->db->where('task.task_created_by',$user_id);

		$this->db->where('user_login.profile_title_skill='.$main_val.'');

		$this->db->group_by('users.user_id');

		$query = $this->db->get();

		

		if($query->num_rows() >0){

			return $query->result();

			

		}else{

			return array();

		}

	}

	##Find All Changes For New and old freelincer Comparition Jha

	

	public function update_data($data = array()){

		

		if(!empty($data)){

			$updatedata = array(

				$data['updateField'] => $data['updateData'],

				'milestone_dom' => date('Y-m-d H:i:s')

			);			

			$return = $this->db->where($data['checkField'],$data['checkVal'])->update($data['updateTable'],$updatedata);

			return $return;

		}else{

			return 0;

		}	

	}

	

	public function add_new_milestone($data){

		if(!empty($data)){

			//print_r($data); exit();
			$user_task_id =$data['user_task_id'];
			$proposal_id = $data['proposal_id'];
			$hired_id = $data['hired_id'];
			$fundPayNow = $data['fldMilestoneDepositMode'];

			if($proposal_id != 0){

				$addmoreArr = array(

					'proposal_id' => $proposal_id,
					'hired_id' => $hired_id,
					'milestone_title' => $data['fldMilestoneTitle'],
					'milestone_end_date' => date('Y-m-d H:i:s',strtotime($data['fldMilestoneDueDate'] ) ),
					'milestone_agreed_budget' => $data['fldMilestoneAmount'],
					'milestone_doc' => date('Y-m-d H:i:s'),
					'milestone_current_status' => 'NR',
					'milestone_created_by' => $this->session->userdata('user_id')
				);

				$this->db->insert('task_proposal_milestone',$addmoreArr);
				$lastmilststone = $this->db->insert_id();
				if($lastmilststone> 0 && $user_task_id !="" && $fundPayNow=='deposit_fund_now'){
					$milesPayment = $user_task_id."-".$lastmilststone;
					
				} else{
					$milesPayment ="";
				}

				$response =['status'=>TRUE, "msg"=>$milesPayment]; 


			} else{
				$response =['status'=>FALSE, "msg"=>""];
			}

		}else{
			$response =['status'=>FALSE, "msg"=>""];
		}
		return $response;

	}

	

	public function get_milestone_details_by_id($milestone_id = 0){

		if($milestone_id != ''){

			$this->db->select('task_proposal_milestone.*,task_hired.*');
			$this->db->from('task_proposal_milestone');
			$this->db->join('task_hired','task_hired.proposal_id = task_proposal_milestone.proposal_id');
			$this->db->where('milestone_id', base64_decode($milestone_id));
			$query = $this->db->get();
			//echo $this->db->last_query();exit();
			if($query->num_rows() > 0){
				return $query->row_array();

			}else{
				return array();
			}

		}else{ 
			return array();

		}

	}

	

	public function submit_approval($data = array()){

		$currentdate = date('Y-m-d H:i:s');

		if(!empty($data)){

			$milestone_id = $data['milestone_id'];
			$usertaskid_milestoneid = $data['user_task_id']."-".$data['milestone_id'];

			if($data['radio'] == 'AR'){

				$updateArr = array(
					'milestone_current_status' => 'AR',
					'milestone_approval_date' => $currentdate,
					'milestone_dom' => $currentdate
				);
				$return = $this->db->where('milestone_id',$milestone_id)->update('task_proposal_milestone',$updateArr);

				if($return){
					return TRUE;
				}else{
					return FALSE;
				}
				

			}else if($data['radio'] == 'RC'){

				$updateArr = array(
					'milestone_current_status' => 'RC',
					'request_change_in_milestone' => 1,
					'milestone_dom' => $currentdate,
				);
				
				$return = $this->db->where('milestone_id',$milestone_id)->update('task_proposal_milestone',$updateArr);

				$userMess = array(
					'user_id_from' =>$this->session->userdata('user_id'),
					'user_id_to	' => $data['freelancer_id'],
					'message_content' => $data['change_request_msg'],
					'date_time' =>date('Y-m-d H:i:s'),
					'is_read' =>'N'
				);
				//print_r($userMess); exit();
				$lastmess = $this->addNewRecord('user_messages',$userMess);				

				if($lastmess){
					return TRUE;
				}else{
					return FALSE;
				}	


			}
		}

	}

	

	public function close_contract_update($data = array()){

		$this->load->model("Reviews");

		$this->load->model("Notifications");

		

		/* $current_dttm = date('Y-m-d H:i:s');

		$fldFreelancerID = $data['fldFreelancerID'];

		// get previous coin data

		$prevData = $this->db->select('total_positive_coins,total_negative_coins,total_coins')->from('user_login')->where('user_id', $fldFreelancerID)->get();

		if($prevData->num_rows() > 0){

			$userinfo = $prevData->row_array();

			$prv_total_coins = $userinfo['total_coins'];

			$prv_positive_coins = $userinfo['total_positive_coins'];

			$prv_negative_coins = $userinfo['total_negative_coins'];

			

		}else{

			$prv_total_coins = $prv_positive_coins = $prv_negative_coins = 0;

		}

		

		if($data['coin'] == 'complete'){

			$val = 2;

			$master['total_positive_coins'] = $prv_positive_coins + $val;

		}else{

			$val = -2;

			$master['total_negative_coins'] = $prv_negative_coins + $val;

		} */

		

		/* $updateData = array(

			'hire_is_completed' => 1,

			'hire_final_status' => 'CC',

			'hire_coin_to_freelancer' => $val,

			'hired_is_open' => 1,

			'hire_client_review' => $data['fldContractReview'],

			'hired_dom' => $current_dttm

		); */

				

		/* $newcoin = $prv_total_coins + $val; 

		$master['total_coins'] = $newcoin;

		*/

		

		//echo $data['fldContractID'];

	//	 echo '<pre>'; print_r($updateData); print_r($master); die;

		

		/* $return = $this->db->where('hired_id',$data['fldContractID'])->update('task_hired',$updateData);

		$this->db->where('task_id',$task_id)->update('task',array('task_status'=>'1','task_hired'=>'1','task_is_complete'=>'1','task_completion_date'=>date('Y-m-d H:i:s')));

		$this->db->where('user_id',$fldFreelancerID)->update('user_login',$master); */

		

	

		$fldFreelancerID = $data['fldFreelancerID'];

		$coin=$data['coin'];

		//-----------------------

		$taskData = $this->db->select('*')->from('task_hired')->where('hired_id', $data['fldContractID'])->get();

		$taskinfo = $taskData->row_array();

		$task_id=$taskinfo['task_id'];

		$offer_id=0;

		//------------------------

		if($data['action']=="complete"){

			$action_id="16";

			$this->db->query("UPDATE task SET task_completed_by_owner=1 WHERE task_id='".$data['fldTaskID']."'");

		}else{

			$action_id="18";

		}

		$notification_from=$this->session->userdata('user_id');

		$prevData = $this->db->select('user_id')->from('user_login')->where('user_id', $fldFreelancerID)->get();

		$userinfo = $prevData->row_array();

		$notification_to = $userinfo['user_id'];

				

		$query_notification = $this->db->select('*')->from('notification_type')->where('NOTIFICATION_TYPE_ID',$action_id)->get();		

		

		

		$task_query = $this->db->select('task.*')->from('task')->where('task_id',$data['fldTaskID'])->get();

		if($task_query->num_rows() >0){

			$task_info = $task_query->row();

			$task_name = $task_info->task_name;

			$user_task_id = $task_info->user_task_id;

		}else{

			$task_name = $user_task_id = '';

		}

		

		$title="";

		$message="";

		if(!empty($query_notification)){

			

			$masterInfo=$query_notification->row();

			

			$title = $masterInfo->TITLE;

			$message = $masterInfo->MESSAGE;

		}		

		

		if($coin==0){

			$this->db->query("UPDATE user_login SET total_coins=total_coins-2,total_negative_coins=total_negative_coins-2 WHERE user_id='".$fldFreelancerID."'");

					

		}else if($coin==-1){

			$this->db->query("UPDATE user_login SET total_coins=total_coins-1,total_negative_coins=total_negative_coins-1 WHERE user_id='".$fldFreelancerID."'");

			

		}else if($coin==1){

			$this->db->query("UPDATE user_login SET total_coins=total_coins+1,total_positive_coins=total_positive_coins+1 WHERE user_id='".$fldFreelancerID."'");

			

		}else if($coin==2){

			$this->db->query("UPDATE user_login SET total_coins= total_coins + 2,total_positive_coins= total_positive_coins + 2 WHERE user_id='".$fldFreelancerID."'");

			

		}

		//-------------------PM

		$action_id=20;		

		$show_review="";

		$checkreview=$this->db->query("SELECT * FROM reviews WHERE review_provided_by='".$fldFreelancerID."' AND review_received='".$this->session->userdata('user_id')."' AND taskid='".$task_id."'");

	    if($checkreview->num_rows()>0){

			$show_review=1;

			$r=$checkreview->row();

			$this->db->query("UPDATE reviews SET show_review=1 WHERE review_provided_by='".$fldFreelancerID."' AND review_received='".$this->session->userdata('user_id')."' AND taskid='".$task_id."'");

			

			$sender=$this->db->select('name')->from('users')->where('user_id',$fldFreelancerID )->get()->row();

			

			/*$rmessage='<strong>'.$sender->name.'</strong> has been completed the task and sent review and  '.$r->coins.' coins given for the project.<a href="'.base_url().'reviews">View Reviews</a>';*/



			$rmessage='<strong>'.$sender->name.'</strong> has been completed the task and sent review given for the project.<a href="'.base_url().'reviews">View Reviews</a>';

		    $title="REVIEW";

		    $insert = array(

					'task_id' => $task_id,

					'offer_id' => $offer_id,

					'notification_master_id' => $action_id,

					'notification_from' =>$fldFreelancerID,

					'notification_to' =>$this->session->userdata('user_id') ,

					'notification_details' => $title,

					'notification_message' => $rmessage,

					'notification_doc' => date('Y-m-d H:i:s')

				);				

		   $this->Notifications->insert_notification('task_notification',$insert);

		}else{

			$show_review=0;

			}

			//--------------PM

			

		$job_details_link = '<a href="'.base_url().'hired-job-details/'.$user_task_id.'">'.$task_name.'</a>';

		$insert = array(

				'task_id' => $task_id,

				'offer_id' => $offer_id,

				'notification_master_id' => $action_id,

				'notification_from' => $notification_from,

				'notification_to' => $notification_to,

				'notification_details' => $title,

				'notification_message' => '<strong>'.$this->session->userdata('user_name').'</strong> '.$message.' and send review for the project <strong>'.$job_details_link.'</strong>',

				'coins'=>$data['coin'],

				'review'=>$data['fldContractReview'],

				'notification_doc' => date('Y-m-d H:i:s')

			);

			

			// echo "<pre/>";print_r($insert);exit;

			

		$this->db->insert('task_notification',$insert);

		

		$data_review=array(

			'review_provided_by'=>$this->session->userdata('user_id'),

			'review_received'=>$fldFreelancerID,

			'review_provided'=>$this->input->post('fldContractReview'),

			'review_provided_on'=>date("Y-m-d H:i:s"),

			'show_review'=>$show_review,

			'review_doc'=>date("Y-m-d H:i:s"),

		    'taskid'=>$task_id,

			'coins'=>$coin

		);

		

       $return=$this->Reviews->insert_review($data_review);		 	

		

		if($return){

			return TRUE;

		}else{

			return FALSE;

		}	

		

	}



	// added by ak

	public function get_proposal_info_data($searchVal = array()){

		$this->db->select('*');
		$this->db->from('task_proposal');
		$this->db->join('task_proposal_milestone','task_proposal_milestone.proposal_id=task_proposal.proposal_id');
		$this->db->where('task_id',$searchVal['task_id']);
		$this->db->where('user_id',$searchVal['freelancer_id']);
		$query =  $this->db->get();

		// echo $this->db->last_query();exit;

		if($query->num_rows() > 0){

			return $query->result_array();

		}else{

			return array();

		}

	}

	// end by ak

}