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

	

	  // Insert data into a table
	  public function insert_data($table, $data) {
        return $this->db->insert($table, $data);
    }

	

	public function get_all($table) {
        $query = $this->db->get($table); // SELECT * FROM users
        return $query->result_array(); // Return data as an array
    }

	  // Fetch a single record based on condition
	  public function select_where($table, $condition) {
        return $this->db->get_where($table, $condition)->row_array();
    }

	  // Update a record
	  public function update_data($table, $data, $condition) {
        return $this->db->where($condition)->update($table, $data);
    }

	  // Delete a record
	  public function delete_data($table,$t_id, $id) {
        return $this->db->where($t_id, $id)->delete($table);
    }

}
?>
