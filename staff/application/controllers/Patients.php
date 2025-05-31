<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patients extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PatientModel');
        $this->load->model('ExaminationsModel');
        if (!$this->session->userdata('staff_id')) {
            redirect('/'); 
        }
    }

    public function index() {
        $data['patients'] = $this->PatientModel->get_assigned_patients($this->session->userdata('staff_id'));
        $this->load->Template('patients/index', $data);
    }

    public function get_patients_api() {
        header('Content-Type: application/json');
        echo json_encode($this->PatientModel->get_all_patients());
    }

    public function search() {
        $term = $this->input->post('term');
        $data['patients'] = $this->PatientModel->search_patients($term);
        $this->load->Template('patients/index', $data);
    }

    public function get_examinations($patient_id) {
        $data = $this->ExaminationsModel->get_by_patient($patient_id);
        echo json_encode($data);
    }

    public function get_exam($id) {
        $data = $this->ExaminationsModel->get($id);
        echo json_encode($data);
    }

    public function save_exam() {
        $data = $this->input->post();
        $data['doctor_id'] = $this->session->userdata('staff_id');
        $data['created_at'] = date('Y-m-d H:i:s');
        $id = $this->ExaminationsModel->insert($data);
        echo json_encode(['status' => 'success', 'id' => $id]);
    }

    public function update_exam($id) {
        $data = $this->input->post();
        $this->ExaminationsModel->update($id, $data);
        echo json_encode(['status' => 'updated']);
    }

    public function delete_exam($id) {
        $this->ExaminationsModel->delete($id);
        echo json_encode(['status' => 'deleted']);
    }
}
