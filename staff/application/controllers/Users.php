<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
        if (!$this->session->userdata('staff_id')) {
            redirect('/'); 
        }
    }

    public function index() {
        $this->load->adminTemplate('users/index', $data);
    }

    public function get_users_api() {
        header('Content-Type: application/json');
        $users = $this->UserModel->get_all_users();
        echo json_encode($users);
    }
    
    public function add_user_api() {
        header('Content-Type: application/json');
    
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'role' => $this->input->post('role'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        ];
    
        if ($this->UserModel->add_user($data)) {
            echo json_encode(['status' => true, 'message' => 'User added successfully']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to add user']);
        }
    }
    
    public function update_user_api($id) {
        header('Content-Type: application/json');
    
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'role' => $this->input->post('role')
        ];
    
        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }
    
        if ($this->UserModel->update_user($id, $data)) {
            echo json_encode(['status' => true, 'message' => 'User updated']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Update failed']);
        }
    }
    
    public function delete_user_api($id) {
        header('Content-Type: application/json');
    
        if ($this->UserModel->delete_user($id)) {
            echo json_encode(['status' => true, 'message' => 'User deleted']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Delete failed']);
        }
    }
    
}
