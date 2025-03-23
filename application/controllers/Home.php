<?php

class Home extends CI_Controller{

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
		$this->load->library('form_validation'); // Load form validation library
		$this->load->model('My_model');
		$this->load->library('session');


		$this->check_login();
	}


	private function check_login()
    {
        if (!$this->session->userdata('user_id')) {
			// $this->load->view('admin/login');
			// redirect(base_url('login'));
			// redirect("login");
			echo "Redirecting to login...";
			redirect("login");

        }
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

?>
