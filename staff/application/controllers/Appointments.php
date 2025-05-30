<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointments extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AppointmentsModel');
        $this->load->model('PatientModel');
        if (!$this->session->userdata('admin_id')) {
            redirect('/'); 
        }
    }

    public function index() {
        $staff_id = $this->session->userdata('staff_id');
        $upcoming = $this->call_microservice("http://localhost:8084/appointment/get_by_staff/{$staff_id}/upcoming");
        $past = $this->call_microservice("http://localhost:8084/appointment/get_by_staff/{$staff_id}/past");
        $data['upcoming'] = $upcoming['data'] ?? [];
        $data['past']     = $past['data'] ?? [];
        $this->load->Template('appointments/index', $data);
    }


    public function update_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $this->AppointmentsModel->update_status($id, $status);
        echo json_encode(['status' => 'updated']);
    }

    private function call_microservice($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }


    public function add_notes() {
        $id = $this->input->post('id');
        $notes = $this->input->post('notes');
        $this->AppointmentsModel->add_notes($id, $notes);
        echo json_encode(['status' => 'notes added']);
    }

    public function get_appointment($id) {
        $appointment = $this->AppointmentsModel->get_appointment($id);
        $patient = $this->PatientModel->get_patient($appointment['patient_id']);
        echo json_encode(['appointment' => $appointment, 'patient' => $patient]);
    }
}
