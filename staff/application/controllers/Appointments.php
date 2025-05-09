<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointments extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AppointmentsModel-');
        if (!$this->session->userdata('admin_id')) {
            redirect('/'); 
        }
    }

    public function index() {
        $this->load->adminTemplate('appointments/index', $data);
    }

    public function fetch_all() {
        echo json_encode([
            'status' => true,
            'data' => $this->AppointmentsModel->get_all()
        ]);
    }

    public function save() {
        $data = [
            'patient_id' => $this->input->post('patient_id'),
            'doctor_id' => $this->input->post('doctor_id'),
            'appointment_date' => $this->input->post('appointment_date'),
            'appointment_time' => $this->input->post('appointment_time'),
            'notes' => $this->input->post('notes'),
            'status' => $this->input->post('status') ?? 'scheduled'
        ];
        $id = $this->input->post('id');
        if ($id) {
            $this->AppointmentsModel->update($id, $data);
        } else {
            $this->AppointmentsModel->insert($data);
        }
        echo json_encode(['status' => true, 'message' => 'Appointment saved']);
    }

    public function delete($id) {
        $this->AppointmentsModel->delete($id);
        echo json_encode(['status' => true, 'message' => 'Appointment cancelled']);
    }
}
