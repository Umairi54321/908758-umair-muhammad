<?php
class WardModel extends CI_Model {

    public function get_ward_status() {
        $this->db->select('w.id, w.name, w.total_beds, COUNT(wa.id) as occupied_beds');
        $this->db->from('wards w');
        $this->db->join('ward_assignments wa', 'wa.ward_id = w.id AND wa.discharged_at IS NULL', 'left');
        $this->db->group_by('w.id');
        return $this->db->get()->result_array();
    }

    public function get_available_beds($ward_id) {
        $this->db->select('bed_number')
            ->from('ward_assignments')
            ->where('ward_id', $ward_id)
            ->where('discharged_at IS NULL');
        $occupied_beds = array_column($this->db->get()->result_array(), 'bed_number');

        $this->db->select('total_beds')->from('wards')->where('id', $ward_id);
        $total_beds = $this->db->get()->row()->total_beds;

        $available = [];
        for ($i = 1; $i <= $total_beds; $i++) {
            if (!in_array($i, $occupied_beds)) {
                $available[] = $i;
            }
        }
        return $available;
    }

    public function assign_bed($ward_id, $staff_id, $patient_id, $bed_number) {
        // Check if the bed is already assigned
        $this->db->where([
            'ward_id' => $ward_id,
            'bed_number' => $bed_number,
            'discharged_at' => NULL
        ]);
        $exists = $this->db->get('ward_assignments')->num_rows();

        if ($exists > 0) {
            return ['status' => 'error', 'message' => 'Bed is already occupied'];
        }

        $this->db->insert('ward_assignments', [
            'ward_id' => $ward_id,
            'staff_id' => $staff_id,
            'patient_id' => $patient_id,
            'bed_number' => $bed_number,
            'assigned_at' => date('Y-m-d H:i:s'),
            'discharged_at' => NULL
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
        $this->db->select('wa.id as assignment_id, wa.bed_number, u.name as patient_name, u.email')
            ->from('ward_assignments wa')
            ->join('users u', 'u.id = wa.patient_id')
            ->where('wa.ward_id', $ward_id)
            ->where('wa.discharged_at IS NULL');
        return $this->db->get()->result_array();
    }
}
