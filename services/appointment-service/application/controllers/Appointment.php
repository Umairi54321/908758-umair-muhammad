<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Appointment_model');
        $this->load->model('Patient_model');
        header('Content-Type: application/json');
    }

    public function get_by_patient($id) {
        $data = $this->Appointment_model->get_appointments_by_patient($id);
        echo json_encode(['data' => $data]);
    }

    public function get_by_staff($id, $type) {
        $data = $this->Appointment_model->get_appointments_by_staff($id, $type);
        echo json_encode(['data' => $data]);
    }

    public function get_doctors_api() {
        echo json_encode($this->Appointment_model->get_all_doctors());
    }

    public function update_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->Appointment_model->update_status($id, $status);
        echo json_encode(['status' => 'updated']);
    }

    public function add_notes() {
        $id = $this->input->post('id');
        $notes = $this->input->post('notes');
        $this->Appointment_model->add_notes($id, $notes);
        echo json_encode(['status' => 'notes added']);
    }

    public function get($id) {
        $appointment = $this->Appointment_model->get_appointment($id);
        echo json_encode(['appointment' => $appointment]);
    }

    public function fetch_all() {
        echo json_encode(['status' => true, 'data' => $this->Appointment_model->get_all()]);
    }

    public function save() {
        $data = $this->input->post();
        $id = $this->input->post('id');
        if ($id) {
            $this->Appointment_model->update($id, $data);
        } else {
            $this->Appointment_model->insert($data);
        }
        echo json_encode(['status' => true, 'message' => 'Appointment saved']);
    }

    public function delete($id) {
        $this->Appointment_model->delete($id);
        echo json_encode(['status' => true, 'message' => 'Appointment cancelled']);
    }
}
