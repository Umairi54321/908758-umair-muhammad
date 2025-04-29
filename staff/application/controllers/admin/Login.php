<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AdminModel');
    }

    public function index() {
        $data = [];
        $this->load->view('dashboard/admin-login', $data);
    }

    public function do_login()
    {
        header('Content-Type: application/json');

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $admin = $this->AdminModel->get_admin_by_email($email);

        if ($admin && password_verify($password, $admin->password)) {
            // Save session data
            $this->session->set_userdata([
                'admin_id' => $admin->id,
                'admin_name' => $admin->name,
                'admin_email' => $admin->email
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
        $this->session->unset_userdata(['admin_id', 'admin_name', 'admin_email']);
        $this->session->sess_destroy();
        redirect('admin');
    }

 

}
