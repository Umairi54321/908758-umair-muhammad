<?php
class WardAssignmentsModel extends CI_Model {

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
        $this->db->select('wa.*, w.name as ward_name, p.first_name, p.last_name');
        $this->db->from('ward_assignments wa');
        $this->db->join('wards w', 'w.id = wa.ward_id');
        $this->db->join('patients p', 'p.id = wa.patient_id');
        $this->db->where('wa.discharged_at IS NULL', null);
        return $this->db->get()->result();
    }
}
