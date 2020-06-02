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
        return $this->db->get('medicine')->result_array();
    }

    public function get_medicine_with_stock($filter=[]) {
        $where_array = [];
        if (!empty($filter['medicine_id'])) {
            array_push($where_array, 'medicine_id = ' . $filter['medicine_id']);
        }

        if (!empty($filter['medicine_name'])) {
            array_push($where_array, 'medicine_name like "%' . $filter['medicine_name'] . '%"');
        }

        if (!empty($filter['expired_date'])) {
            if ($filter['expired_date'] == '2') {
                array_push($where_array, 'expired_date <= "' . $filter['current_date'] . '"' );
            } else {
                array_push($where_array, 'expired_date > "' . $filter['current_date'] . '"' );
            }
        }

        if (empty($filter['status'])) {
            array_push($where_array, 'status = 1');
        }

        $where_clause = '';
        if (!empty($where_array)) {
            $where_clause = ' where ' . implode(" and ", $where_array);
        }

        $sql = 'select m.*, s.medicine_stock_id, s.current_stock from medicine m join ( select max(medicine_stock_id) as medicine_stock_id, medicine_id from medicine_stock GROUP BY medicine_id) as bridge on bridge.medicine_id = m.medicine_id JOIN medicine_stock s on bridge.medicine_stock_id = s.medicine_stock_id' . $where_clause;
        
        $this->db->order_by('medicine_name');
        return $this->db->query($sql)->result_array();

    }

     public function get_expired_medicine_count($filter=[]) {
        if (!empty($filter['current_month'])) {
            $this->db->where('month(expired_date)', $filter['current_month']);
        }

        if (!empty($filter['current_year'])) {
            $this->db->where('year(expired_date)', $filter['current_year']);
        }

        $this->db->where('status', '1');

        return $this->db->count_all_results('medicine');
    }

    public function get_stock($medicine_id) {
        $this->db->where('medicine_id', $medicine_id);
        $this->db->order_by('medicine_stock_id', 'desc');
        $this->db->limit(5);
        return $this->db->get('medicine_stock')->result_array();
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

    public function upsert_stock($data) {
        if (empty($data['update_stock'])) {
            return true;
        }

        $sql = 'INSERT INTO medicine_stock (medicine_id, update_stock, current_stock, source) SELECT ' . $data['medicine_id'] . ' as medicine_id, ' . $data['update_stock'] . ' as update_stock, current_stock + ' . $data['update_stock'] . ' as current_stock, ' . $data['source']. ' as source FROM medicine_stock WHERE medicine_id = '. $data['medicine_id'] . ' order by medicine_stock_id DESC LIMIT 1';
        return $this->db->query($sql);
    }

}

?>