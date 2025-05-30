<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wards extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('WardModel');
        if (!$this->session->userdata('staff_id')) {
            redirect('/'); 
        }
    }

    public function index() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://localhost:8085/ward/get_ward_status');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        $data['wards'] = isset($result['data']) ? $result['data'] : [];

        $this->load->Template('wards/index', $data);
    }


    public function assign_bed() {
        $ward_id = $this->input->post('ward_id');
        $patient_id = $this->input->post('patient_id');
        $bed_number = $this->input->post('bed_number');

        $staff_id = $this->session->userdata('staff_id');
        $result = $this->WardModel->assign_bed($ward_id, $staff_id, $patient_id, $bed_number);

        echo json_encode($result);
    }

    public function discharge_patient() {
        $assignment_id = $this->input->post('assignment_id');
        echo json_encode($this->WardModel->discharge_patient($assignment_id));
    }

    public function get_patients_by_ward($ward_id) {
        echo json_encode($this->WardModel->get_patients_by_ward($ward_id));
    }

    public function get_available_beds($ward_id) {
        echo json_encode($this->WardModel->get_available_beds($ward_id));
    }
}
