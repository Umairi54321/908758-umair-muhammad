<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('StaffModel');
    }

    public function index() {
        $data = [];
        $this->load->view('dashboard/staff-login', $data);
    }

    public function do_login()
    {
        header('Content-Type: application/json');

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $staff = $this->StaffModel->get_staff_by_email($email);

        if ($staff && password_verify($password, $staff->password)) {
            // Save session data
            $this->session->set_userdata([
                'staff_id' => $staff->id,
                'staff_name' => $staff->name,
                'satff_email' => $staff->email
            ]);

            echo json_encode([
                'status' => true,
                'message' => 'Login successful',
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid credentials'
            ]);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(['staff_id', 'staff_name', 'staff_email']);
        $this->session->sess_destroy();
        redirect('/');
    }

 

}
