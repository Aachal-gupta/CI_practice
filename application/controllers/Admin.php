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
		$this->load->library('pagination'); 
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


	private function send_email($to_email, $user_name) {
		$this->load->library('email'); // Load Email Library
	
		// Email Configuration
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 587,
			'smtp_user' => 'aachal.gupta@ratsantech.in', // Your email
			'smtp_pass' => 'ozao luoz ptsk qunm', // Use App Password (NOT your real password)
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n",
			'smtp_crypto' => 'tls'
		);
	
		$this->email->initialize($config);
	
		// Email Content
		$this->email->from('aachal.gupta@ratsantech.in', 'Your Company Name');
		$this->email->to($to_email);
		$this->email->subject('Welcome to Our Platform');
		$this->email->message('<h2>Hello ' . $user_name . ',</h2><p>Thank you for registering with us.</p>');
	
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger(); // Show errors if email fails
		}
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

	// function upload_img($imgname, $imgtemp, $path = "uploads/")
	// {
	// 	if ($imgname != "") {
	// 		// Generate a unique file name
	// 		$fname = time() . rand(00000000, 99999999) . "." . explode(".", $imgname)[count(explode(".", $imgname)) - 1];
	// 		$path1 = $path . $fname;

	// 		// Move the uploaded file to the designated path
	// 		move_uploaded_file($imgtemp, $path1);

	// 		return $fname; // Return the file name for database storage
	// 	} else {
	// 		return $imgname;
	// 	}
	// }

	function upload_img($imgname, $imgtemp, $path = "uploads/") {
		if (!empty($imgname)) {
			// Generate unique filename
			$fname = time() . rand(00000000, 99999999) . "." . pathinfo($imgname, PATHINFO_EXTENSION);
			$path1 = $path . $fname;
	
			// Move the uploaded file to the designated path
			move_uploaded_file($imgtemp, $path1);
	
			return $fname; // Return filename for database storage
		}
		return null; // Return null if no file is uploaded
	}
	
	



	//form
	// public function insert_user() {

	// 	$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
	// 	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[form.email]');

	
	// 	if ($this->form_validation->run() == FALSE) {
	// 		$this->load->view('add_user'); // Show form again if validation fails
	// 	} else {

	// 		//  // Handle  single file upload
	// 		//  $image_data = $_FILES['upload_file']['name'];
	// 		//  $tmp = $_FILES['upload_file']['tmp_name'];
	// 		//  $image_name = $this->upload_img($image_data, $tmp); // Call upload function

	// 		// for multiple file upload 
	// 		$uploaded_files = [];

    //     if (!empty($_FILES['upload_file']['name'][0])) {
    //         $uploaded_files = $this->upload_img($_FILES['upload_file']['name'], $_FILES['upload_file']['tmp_name']);
    //     }

    //     // **Convert array to JSON before storing**
    //     $image_name = json_encode($uploaded_files);

	// 		$data = [
	// 			'name' => $this->input->post('name'),
	// 			'email' => $this->input->post('email'),
	// 			'image' => $image_name 
	// 		];
	
	// 		$this->My_model->insert_data('form', $data);
	// 		$this->session->set_flashdata('success', 'User added successfully!');
	// 		redirect('admin/user_list');
	// 	}
	// }


	public function insert_user() {
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[form.email]');
	
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('add_user'); // Show form again if validation fails
		} else {
			$uploaded_files = [];
	
			if (!empty($_FILES['upload_file']['name'][0])) {
				foreach ($_FILES['upload_file']['name'] as $key => $img_name) {
					$img_temp = $_FILES['upload_file']['tmp_name'][$key];
					$uploaded_files[] = $this->upload_img($img_name, $img_temp);
				}
			}
	
			// **Ensure correct JSON format**
			$image_name = !empty($uploaded_files) ? json_encode($uploaded_files) : json_encode([]);
	
			// Prepare data for insertion
			$data = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'image' => $image_name
			];
	
			// Insert data into the database
			$this->My_model->insert_data('form', $data);

			 // Send Email Notification
			 $this->send_email($data['email'], $data['name']);

			$this->session->set_flashdata('success', 'User added successfully!');
			redirect('admin/user_list');
		}
	}

	

		// public function user_list() {
		//     $data['users'] = $this->My_model->get_all('form');
		// 	$this->open_view('user_list',$data);
		// }

		public function user_list() {
			$config = [
				'base_url' => base_url('admin/user_list'),
				'total_rows' => $this->My_model->count_all('form'), // Get total number of users
				'per_page' => 5, // Display 5 users per page
				'uri_segment' => 3,
				'full_tag_open' => '<nav><ul class="pagination">',
				'full_tag_close' => '</ul></nav>',
				'first_tag_open' => '<li class="page-item"><span class="page-link">',
				'first_tag_close' => '</span></li>',
				'last_tag_open' => '<li class="page-item"><span class="page-link">',
				'last_tag_close' => '</span></li>',
				'next_tag_open' => '<li class="page-item"><span class="page-link">',
				'next_tag_close' => '</span></li>',
				'prev_tag_open' => '<li class="page-item"><span class="page-link">',
				'prev_tag_close' => '</span></li>',
				'cur_tag_open' => '<li class="page-item active"><span class="page-link">',
				'cur_tag_close' => '</span></li>',
				'num_tag_open' => '<li class="page-item"><span class="page-link">',
				'num_tag_close' => '</span></li>',
			];
		
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
			$data['users'] = $this->My_model->get_paginated_users('form', $config['per_page'], $page);
			$data['pagination_links'] = $this->pagination->create_links();
		
			$this->open_view('user_list', $data);
		}
		
		public function edit_user($table_id){
			$data['edit_user'] = $this->My_model->select_where('form', ['table_id' => $table_id]);
			$this->open_view('edit_user', $data);
		}


