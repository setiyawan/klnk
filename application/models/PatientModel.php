<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PatientModel extends CI_Model {

    public function get_patient($filter=[]) {
        if (!empty($filter['patient_id'])) {
            $this->db->where('patient_id', $filter['patient_id']);
        }

        if (!empty($filter['patient_name'])) {
            $this->db->like('patient_name', $filter['patient_name']);
        }

        if (!empty($filter['id_card_number'])) {
            $this->db->where('id_card_number', $filter['id_card_number']);
        }

        if (!empty($filter['medical_record_number'])) {
            $this->db->where('medical_record_number', $filter['medical_record_number']);
        }
        
        $this->db->limit(100);
        
        return  $this->db->get('patient')->result_array();
        // print_r($this->db->last_query());  
        // die;
    }

    public function get_latest_patient_id() {
        $this->db->select_max('patient_id');
        return $this->db->get('patient')->row()->patient_id + 1;
    }

    public function get_patient_count() {
        return $this->db->count_all_results('patient');
    }

    // POST TRANSACTION
    public function add_patient($data) {
        return $this->db->insert('patient', $data);
    }

    public function update_patient($data, $patient_id){
        $this->db->set($data);
        $this->db->where('patient_id', $patient_id);
        return $this->db->update('patient');
    }

}

?>