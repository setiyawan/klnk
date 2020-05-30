<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MedicineModel extends CI_Model {

    public function get_medicine($filter=[]) {
        if (!empty($filter['medicine_id'])) {
            $this->db->where('medicine_id', $filter['medicine_id']);
        }

        if (!empty($filter['medicine_name'])) {
            $this->db->like('medicine_name', $filter['medicine_name']);
        }

        if (!empty($filter['expired_date'])) {
            if ($filter['expired_date'] == '2') {
                $this->db->where('expired_date <= ', $filter['current_date']);
            } else {
                $this->db->where('expired_date > ', $filter['current_date']);
            }
        }

        if (empty($filter['status'])) {
            $this->db->where('status', '1');
        }
        
        $this->db->order_by('medicine_name');
        $this->db->limit(100);
        return $this->db->get('medicine')->result_array();

    }

    // POST TRANSACTION
    public function add_medicine($data) {
        return $this->db->insert('medicine', $data);
    }

    public function update_medicine($data, $medicine_id){
        $this->db->set($data);
        $this->db->where('medicine_id', $medicine_id);
        return $this->db->update('medicine');
    }

    public function add_stock($data) {
        return $this->db->insert('medicine_stock', $data);
    }

    public function FunctionName($data) {
        $sql = 'INSERT INTO medicine_stock (medicine_id, update_stock, current_stock, source) SELECT ? as medicine_id, ? as update_stock, current_stock + ? as current_stock, ? as source FROM medicine_stock WHERE medicine_id = ? order by medicine_stock_id DESC LIMIT 1';
        return $db->query($sql, $data['medicine_id'], $data['update_stock'], $data['update_stock'], $data['source'], $data['medicine_id']);
    }

}

?>