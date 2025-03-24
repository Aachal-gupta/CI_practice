<?php
defined('BASEPATH') OR exit('No direct script access allowed ');

class  My_model extends CI_model{

	
	public function __construct() {
        parent::__construct();
        $this->load->database(); // Ensure the database is loaded
    }



	public function validate_user($email, $password, $table) {
		
		$where = '(email = "'.$email.'" AND password = "'.$password.'" AND status = "active")';
		
		$this->db->where($where); 
		$query = $this->db->get($table);
	
		if ($query->num_rows()) {
			$user = $query->row_array();
			return $user;
			
		}
		return false;
	}

	

	 
	

	public function insert($tname, $data){
		$this->db->insert($tname, $data);
		return $this->db->insert_id();
	}

	public function select_where($tname,$cond)
	{
		$this->db->where($cond);
		return $this->db->get($tname)->result_array();
	}

	public function update($tname,$cond,$data){
		$this->db->where($cond);
		return $this->db->update($tname,$data);
	}

}
?>
