<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MedicineRecordModel extends CI_Model {

    public function get_medicine_record($filter=[]) {
        if (!empty($filter['medical_record_id'])) {
            $this->db->where('medical_record_id', $filter['medical_record_id']);
        }
        
        $this->db->from('medicine_record mr');
        $this->db->join('medicine m', 'm.medicine_id = mr.medicine_id');
        return $this->db->get()->result_array();
    }

    // POST TRANSACTION
    public function add_medicine_record($data) {
        return $this->db->insert('medicine_record', $data);
    }

    public function update_medicine_record($data, $medicine_record_id){
        $this->db->set($data);
        $this->db->where('medicine_record_id', $medicine_record_id);
        return $this->db->update('medicine_record');
    }

    public function delete_medicine_record($data=[], $medical_record_id) {
        $this->db->where('medical_record_id', $medical_record_id);
        $this->db->where_not_in('medicine_record_id', $data);
        $this->db->delete('medicine_record');
    }

}

?>