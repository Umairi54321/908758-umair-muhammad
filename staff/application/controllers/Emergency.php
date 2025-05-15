<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emergency extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EmergencyModel');
        if (!$this->session->userdata('staff_id')) {
            redirect('/'); 
        }
    }

    public function index() {
        $this->load->Template('emergency/index', $data);
    }

    public function fetch_all() {
        $data = $this->EmergencyModel->get_all();
        echo json_encode(['status' => true, 'data' => $data]);
    }

    public function save() {
        $data = [
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'phone' => $this->input->post('phone'),
            'triage_priority' => $this->input->post('triage_priority'),
            'assigned_doctor_id' => $this->input->post('assigned_doctor_id')
        ];
        $this->EmergencyModel->save($data);
        echo json_encode(['status' => true, 'message' => 'Emergency patient registered']);
    }    
}
