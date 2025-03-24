<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends My_Controller {
    public function __construct() {
        parent::__construct();
        $this->check_role(['manager']); // Restrict access to only manager
    }

    public function index() { // Changed from dashboard() to index()
        $this->load->view('manager/index'); // Load manager's main page
    }
}
