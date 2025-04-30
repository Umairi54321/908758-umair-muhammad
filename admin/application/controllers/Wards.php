<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wards extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('WardModel');
        $this->load->model('WardAssignmentsModel');
        $this->load->model('PatientModel');
        if (!$this->session->userdata('admin_id')) {
            redirect('/'); 
        }
    }

    public function index() {
        $this->load->adminTemplate('wards/index', $data);
    }

    public function fetch_all() {
        $wards = $this->Ward_model->get_all();
        echo json_encode(['data' => $wards]);
    }

    public function save() {
        $data = [
            'name' => $this->input->post('name'),
            'total_beds' => $this->input->post('total_beds')
        ];
        $id = $this->input->post('id');
        if ($id) {
            $this->Ward_model->update($id, $data);
        } else {
            $this->Ward_model->insert($data);
        }
        echo json_encode(['status' => true, 'message' => 'Saved successfully']);
    }

    public function delete($id) {
        $this->Ward_model->delete($id);
        echo json_encode(['status' => true, 'message' => 'Deleted successfully']);
    }

    public function assign_patient() {
        $data = [
            'ward_id' => $this->input->post('ward_id'),
            'patient_id' => $this->input->post('patient_id'),
            'bed_number' => $this->input->post('bed_number')
        ];

        // Check if bed is already taken
        if ($this->Ward_assignments_model->is_bed_taken($data['ward_id'], $data['bed_number'])) {
            echo json_encode(['status' => false, 'message' => 'This bed is already assigned.']);
            return;
        }

        $this->Ward_assignments_model->insert($data);
        echo json_encode(['status' => true, 'message' => 'Patient assigned successfully']);
    }

    public function get_patients() {
        echo json_encode(['data' => $this->Patient_model->get_all()]);
    }

    public function get_ward_assignments() {
        echo json_encode(['data' => $this->Ward_assignments_model->get_all_with_details()]);
    }
}
