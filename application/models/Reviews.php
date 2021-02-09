<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    /*
     * Skill information By ID
     */
    public function get_reviews($condition){
		$this->db->select('reviews.*,users.*,user_login.*,country.name as country');
        $this->db->from('reviews');
        $this->db->join('users', 'users.user_id = reviews.review_provided_by');
        $this->db->join('user_login', 'user_login.user_id = reviews.review_provided_by');
		$this->db->join('country','country.country_id = users.country', 'left');
        $this->db->where($condition); 
		$this->db->order_by('review_id','DESC');
        $query = $this->db->get();
		$result=$query->result();
      
		return $result;
    }

    /*
     * 
     */

        /*
     * Review Information Admin Abhishek
     */
    public function get_reviewsAdmin($condition){
        $this->db->select('reviews.*,users.*,user_login.*,country.name as country');
        $this->db->from('reviews');
        $this->db->join('users', 'users.user_id = reviews.review_provided_by');
        $this->db->join('user_login', 'user_login.user_id = reviews.review_provided_by');
        $this->db->join('country','country.country_id = users.country', 'left');
        $this->db->where($condition); 
        $this->db->order_by('review_id','DESC');
        $query = $this->db->get();
        $result=$query->result_array();
     
        return $result;
    }

    /*
     * 
     */
    
    /*
     * Review Count
     */
    public function reviewsCount($id){
        $this->db->select('count(review_id) as total_review');
        $this->db->from('reviews');
     
        $this->db->where('review_received',$id); 
      
        $query = $this->db->get()->result();
        
        foreach ($query as $key => $value) {
           return $value->total_review;
        }
     
    }

   /*
     * 
     */
    /*
     * Project Count
     */
    public function reviewsCountTask($id){
        $this->db->select('count(task_hired.task_id) as total_task');
        $this->db->from('task_hired');
        $this->db->join('task','task.task_id=task_hired.task_id');
        $this->db->where('task_hired.freelancer_id',$id); 
        $this->db->where('task.task_status',1); 
      
        $query = $this->db->get()->result();
        
        foreach ($query as $key => $value) {
           return $value->total_task;
        }
     
    }

    /*
     * 
     */


     /*
     * user Count
     */
    public function userCount(){
        
        $this->db->from('user_login');
     
        $this->db->where('user_type',4); 
      
        $query = $this->db->get();
        $rowcount = $query->num_rows();
        return $rowcount;
        
     
    }

    /*
     * 
     */
    
    public function insert_review($data){
      
		$this->db->insert("reviews",$data)	;
        return true;
    }
	
	

    

}		