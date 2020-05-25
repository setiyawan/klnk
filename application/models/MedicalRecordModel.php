<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MedicalRecordModel extends CI_Model {

    public function get_medical_record($filter=[]) {
        if (!empty($filter['medical_record_id'])) {
            $this->db->where('medical_record_id', $filter['medical_record_id']);
        }

        if (!empty($filter['patient_name'])) {
            $this->db->like('patient_name', $filter['patient_name']);
        }

        if (!empty($filter['id_card_number'])) {
            $this->db->where('id_card_number', $filter['id_card_number']);
        }

        if (!empty($filter['medical_record_number'])) {
            $this->db->where('p.medical_record_number', $filter['medical_record_number']);
        }

        if (!empty($filter['visit_date'])) {
            $this->db->where('date(visit_date_time)', $filter['visit_date']);
        }
        
        $this->db->from('medical_record m');
        $this->db->join('patient p', 'p.patient_id = m.patient_id');

        $this->db->order_by('visit_date_time');
        $this->db->limit(100);

        return $this->db->get()->result_array();
    }

     public function get_medical_record_count($filter=[]) {
        if (!empty($filter['x_days'])) {
            $this->db->where('date(visit_date_time) >=', $filter['x_days']);
        }

        return $this->db->count_all_results('medical_record');
    }

    // POST TRANSACTION
    public function add_medical_record($data) {
        return $this->db->insert('medical_record', $data);
    }

    public function update_medical_record($data, $medical_record_id){
        $this->db->set($data);
        $this->db->where('medical_record_id', $medical_record_id);
        return $this->db->update('medical_record');
    }

}

?>