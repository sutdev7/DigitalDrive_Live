<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skills extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    /*
     * Skill information By ID
     */
    public function get_skill_by_id($sId = null){
        if(empty($sId))
            return FALSE;

        $this->db->select('*');
        $this->db->from('area_of_interest');
        $this->db->where('area_of_interest_id', $sId);
        $this->db->where('status', 1);
        $this->db->where('deleted',0);        
        $query = $this->db->get();
        return $query->row();
    }

    /*
     * Skill information By Name
     */
    public function get_skill_by_name($sName= null){
        if(empty($sName))
            return FALSE;

        $this->db->select('*');
        $this->db->from('area_of_interest');
        $this->db->where('name', $sName);
        $this->db->where('status', 1);
        $this->db->where('deleted',0);        
        $query = $this->db->get();
        return $query->row();
    }

    /*
     * Get All Skill information
     */
    public function get_all_skill_info(){
        $skill_list = array();

        $this->db->select('*');
        $this->db->from('area_of_interest');
        $this->db->where('status', 1);
        $this->db->where('deleted',0);
        $query = $this->db->get();
        foreach ($query->result() as $row){
            $skill_list[] = $row;
        }
                
        return $skill_list;
    }

}		