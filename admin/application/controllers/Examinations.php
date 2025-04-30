<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examinations extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ExaminationsModel');
        if (!$this->session->userdata('admin_id')) {
            redirect('/'); 
        }
    }

    public function index() {
        $this->load->adminTemplate('examinations/index', $data);
    }

    public function fetch_all() {
        $data = $this->ExaminationsModel->get_all_with_details();
        echo json_encode(['data' => $data]);
    }

    public function save() {
        $id = $this->input->post('id');
        $data = [
            'patient_id'    => $this->input->post('patient_id'),
            'doctor_id'     => $this->input->post('doctor_id'),
            'exam_type'     => $this->input->post('exam_type'),
            'exam_date'     => $this->input->post('exam_date'),
            'observations'  => $this->input->post('observations'),
            'results'       => $this->input->post('results')
        ];

        if ($id) {
            $this->ExaminationsModel->update($id, $data);
            $msg = 'Examination updated.';
        } else {
            $this->ExaminationsModel->insert($data);
            $msg = 'Examination added.';
        }

        echo json_encode(['status' => true, 'message' => $msg]);
    }

    public function delete($id) {
        $this->ExaminationsModel->delete($id);
        echo json_encode(['status' => true, 'message' => 'Examination deleted.']);
    }
}
