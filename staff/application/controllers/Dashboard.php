<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('StaffModel');
        if (!$this->session->userdata('staff_id')) {
            redirect('staff'); 
        }
    }

    public function index() {
        $data['total_patients']     = $this->StaffModel->get_total_patients();
        $data['total_wards']        = $this->StaffModel->get_total_wards();
        $data['today_patients']     = $this->StaffModel->get_today_patients();
        $this->load->Template('dashboard/index', $data);
    }
}
