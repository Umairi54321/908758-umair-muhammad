<?php
class StaffModel extends CI_Model {

    public function get_staff_by_email($email) {
        return $this->db->where('email', $email)->get('users')->row();
    }

    public function get_total_patients()
    {
        return $this->db->count_all('patients');
    }

    public function get_total_wards()
    {
        return $this->db->count_all('wards');
    }

    public function get_today_patients()
    {
        return $this->db->where('DATE(created_at)', date('Y-m-d'))->count_all_results('patients');
    }

}
