<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Pasien extends My_Controller {

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
        $this->load->model('PatientModel');
    }
    
    // GET ACTION
    public function index() {
    	$data['active_menu']['label_top_navbar'] = 'PASIEN';
    	$data['active_menu']['active_left_navbar'] = 'patient';

    	$filter['patient_name'] = $this->input->get('nama', TRUE);
    	$filter['id_card_number'] = $this->input->get('nomor_identitas', TRUE);
    	$filter['medical_record_number'] = $this->input->get('nomor_rekam_medis', TRUE);

    	$q = $this->input->get('q', TRUE);
    	$data['patient'] = [];
    	if (isset($q) && $q = 'search') {
    		$data['patient'] = $this->PatientModel->get_patient($filter);
    	}
    	$data['filter'] = $filter;

		$this->load->view('side/header');
		$this->load->view('patient', $data);
		$this->load->view('side/footer');
	}

	public function tambah() {
    	$data['active_menu']['active_left_navbar'] = 'patient';
    	$data['active_menu']['label_top_navbar'] = 'PASIEN';

		$data['table_label'] = 'Tambah Data Pasien';
		$data['action'] = 'add';
		$data['constant_gender'] = $this->UserConstant->get_gender();
		$data['constant_blood_group'] = $this->MedicalConstant->get_blood_group();

		$this->load->view('side/header');
		$this->load->view('patient_form', $data);
		$this->load->view('side/footer');
	}

	public function detail() {
    	$data['active_menu']['active_left_navbar'] = 'patient';
    	$data['active_menu']['label_top_navbar'] = 'PASIEN';
    	
		$filter['patient_id'] = $this->input->get('id', TRUE);

    	$data['patient'] = $this->PatientModel->get_patient($filter);
    	$data['filter'] = $filter;
    	$data['table_label'] = 'Lihat/Perbarui Data Pasien';
    	$data['action'] = 'update';
		$data['constant_gender'] = $this->UserConstant->get_gender();
		$data['constant_blood_group'] = $this->MedicalConstant->get_blood_group();

		$this->load->view('side/header');
		$this->load->view('patient_form', $data);
		$this->load->view('side/footer');
	}

	// POST ACTION
	public function add() {
		$post = $this->input->post();
		$data['patient_name'] = $post['patient_name'];
		$data['birth_date'] = $post['birth_date'];
		$data['job'] = $post['job'];
		$data['gender'] = $post['gender'];
		$data['id_card_number'] = $post['id_card_number'];
		$data['blood_group'] = $post['blood_group'];
		$data['address'] = $post['address'];
		$data['medical_record_number'] = 'MR' . $this->PatientModel->get_latest_patient_id();
		
		$result = $this->PatientModel->add_patient($data);
		if ($result) {
			$this->set_alert('success', 'Data Pasien baru berhasil ditambahkan');
		} else {
			$this->set_alert('danger', 'Data Pasien gagal ditambahkan. Coba ulangi lagi ya.');
		}

		redirect(base_url().'pasien/detail?id='.$this->db->insert_id());		
	}

	public function update() {
		$post = $this->input->post();
		$data['patient_name'] = $post['patient_name'];
		$data['birth_date'] = $post['birth_date'];
		$data['job'] = $post['job'];
		$data['gender'] = $post['gender'];
		$data['id_card_number'] = $post['id_card_number'];
		$data['blood_group'] = $post['blood_group'];
		$data['address'] = $post['address'];
		$data['update_time'] = $this->TimeConstant->get_current_timestamp();

		$result = $this->PatientModel->update_patient($data, $post['patient_id']);
		if ($result) {
			$this->set_alert('success', 'Data Pasien berhasil diperbarui');
		} else {
			$this->set_alert('danger', 'Data Pasien gagal diperbarui. Coba ulangi lagi ya.');
		}

		redirect(base_url().'pasien/detail?id='.$post['patient_id']);
	}
}

?>