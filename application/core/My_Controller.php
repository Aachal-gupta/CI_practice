<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('url'); 
        // Load session library
        $this->load->library('session');
        
        // Check if user is logged in
        $this->check_session();
    }

    // Check if user is logged in
    protected function check_session() {
        if (!$this->session->userdata('user_id')) {
			// print_r($this->session->userdata()); exit;
            redirect('Auth/login'); // Redirect to login page if not logged in
        }
    }

    // Check user role for access control
    protected function check_role($allowed_roles = []) {
        $user_role = $this->session->userdata('role'); // Get user role from session

        if (!in_array($user_role, $allowed_roles)) {
            show_error('Access Denied! You do not have permission to access this page.', 403);
        }
    }
}
