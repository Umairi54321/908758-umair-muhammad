<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('PatientModel');
    }

    public function register() {
        if ($this->input->post()) {
            
                $data = [
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'email'      => $this->input->post('email'),
                    'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'phone'      => $this->input->post('phone'),
                    'gender'     => $this->input->post('gender'),
                    'dob'        => $this->input->post('dob'),
                    'address'    => $this->input->post('address')
                ];
                
                $this->PatientModel->register($data);
                $this->session->set_flashdata('success', 'Registration successful. Please login.');
                redirect('login');
        }

        $this->load->Template('patient/register', $data);
    }

    public function login() {
        if ($this->input->post()) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                
                $patient = $this->PatientModel->get_by_email($email);

                if ($patient && password_verify($password, $patient->password)) {
                    $this->session->set_userdata('patient_id', $patient->id);
                    $this->session->set_userdata('patient_name', $patient->first_name . ' ' . $patient->last_name);
                    redirect('dashboard'); // Redirect to a patient dashboard page
                } else {
                    $this->session->set_flashdata('error', 'Invalid email or password.');
                }
            
        }
    
        $this->load->Template('patient/login');
    }
    

    public function dashboard() {
        $data['patient'] = $this->PatientModel->get_by_id($this->session->userdata('patient_id'));
        $this->load->Template('patient/dashboard', $data);
    }

    public function appointments() {
        $patient_id = $this->session->userdata('patient_id');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8084/appointment/get_by_patient/$patient_id");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        $data['appointments'] = isset($result['data']) ? $result['data'] : [];

        $this->load->Template('patient/appointments', $data);
    }


    public function examination_results() {
        $data['results'] = $this->PatientModel->get_examination_results($this->session->userdata('patient_id'));
        $this->load->Template('patient/examination_results', $data);
    }

    public function ward_assignment() {
        $patient_id = $this->session->userdata('patient_id');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://localhost:8085/ward/get_patient_assignment/{$patient_id}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        $data['ward_assignment'] = isset($result['data']) ? $result['data'] : null;

        $this->load->Template('patient/ward_assignment', $data);
    }


    public function logout() {
        $this->session->unset_userdata('patient_id');
        redirect('login');
    }
}
