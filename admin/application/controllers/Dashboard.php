<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AdminModel');
        if (!$this->session->userdata('admin_id')) {
            redirect('/'); 
        }
    }

    public function index() {
        $data['total_patients']     = $this->AdminModel->get_total_patients();
        $data['total_wards']        = $this->AdminModel->get_total_wards();
        $data['today_patients']     = $this->AdminModel->get_today_patients();
        $this->load->adminTemplate('dashboard/index', $data);
    }
}
