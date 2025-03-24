<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends My_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->library('session'); // ✅ Ensure session is loaded
		$this->load->helper('url');
        $this->check_role(['admin']); // Restrict access to only admin
    }

	public function nav()
    {
		$this->check_session();

        $this->load->view("admin/nav");
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



    public function index() { // Changed from dashboard() to index()
		// print_r($this->session->userdata()); // Debug session
		// exit;
        $this->open_view('index'); // Load admin's main page
    }

	public function add_category()
	{
		$this->open_view("add_category");
	}
}
