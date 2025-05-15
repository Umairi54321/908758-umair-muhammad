<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Register new patient
    public function register($data) {
        return $this->db->insert('patients', $data);
    }

    // Get patient by email (used for login)
    public function get_by_email($email) {
        return $this->db->get_where('patients', ['email' => $email])->row();
    }

    // Get patient by ID
    public function get_by_id($id) {
        return $this->db->get_where('patients', ['id' => $id])->row();
    }

    // Get patient appointments
    public function get_appointments($patient_id) {
        return $this->db
                    ->select('appointments.*, doctors.name as doctor_name, doctors.specialty')
                    ->from('appointments')
                    ->join('doctors', 'doctors.id = appointments.doctor_id', 'left')
                    ->where('appointments.patient_id', $patient_id)
                    ->order_by('appointments.date', 'DESC')
                    ->get()
                    ->result();
    }

    // Get examination results for patient
    public function get_examination_results($patient_id) {
        return $this->db
                    ->select('medical_examinations.*, doctors.name as doctor_name')
                    ->from('medical_examinations')
                    ->join('doctors', 'doctors.id = medical_examinations.doctor_id', 'left')
                    ->where('medical_examinations.patient_id', $patient_id)
                    ->order_by('medical_examinations.examination_date', 'DESC')
                    ->get()
                    ->result();
    }

    // Get current ward assignment for patient
    public function get_ward_assignment($patient_id) {
        return $this->db
                    ->select('wards.name as ward_name, ward_assignments.assigned_at, ward_assignments.bed_number')
                    ->from('ward_assignments')
                    ->join('wards', 'wards.id = ward_assignments.ward_id', 'left')
                    ->where('ward_assignments.patient_id', $patient_id)
                    ->order_by('ward_assignments.assigned_date', 'DESC')
                    ->limit(1)
                    ->get()
                    ->row();
    }
}
