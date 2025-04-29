<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PatientModel');
        if (!$this->session->userdata('admin_id')) {
            redirect('/'); 
        }
    }

    public function index() {
        $this->load->adminTemplate('patients/index', $data);
    }

    public function get_patients_api() {
        header('Content-Type: application/json');
        echo json_encode($this->PatientModel->get_all_patients());
    }
    
    public function add_patient_api() {
        $data = $this->input->post();
        $data['password'] = password_hash($this->input->post("password"), PASSWORD_BCRYPT);
        echo json_encode([
            'status' => $this->PatientModel->add_patient($data),
            'message' => 'Patient added successfully'
        ]);
    }
    
    public function update_patient_api($id) {
        $data = $this->input->post();
        echo json_encode([
            'status' => $this->PatientModel->update_patient($id, $data),
            'message' => 'Patient updated successfully'
        ]);
    }
    
    public function delete_patient_api($id) {
        echo json_encode([
            'status' => $this->PatientModel->soft_delete_patient($id),
            'message' => 'Patient deleted'
        ]);
    }
    
    public function transfer_patient_api($id) {
        $ward_id = $this->input->post('ward_id');
        echo json_encode([
            'status' => $this->PatientModel->transfer_patient($id, $ward_id),
            'message' => 'Patient transferred'
        ]);
    }
    
}
