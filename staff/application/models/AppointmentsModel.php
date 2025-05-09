<?php
class AppointmentsModel extends CI_Model {

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
        $this->db->where('id', $id)->update('appointments', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id)->update('appointments', ['status' => 'cancelled']);
    }
}
