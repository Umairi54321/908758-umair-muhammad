<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment_model extends CI_Model {

    public function get_appointments_by_patient($patient_id) {
        return $this->db
                    ->select('appointments.*, doctors.name as doctor_name, doctors.specialty')
                    ->from('appointments')
                    ->join('doctors', 'doctors.id = appointments.doctor_id', 'left')
                    ->where('appointments.patient_id', $patient_id)
                    ->order_by('appointments.date', 'DESC')
                    ->get()->result();
    }

    public function get_appointments_by_staff($staff_id, $type = 'upcoming') {
        $this->db->where('staff_id', $staff_id);
        if ($type == 'upcoming') {
            $this->db->where('appointment_date >=', date('Y-m-d H:i:s'));
        } else {
            $this->db->where('appointment_date <', date('Y-m-d H:i:s'));
        }
        $this->db->order_by('appointment_date', 'ASC');
        return $this->db->get('appointments')->result_array();
    }

    public function update_status($id, $status) {
        return $this->db->where('id', $id)->update('appointments', ['status' => $status]);
    }

    public function add_notes($id, $notes) {
        return $this->db->where('id', $id)->update('appointments', [
            'notes' => $notes,
            'status' => 'completed'
        ]);
    }

    public function get_appointment($id) {
        return $this->db->get_where('appointments', ['id' => $id])->row_array();
    }

    public function get_all() {
        $this->db->select('a.*, p.first_name as patient_name, d.name as doctor_name');
        $this->db->from('appointments a');
        $this->db->join('patients p', 'p.id = a.patient_id');
        $this->db->join('users d', 'd.id = a.doctor_id');
        $this->db->where('d.role', 'doctor');
        return $this->db->get()->result();
    }

    public function insert($data) {
        return $this->db->insert('appointments', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('appointments', $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->update('appointments', ['status' => 'cancelled']);
    }
}
