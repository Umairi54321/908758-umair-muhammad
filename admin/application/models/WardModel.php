<?php
class WardModel extends CI_Model {

    public function get_all() {
        return $this->db->get('wards')->result();
    }

    public function insert($data) {
        $this->db->insert('wards', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id)->update('wards', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id)->delete('wards');
    }
}
