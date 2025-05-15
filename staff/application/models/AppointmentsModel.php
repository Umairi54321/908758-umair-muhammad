<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppointmentsModel extends CI_Model {

    public function get_appointments($staff_id, $type = 'upcoming') {
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
        $this->db->where('id', $id);
        return $this->db->update('appointments', ['status' => $status]);
    }

    public function add_notes($id, $notes) {
        $this->db->where('id', $id);
        return $this->db->update('appointments', [
            'notes' => $notes,
            'status' => 'completed'
        ]);
    }

    public function get_appointment($id) {
        return $this->db->get_where('appointments', ['id' => $id])->row_array();
    }
}
