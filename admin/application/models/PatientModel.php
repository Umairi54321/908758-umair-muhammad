<?php
class PatientModel extends CI_Model {

    public function get_all_patients() {
        $result = $this->db->get('patients')->result();
        return $result;
    }

    public function get_patient($id) {
        return $this->db->get_where('patients', ['id' => $id])->row();
    }

    public function add_patient($data) {
        return $this->db->insert('patients', $data);
    }

    public function update_patient($id, $data) {
        return $this->db->where('id', $id)->update('patients', $data);
    }

    public function soft_delete_patient($id) {
        return $this->db->where('id', $id)->delete('patients');
    }

    public function transfer_patient($id, $new_ward_id) {
        return $this->db->where('id', $id)->update('patients', ['ward_id' => $new_ward_id]);
    }
}
