<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Transaction extends CI_Model {

	public function __construct(){

		parent::__construct();



		$this->table = 'payments';

    }



    public function get_transaction_list($count = 0, $status = ""){

		$this->db->select('*');
        $this->db->from('payments');
		$this->db->join('task', 'task.task_id = payments.task_id');
		$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');
        $this->db->join('task_proposal_milestone', 'task_proposal_milestone.milestone_id = payments.milestone_id');
		//$this->db->join('user_login', 'user_login.user_id = users.user_id');
		
		$result = $this->db->get();
		//echo'<pre>';print_r($result->result());exit;
		if($count == 1){
			return $result->num_rows();
		}

		if($result->num_rows() > 0){
			return $result->result();
		} else{
			return array();
		}

	}



	public function get_freelancer_transaction_list($count = 0, $status = ""){

		$this->db->select('*');

        $this->db->from('payments');

		$this->db->join('task', 'task.task_id = payments.task_id');

		$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');

        $this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');

		// $this->db->where('user_login.user_id',$_SESSION["user_id"]);

		// $this->db->join('user_login', 'user_login.user_id = users.user_id');

		// $this->db->join('country', 'country.country_id = users.country','left');

		// $this->db->order_by('user_login.unique_id','asc');

		$result = $this->db->get();

		// echo $this->db->last_query();exit;

		// echo'<pre>';print_r($result->result());exit;

		if($count == 1){

			return $result->num_rows();

		}

		if($result->num_rows() > 0){

			return $result->result();

		}else{

			return array();

		}



	}



	public function get_freelancer_inescrow_income($count = 0, $status = ""){

		if($count == 2){

			$this->db->select('sum(payments.amount) as inescrow');

		}else{

			$this->db->select('*');

		}

        $this->db->from('payments');

		$this->db->join('task', 'task.task_id = payments.task_id');

		$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');

        $this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');

		$this->db->where('user_login.user_id',$_SESSION["user_id"]);

		$this->db->where('payments.payment_status','yes');

		// $this->db->join('user_login', 'user_login.user_id = users.user_id');

		// $this->db->join('country', 'country.country_id = users.country','left');

		// $this->db->order_by('user_login.unique_id','asc');

		$result = $this->db->get();

		//  echo $this->db->last_query();exit;

		// echo'<pre>';print_r($result->result());exit;

		if($result !== FALSE && $count == 1){

			return $result->num_rows();

		}else if($result !== FALSE && $count == 2){

			return $result->result_array();

		}

		if($result !== FALSE && $result->num_rows() > 0){

			return $result->result_array();

		}else{

			return array();

		}



	}



	public function get_freelancer_net_income($count = 0, $status = ""){

		if($count == 2){

			$this->db->select('sum(payments_withdra.amount) as netincome');

		}else{

			$this->db->select('*');

		}

        $this->db->from('payments');

		$this->db->join('task', 'task.task_id = payments.task_id');

		$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');

		$this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');

		$this->db->join('payments_withdra', 'payments.id = payments_withdra.payments_id','right');

		$this->db->where('user_login.user_id',$_SESSION["user_id"]);

		$this->db->where('payments_withdra.payment_status','yes');

		// $this->db->join('user_login', 'user_login.user_id = users.user_id');

		// $this->db->join('country', 'country.country_id = users.country','left');

		// $this->db->order_by('user_login.unique_id','asc');

		$result = $this->db->get();

		//   echo $this->db->last_query();exit;

		// echo'<pre>';print_r($result->result());exit;

		if($result !== FALSE && $count == 1){

			return $result->num_rows();

		}else if($result !== FALSE && $count == 2){

			return $result->result_array();

		}

		if($result !== FALSE && $result->num_rows() > 0){

			return $result->result_array();

		}else{

			return array();

		}



	}



	public function get_freelancer_budget($count = 0, $status = ""){

		if($count == 2){

			$this->db->select('sum(payments.amount) as budget');

		}else{

			$this->db->select('*');

		}

        $this->db->from('payments');

		$this->db->join('task', 'task.task_id = payments.task_id');

		$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');

        $this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');

		$this->db->where('user_login.user_id',$_SESSION["user_id"]);

		$this->db->where('payments.payment_status','yes');

		// $this->db->join('user_login', 'user_login.user_id = users.user_id');

		// $this->db->join('country', 'country.country_id = users.country','left');

		// $this->db->order_by('user_login.unique_id','asc');

		$result = $this->db->get();

		//  echo $this->db->last_query();exit;

		// echo'<pre>';print_r($result->result());exit;

		if($result !== FALSE && $count == 1){

			return $result->num_rows();

		}else if($result !== FALSE && $count == 2){

			return $result->result_array();

		}

		if($result !== FALSE && $result->num_rows() > 0){

			return $result->result_array();

		}else{

			return array();

		}



	}



	function getRows($params = array()){

		$this->db->select('*');
		$this->db->from($this->table);
		if(array_key_exists("where", $params)){
			foreach($params['where'] as $key => $val){
				$this->db->where($key, trim($val));
			}
		}

		if(array_key_exists("search", $params)){
			// Filter data by searched keywords
			if(!empty($params['search']['keywords'])){
				$this->db->like('task.task_name', trim($params['search']['keywords']));
			}
		}

		// Sort data by ascending or desceding order
		if(!empty($params['search']['sortBy'])){
			$this->db->order_by('task.task_name', $params['search']['sortBy']);
		}else{
			$this->db->order_by('id', 'desc');
		}

		if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
			// $result = $this->db->count_all_results();
			$this->db->join('task', 'task.task_id = payments.task_id');
			$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');
			$this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');
			$query = $this->db->get();
			// echo $this->db->last_query();exit;
			$result = ($query !== FALSE && $query->num_rows() > 0)?$query->num_rows():0;

		}else{

			if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){

				if(!empty($params['id'])){

					$this->db->where('id', $params['id']);

				}

				$this->db->join('task', 'task.task_id = payments.task_id');
				$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');
				$this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');
				$query = $this->db->get();
				// echo $this->db->last_query();exit;
				$result = $query->row_array();

			}else{

				$this->db->order_by('id', 'desc');

				if(array_key_exists("start",$params) && array_key_exists("limit",$params)){

					$this->db->limit($params['limit'],$params['start']);

				}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){

					$this->db->limit($params['limit']);

				}

				$this->db->join('task', 'task.task_id = payments.task_id');

				$this->db->join('task_hired', 'task_hired.task_id = payments.task_id');

				$this->db->join('user_login', 'task_hired.freelancer_id = user_login.user_id');

				$query = $this->db->get();

				// echo $this->db->last_query();exit;

				$result = ($query !== FALSE && $query->num_rows() > 0)?$query->result_array():FALSE;

			}

		}

		

		// Return fetched data

		return $result;

	}

    

}