// for single file upload
	// public function update_user() {
	// 	$table_id = $this->input->post('table_id');
	
	// 	$this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
	// 	$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	
	// 	if ($this->form_validation->run() == FALSE) {
	// 		$this->edit_user($table_id); // Reload edit page with validation errors
	// 	} else {
	// 		// Retrieve the existing user data
	// 		$user = $this->My_model->select_where('form', ['table_id' => $table_id]);
			
	
	// 		// Handle file upload only if a new file is selected
	// 		if ($_FILES['upload_file']['name'] != "") {
	// 			$image_data = $_FILES['upload_file']['name'];
	// 			$tmp = $_FILES['upload_file']['tmp_name'];
	// 			$image_name = $this->upload_img($image_data, $tmp);
				
	
	// 			// Delete old image if exists
	// 			if (!empty($user['image']) && file_exists(FCPATH . 'uploads/' . $user['image'])) {
	// 				unlink(FCPATH . 'uploads/' . $user['image']); // Delete the old image
	// 			}
	// 		} else {
	// 			$image_name = $user['image']; // Keep the old image if no new image is uploaded
	// 			print_r($image_name);
				
	
	// 		}
	
	// 		// Prepare data for update
	// 		$data = [
	// 			'name' => $this->input->post('name'),
	// 			'email' => $this->input->post('email'),
	// 			'image' => $image_name // Store the image filename in the database
	// 		];
	
	// 		// Update database
	// 		$this->My_model->update_data('form', $data, ['table_id' => $table_id]);
	// 		$this->session->set_flashdata('success', 'User updated successfully!');
	// 		redirect('admin/user_list');
	// 	}
	// }


// for multiple file upload
public function update_user() {
    $table_id = $this->input->post('table_id');

    $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    if ($this->form_validation->run() == FALSE) {
        $this->edit_user($table_id); // Reload edit page with validation errors
    } else {
        // Retrieve the existing user data
        $user = $this->My_model->select_where('form', ['table_id' => $table_id]);

        // Delete old images if new images are uploaded
        if (!empty($_FILES['upload_file']['name'][0])) { // Check if any file is selected
            $old_images = json_decode($user['image'], true);

            if (is_array($old_images)) {
                foreach ($old_images as $old_img) {
                    $old_img_path = 'uploads/' . $old_img;
                    if (file_exists($old_img_path)) {
                        unlink($old_img_path); // Delete old image from folder
                    }
                }
            } elseif (!empty($user['image'])) { // If it's a single image (not JSON array)
                $old_img_path = 'uploads/' . $user['image'];
                if (file_exists($old_img_path)) {
                    unlink($old_img_path); // Delete old image from folder
                }
            }
        }

        // Upload new images
        $uploaded_images = [];
        if (!empty($_FILES['upload_file']['name'][0])) {
            foreach ($_FILES['upload_file']['name'] as $key => $img_name) {
                $img_temp = $_FILES['upload_file']['tmp_name'][$key];
                $uploaded_images[] = $this->upload_img($img_name, $img_temp);
            }
        }

        // Use new images if uploaded, otherwise keep old images
        $final_images = !empty($uploaded_images) ? $uploaded_images : json_decode($user['image'], true);

        // Prepare data for update
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'image' => json_encode($final_images)
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
