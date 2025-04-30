<?php
class ExaminationsModel extends CI_Model {

    public function get_all_with_details() {
        $this->db->select('examinations.*, patients.first_name, doctors.name as doctor_name');
        $this->db->from('examinations');
        $this->db->join('patients', 'patients.id = examinations.patient_id', 'left');
        $this->db->join('doctors', 'doctors.id = examinations.doctor_id', 'left');
        return $this->db->get()->result();
    }

    public function insert($data) {
        $this->db->insert('examinations', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id)->update('examinations', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id)->delete('examinations');
    }
}
