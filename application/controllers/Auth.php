<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('My_model'); // Load model for database queries
        $this->load->library('session'); // Load session library
		$this->load->helper('url'); 
    }

    public function login() {
        $this->load->view('auth/login'); // Load the login page
    }

    public function login_process() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Fetch user from the database
        $user = $this->My_model->select_where("users", ['email' => $email, 'password'=>$password]);
		// print_r($user); // Check if user data is correct
		// exit;

        if ($user)
		{
            // Set session data
            $this->session->set_userdata('user_id', $user[0]['user_tbl_id']);
            $this->session->set_userdata('email', $user[0]['email']);
            $this->session->set_userdata('role', $user[0]['role']);

            // Redirect based on role
            if ($user[0]['role'] == 'admin') {
                redirect('Admin');
            } elseif ($user[0]['role'] == 'manager') {
                redirect('Manager');
            } else {
                redirect('Auth/loginsss');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid Email or Password');
            redirect('Auth/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }
}
