<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudController extends CI_Controller {

	

	public function __construct() {
		parent::__construct();

		$this->load->model('My_model');
		$this->load->helper('url'); // Load URL helper
		$this->load->library('session'); // Load Session Library
		$this->load->library('form_validation'); // Load form validation library
		// date_default_timezone_set('Asia/Kolkata');

	}
	
	public function insert(){
		$this->load->view('insert');
	}

	public function insert_data(){
	
		// Set validation rules
		$this->form_validation->set_rules('tbl_name', 'Name', 'required|min_length[3]');
		$this->form_validation->set_rules('tbl_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('tbl_message', 'Message', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			// Validation failed, reload form and pass errors
			$this->insert(); // Load the form page again
		} else {
			$_POST['status'] = 1;
			$_POST['entry_time'] = date('Y-m-d H:i:s'); // Saves time in readable format
	
			$this->My_model->insert("form", $_POST);
			$this->session->set_flashdata("message", "Data added Successfully...");
			redirect('CrudController/form_list', 'refresh');
		}
	}
	

	public function form_list(){
		$data['message'] = $this->session->flashdata("message"); // Get the flash message
		$data['form_data'] = $this->My_model->select_where("form", ['status' => 1]);
		
		$this->load->view('success', $data); // Pass data to the view success file

	}

	public function edit_form($table_id)
		{
			$data['form'] = $this->My_model->select_where('form', ['table_id' => $table_id])[0];	
			$this->load->view('edit_form', $data); //call edit_form fucntion
		}
	
		//update 
	public function update_form()
	{
		$this->My_model->update("form", ['table_id' => $_POST['table_id']], $_POST);

		$this->session->set_flashdata("Success", "Data Updated Successfully...");
		redirect('crudcontroller/form_list', 'refresh');  //after update redirect success page for that  call form_list fuction
	}


	// delete 
	public function delete_form($table_id)
	{
		$this->My_model->update("form", ['table_id' => $table_id], ['status' => 0]);
		$this->session->set_flashdata("Danger", "Data Deleted Successfully...");
		redirect('crudcontroller/form_list', 'refresh');
	}
	
}
?>
