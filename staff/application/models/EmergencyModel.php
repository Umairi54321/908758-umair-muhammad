<?php
class EmergencyModel extends CI_Model {

    public function get_all() {
        return $this->db->get('emergency_patients')->result();
    }

    public function save($data) {
        return $this->db->insert('emergency_patients', $data);
    }
}
