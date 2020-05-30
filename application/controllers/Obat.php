<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Obat extends My_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


    public function __construct() {
        parent::__construct();

    	$this->must_login();
        $this->load->model('MedicineModel'); 
    }
    
    // GET ACTION
    public function index() {
    	$data['active_menu']['active_left_navbar'] = 'medicine';

    	$filter['medicine_name'] = $this->input->get('nama_obat', TRUE);
    	$filter['expired_date'] = $this->input->get('kadaluarsa', TRUE);
    	$filter['current_date'] = $this->TimeConstant->get_current_timestamp();
		$data['medicine'] = $this->MedicineModel->get_medicine($filter);

    	$data['filter'] = $filter;
    	$data['constant_unit'] = $this->MedicineConstant->get_unit();
    	$data['constant_expired_medicine'] = $this->MedicineConstant->get_expired_medicine();
    	
		$this->load->view('side/header');
		$this->load->view('medicine', $data);
		$this->load->view('side/footer');
	}

	public function tambah() {
    	$data['active_menu']['active_left_navbar'] = 'medicine';

		$data['table_label'] = 'Tambah Data Obat';
		$data['action'] = 'add';
		$data['constant_unit'] = $this->MedicineConstant->get_unit();

		$this->load->view('side/header');
		$this->load->view('medicine_form', $data);
		$this->load->view('side/footer');
	}

	public function detail() {
    	$data['active_menu']['active_left_navbar'] = 'medicine';

		$filter['medicine_id'] = $this->input->get('id', TRUE);

    	$data['medicine'] = $this->MedicineModel->get_medicine($filter);
    	$data['filter'] = $filter;
    	$data['table_label'] = 'Lihat/Perbarui Data Obat';
    	$data['action'] = 'update';
    	$data['constant_unit'] = $this->MedicineConstant->get_unit();

		$this->load->view('side/header');
		$this->load->view('medicine_form', $data);
		$this->load->view('side/footer');
	}

	// POST ACTION
	public function add() {
		$post = $this->input->post();
		$data['medicine_name'] = $post['medicine_name'];
		$data['unit'] = $post['unit'];
		$data['price'] = $post['price'];
		$data['expired_date'] = $post['expired_date'];
		$data['description'] = $post['description'];

		$result = $this->MedicineModel->add_medicine($data);
		$medicine_id = $this->db->insert_id();

		$data_stock['medicine_id'] = $medicine_id;
		$data_stock['update_stock'] = $post['update_stock'];
		$data_stock['current_stock'] = $post['update_stock'];
		$data_stock['source'] = 1;
		$result2 = $this->MedicineModel->add_stock($data_stock);

		if ($result && $result2) {
			$this->set_alert('success', 'Data Obat baru berhasil ditambahkan');
		} else {
			$this->set_alert('danger', 'Data Obat gagal ditambahkan. Coba ulangi lagi ya.');
		}

		redirect(base_url().'obat/detail?id='.$medicine_id);
		
	}

	public function update() {
		$post = $this->input->post();
		$data['medicine_name'] = $post['medicine_name'];
		$data['unit'] = $post['unit'];
		$data['price'] = $post['price'];
		$data['expired_date'] = $post['expired_date'];
		$data['description'] = $post['description'];
		$data['update_time'] = $this->TimeConstant->get_current_timestamp();

		$result = $this->MedicineModel->update_medicine($data, $post['medicine_id']);
		if ($result) {
			$this->set_alert('success', 'Data Obat berhasil diperbarui');
		} else {
			$this->set_alert('danger', 'Data Obat gagal diperbarui. Coba ulangi lagi ya.');
		}

		redirect(base_url().'obat/detail?id='.$post['medicine_id']);
	}

	public function delete() {
		$medicine_id = $this->input->get('id', TRUE);
		$data['status'] = 3;
		$data['update_time'] = $this->TimeConstant->get_current_timestamp();

		$parameter['q'] = $this->input->get('q', TRUE);
		$parameter['nama_obat'] = $this->input->get('nama_obat', TRUE);
    	$parameter['kadaluarsa'] = $this->input->get('kadaluarsa', TRUE);

		$result = $this->MedicineModel->update_medicine($data, $medicine_id);
		if ($result) {
			$this->set_alert('success', 'Data Obat berhasil dihapus');
		} else {
			$this->set_alert('danger', 'Data Obat gagal dihapus. Coba ulangi lagi ya.');
		}

		redirect(base_url().'obat/?'.$this->build_uri_parameter($parameter));
	}
}

?>