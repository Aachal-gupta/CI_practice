<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends My_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->library(['session', 'form_validation']);// ✅ Ensure session is loaded
		$this->load->helper(['url', 'form']);
        $this->check_role(['admin']); // Restrict access to only admin
		$this->load->model('My_model');

		$this->load->library('upload'); //for upload file
		$config['upload_path']   = './uploads/'; // Folder where files will be uploaded
        $config['allowed_types'] = 'jpg|png|gif|pdf|docx';
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

												// CRUD OPERATION
	// ----------------------------------------------------------------------------------------------------------------------------------


    // // ✅ Create (Insert Data)
    // public function add_user() {
    //     $data = [
    //         'name' => $this->input->post('name'),
    //         'email' => $this->input->post('email')
    //     ];
    //     $this->My_model->insert_data('users', $data);
    //     redirect('user/view_users'); // Redirect to View Page
    // }

    // // ✅ Read (View All Users)
    // public function view_users() {
    //     $data['users'] = $this->My_model->get_all('users');
    //     $this->load->view('users_list', $data);
    // }

    // // ✅ Update (Edit User)
    // public function edit_user($id) {
    //     $data['user'] = $this->My_model->get_where('users', ['id' => $id])[0];
    //     $this->load->view('edit_user', $data);
    // }

    // public function update_user() {
    //     $id = $this->input->post('id');
    //     $data = [
    //         'name' => $this->input->post('name'),
    //         'email' => $this->input->post('email')
    //     ];
    //     $this->My_model->update_data('users', $data, ['id' => $id]);
    //     redirect('user/view_users');
    // }

    // // ✅ Delete (Remove User)
    // public function delete_user($id) {
    //     $this->My_model->delete_data('users', ['id' => $id]);
    //     redirect('user/view_users');
    // }



	// ------------------------------------------------------------------------------------------------------------------------------------

    public function index() { 
		// print_r($this->session->userdata()); // Debug session
		// exit;
        $this->open_view('index'); // Load admin's main page
    }

	public function add_category()
	{
		$this->open_view("add_category");
	}

	
	public function add_user()
	{
		$this->open_view("add_user");
	}

	function upload_img($imgname, $imgtemp, $path = "uploads/")
{
    if ($imgname != "") {
        // Generate a unique file name
        $fname = time() . rand(00000000, 99999999) . "." . explode(".", $imgname)[count(explode(".", $imgname)) - 1];
        $path1 = $path . $fname;

        // Move the uploaded file to the designated path
        move_uploaded_file($imgtemp, $path1);

        return $fname; // Return the file name for database storage
    } else {
        return $imgname;
    }
}


	//form
	public function insert_user() {
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[form.email]');

	
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('add_user'); // Show form again if validation fails
		} else {

			 // Handle file upload
			 $image_data = $_FILES['upload_file']['name'];
			 $tmp = $_FILES['upload_file']['tmp_name'];
			 $image_name = $this->upload_img($image_data, $tmp); // Call upload function

			$data = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'image' => $image_name 
			];

			
			$this->My_model->insert_data('form', $data);
			$this->session->set_flashdata('success', 'User added successfully!');
			redirect('admin/user_list');
		}
	}

		public function user_list() {
		    $data['users'] = $this->My_model->get_all('form');
		    // $this->load->view('user_listt', $data);
			$this->open_view('user_list',$data);
		}

		public function edit_user($table_id){
			$data['edit_user'] = $this->My_model->select_where('form', ['table_id' => $table_id]);
			$this->open_view('edit_user', $data);
		}



	public function update_user() {
		$table_id = $this->input->post('table_id');
	
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	
		if ($this->form_validation->run() == FALSE) {
			$this->edit_user($table_id); // Reload edit page with validation errors
		} else {
			// Retrieve the existing user data
			$user = $this->My_model->select_where('form', ['table_id' => $table_id]);
			
	
			// Handle file upload only if a new file is selected
			if ($_FILES['upload_file']['name'] != "") {
				$image_data = $_FILES['upload_file']['name'];
				$tmp = $_FILES['upload_file']['tmp_name'];
				$image_name = $this->upload_img($image_data, $tmp);
				
	
				// Delete old image if exists
				if (!empty($user['image']) && file_exists(FCPATH . 'uploads/' . $user['image'])) {
					unlink(FCPATH . 'uploads/' . $user['image']); // Delete the old image
				}
			} else {
				$image_name = $user['image']; // Keep the old image if no new image is uploaded
				print_r($image_name);
				
	
			}
	
			// Prepare data for update
			$data = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'image' => $image_name // Store the image filename in the database
			];
	
			// Update database
			$this->My_model->update_data('form', $data, ['table_id' => $table_id]);
			$this->session->set_flashdata('success', 'User updated successfully!');
			redirect('admin/user_list');
		}
	}
	

	public function delete_user($id) {
	
		// Delete user
		$this->My_model->delete_data('form' ,'table_id',$id);
	
		// Redirect to user list with success message
		$this->session->set_flashdata('success', 'User deleted successfully!');
		redirect('admin/user_list');
	}
	

	
}
