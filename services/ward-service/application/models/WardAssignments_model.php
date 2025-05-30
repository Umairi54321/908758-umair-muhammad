<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WardAssignments_model extends CI_Model {

    public function insert($data) {
        $this->db->insert('ward_assignments', $data);
    }

    public function is_bed_taken($ward_id, $bed_number) {
        return $this->db->get_where('ward_assignments', [
            'ward_id' => $ward_id,
            'bed_number' => $bed_number,
            'discharged_at IS NULL' => null
        ])->num_rows() > 0;
    }

    public function get_all_with_details() {
        return $this->db
            ->select('wa.*, w.name as ward_name, p.first_name, p.last_name')
            ->from('ward_assignments wa')
            ->join('wards w', 'w.id = wa.ward_id')
            ->join('patients p', 'p.id = wa.patient_id')
            ->where('wa.discharged_at IS NULL', null)
            ->get()->result();
    }

    public function get_by_patient($patient_id) {
        return $this->db
            ->select('wards.name as ward_name, ward_assignments.assigned_at, ward_assignments.bed_number')
            ->from('ward_assignments')
            ->join('wards', 'wards.id = ward_assignments.ward_id', 'left')
            ->where('ward_assignments.patient_id', $patient_id)
            ->order_by('ward_assignments.assigned_at', 'DESC')
            ->limit(1)
            ->get()->row();
    }
}