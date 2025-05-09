<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PatientModel extends CI_Model {

    public function get_assigned_patients($staff_id) {
        $this->db->select('*')->from('patients');
        $this->db->join('ward_assignments', 'patients.id = ward_assignments.patient_id');
        $this->db->where('ward_assignments.staff_id', $staff_id);
        return $this->db->get()->result();
    }

    public function get_patient($id) {
        return $this->db->get_where('patients', ['id' => $id])->row_array();
    }

    public function get_patient_records($patient_id) {
        $this->db->where('patient_id', $patient_id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('examinations')->result_array();
    }

    public function search_patients($term) {
        $this->db->like('first_name', $term);
        $this->db->like('last_name', $term);
        return $this->db->get('patients')->result_array();
    }

    public function add_record($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('examinations', $data);
    }
}
