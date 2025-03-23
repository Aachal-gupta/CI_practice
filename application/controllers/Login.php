<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('My_model');
		$this->load->helper(['form', 'url']);

		$this->load->library(['form_validation','session']);

	}


	// FOR REGISTRATION a New User
    // public function index()
    // {
	// 	$this->load->view("admin/register");
    // }

	// // REGISTER DATA INSERT IN DB WITH VALIDATION
	// 	public function register_process()
	// 	{
	// 		// Set validation rules
	// 		$this->form_validation->set_rules('name', 'Name', 'required');
	// 		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[register_tbl.email]');
	// 		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
	
	// 		if ($this->form_validation->run() == FALSE) {
	// 			$this->load->view("admin/register");  // If validation fails, reload the form
	// 		} else {
	// 			$data = array(
	// 				'name'   => $this->input->post('name', TRUE),
	// 				'email'  => $this->input->post('email', TRUE),
	// 				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT), // ✅ Hash Password
	// 				'status' => 1,
	// 				'time'   => date("Y-m-d H:i:s") // Store proper IST datetime format
	// 			);
	
	// 			$this->My_model->insert('register_tbl', $data);
	// 			$this->session->set_flashdata('success', 'Registration successful! You can now login.');
	// 			redirect('login/login');   // Redirect to login page
	// 		}
	// 	}


	 // Show the login page
	 public function login() {
        $this->load->view('admin/login');
    }


	public function login_process() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
	
		$user = $this->My_model->validate_user($username, $password, 'login_tbl');
	
		// print_r($user); // ✅ Debugging: Check what $user contains
	
		if ($user) {
			$this->session->set_userdata('user_id', $user['login_tbl_id']);
			$this->session->set_userdata('username', $user['username']);
	
			redirect('home/index');
		} else {
			$this->session->set_flashdata('error', 'Invalid Username or Password');
			redirect('login/login');
		}
	}

	
	
	
	
	
	
	

	

    // Logout function
    public function logout() {
        $this->session->sess_destroy();
        redirect('home/login');
    }
}


?>
