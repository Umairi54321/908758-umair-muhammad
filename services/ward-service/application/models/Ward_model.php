<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ward_model extends CI_Model {

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

    public function get_ward_status() {
        $this->db->select('w.id, w.name, w.total_beds, COUNT(wa.id) as occupied_beds');
        $this->db->from('wards w');
        $this->db->join('ward_assignments wa', 'wa.ward_id = w.id AND wa.discharged_at IS NULL', 'left');
        $this->db->group_by('w.id');
        return $this->db->get()->result_array();
    }

    public function get_available_beds($ward_id) {
        $occupied = $this->db
            ->select('bed_number')
            ->from('ward_assignments')
            ->where('ward_id', $ward_id)
            ->where('discharged_at IS NULL')
            ->get()->result_array();

        $occupied = array_column($occupied, 'bed_number');
        $total = $this->db->get_where('wards', ['id' => $ward_id])->row()->total_beds;

        $free = [];
        for ($i = 1; $i <= $total; $i++) {
            if (!in_array($i, $occupied)) $free[] = $i;
        }
        return $free;
    }

    public function assign_bed($ward_id, $staff_id, $patient_id, $bed_number) {
        if ($this->db->where(['ward_id' => $ward_id, 'bed_number' => $bed_number, 'discharged_at' => null])->get('ward_assignments')->num_rows()) {
            return ['status' => 'error', 'message' => 'Bed is already occupied'];
        }

        $this->db->insert('ward_assignments', [
            'ward_id' => $ward_id,
            'staff_id' => $staff_id,
            'patient_id' => $patient_id,
            'bed_number' => $bed_number,
            'assigned_at' => date('Y-m-d H:i:s')
        ]);
        return ['status' => 'success'];
    }

    public function discharge_patient($assignment_id) {
        $this->db->where('id', $assignment_id)->update('ward_assignments', [
            'discharged_at' => date('Y-m-d H:i:s')
        ]);
        return ['status' => 'success'];
    }

    public function get_patients_by_ward($ward_id) {
        return $this->db
            ->select('wa.id as assignment_id, wa.bed_number, u.first_name as patient_name, u.email')
            ->from('ward_assignments wa')
            ->join('patients u', 'u.id = wa.patient_id')
            ->where('wa.ward_id', $ward_id)
            ->where('wa.discharged_at IS NULL')
            ->get()->result_array();
    }
}
