<?php
class Examinations_model extends CI_Model {

    public function get_by_patient($patient_id) {
        return $this->db->where('patient_id', $patient_id)
                        ->order_by('exam_date', 'DESC')
                        ->get('examinations')
                        ->result();
    }

    public function get($id) {
        return $this->db->get_where('examinations', ['id' => $id])->row();
    }

    public function insert($data) {
        $this->db->insert('examinations', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id)->update('examinations', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id)->delete('examinations');
    }
}
