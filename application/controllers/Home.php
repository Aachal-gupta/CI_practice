<?php

class Home extends My_Controller{   //it inherit the My_Controller

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
		$this->load->library('form_validation'); // Load form validation library
		$this->load->model('My_model');
		$this->load->library('session');

        $this->check_role(['admin', 'manager']); // Only admin and manager can access this page

	}


	


	public function nav()
    {
		$data['user_details'] = $this->My_model->select_where("login_tbl", ['login_tbl_id' => $_SESSION['user_id']]);
        if (!isset($data['user_details'][0])) {
            session_destroy();
			redirect("login");
        }

        $this->load->view("admin/nav",$data);
    }

	public function footer()
    {
        $this->load->view("admin/footer");
    }

	public function open_view($page, $data = [])
    {
        $this->nav();
        $this->load->view("admin/" . $page, $data);
        $this->footer();
    }


		
// ****************************************************************************************************

// FOR REGISTRATION a New User
    public function index()
    {
		echo "Welcome to the Admin Dashboard!";
		$this->open_view("index");
    }



	// Logout function
	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}

	public function add_category()
	{
		$this->open_view("add_category");
	}


}


