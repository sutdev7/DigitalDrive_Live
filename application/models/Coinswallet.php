<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Coinswallet extends CI_Model {

	public function __construct(){

		parent::__construct();



		$this->table = 'reviews';

    }

    function getRows($params = array()){
		$this->db->select('*,(SELECT email  from user_login where reviews.review_provided_by = user_login.user_id) as provided_email');
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

			$this->db->order_by('reviews.review_id', 'desc');

		}

		

		if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){

			// $result = $this->db->count_all_results();
			$this->db->join('user_login', 'reviews.review_received = user_login.user_id');
			$this->db->join('task', 'task.task_id = reviews.taskid');
			$this->db->join('task_hired', 'task_hired.task_id = reviews.taskid');
			
			$query = $this->db->get();

			//echo $this->db->last_query();exit;

			$result = ($query->num_rows() > 0)?$query->num_rows():0;

		}else{

			if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){

				if(!empty($params['id'])){

					$this->db->where('id', $params['id']);

				}
				$this->db->join('user_login', 'reviews.review_received = user_login.user_id');
				$this->db->join('task', 'task.task_id = reviews.taskid');
				$this->db->join('task_hired', 'task_hired.task_id = reviews.taskid');

				$query = $this->db->get();

				// echo $this->db->last_query();exit;

				$result = $query->row_array();

			}else{

				$this->db->order_by('reviews.review_id', 'desc');

				if(array_key_exists("start",$params) && array_key_exists("limit",$params)){

					$this->db->limit($params['limit'],$params['start']);

				}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){

					$this->db->limit($params['limit']);

				}

				$this->db->join('user_login', 'reviews.review_received = user_login.user_id');
				$this->db->join('task', 'task.task_id = reviews.taskid');
				$this->db->join('task_hired', 'task_hired.task_id = reviews.taskid');
				$query = $this->db->get();

				// echo $this->db->last_query();exit;

				$result = ($query->num_rows() > 0)?$query->result_array():FALSE;

			}

		}

		

		// Return fetched data

		return $result;

	}
}