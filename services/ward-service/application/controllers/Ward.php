<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ward extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ward_model');
        $this->load->model('WardAssignments_model');
        header('Content-Type: application/json');
    }

    public function fetch_all() {
        echo json_encode(['data' => $this->Ward_model->get_all()]);
    }

    public function save() {
    $name = $this->input->post('name');
    $beds = $this->input->post('total_beds');
    $id = $this->input->post('id');

    if (!$name || !$beds) {
        echo json_encode(['status' => false, 'message' => 'All fields are required']);
        return;
    }

    $data = ['name' => $name, 'total_beds' => $beds];
    $success = $id 
        ? $this->Ward_model->update($id, $data) 
        : $this->Ward_model->insert($data);

    echo json_encode([
        'status' => $success ? true : false,
        'message' => $success ? 'Saved successfully' : 'Operation failed'
    ]);
}


    public function delete($id) {
        $this->Ward_model->delete($id);
        echo json_encode(['status' => true, 'message' => 'Deleted successfully']);
    }

    public function assign_patient() {
        $data = [
            'ward_id' => $this->input->post('ward_id'),
            'patient_id' => $this->input->post('patient_id'),
            'bed_number' => $this->input->post('bed_number'),
            'assigned_at' => date('Y-m-d H:i:s')
        ];

        if ($this->WardAssignments_model->is_bed_taken($data['ward_id'], $data['bed_number'])) {
            echo json_encode(['status' => false, 'message' => 'Bed already assigned.']);
            return;
        }

        $this->WardAssignments_model->insert($data);
        echo json_encode(['status' => true, 'message' => 'Patient assigned successfully']);
    }

    public function discharge_patient() {
        $assignment_id = $this->input->post('assignment_id');
        echo json_encode($this->Ward_model->discharge_patient($assignment_id));
    }

    public function get_ward_assignments() {
        echo json_encode(['data' => $this->WardAssignments_model->get_all_with_details()]);
    }

    public function get_patient_assignment($id) {
        echo json_encode(['data' => $this->WardAssignments_model->get_by_patient($id)]);
    }

    public function get_ward_status() {
        echo json_encode(['data' => $this->Ward_model->get_ward_status()]);
    }

    public function get_patients_by_ward($id) {
        echo json_encode(['data' => $this->Ward_model->get_patients_by_ward($id)]);
    }

    public function get_available_beds($id) {
        echo json_encode(['data' => $this->Ward_model->get_available_beds($id)]);
    }
}

