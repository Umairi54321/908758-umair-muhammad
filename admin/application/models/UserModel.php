<?php
class UserModel extends CI_Model {

    public function get_all_users() {
        return $this->db->get('users')->result();
    }

    public function get_all_doctors() {
    $result = $this->db->where('role', 'doctor')->get('users')->result();
    return $result;
}


    public function get_user($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function add_user($data) {
        return $this->db->insert('users', $data);
    }

    public function update_user($id, $data) {
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function delete_user($id) {
        return $this->db->delete('users', ['id' => $id]);
    }
}
