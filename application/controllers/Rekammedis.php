<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class RekamMedis extends My_Controller {

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
        $this->load->model('MedicalRecordModel');
        $this->load->model('MedicineModel');
        $this->load->model('MedicineRecordModel');
        $this->load->model('PatientModel');
    }
    
    // GET ACTION
    public function index() {
    	$data['active_menu']['active_left_navbar'] = 'medical_record';

    	$filter['medical_record_number'] = $this->input->get('nomor_rekam_medis', TRUE);
    	$filter['patient_name'] = $this->input->get('nama', TRUE);
    	$filter['visit_date'] = $this->input->get('tgl_kunjungan', TRUE);

    	$q = $this->input->get('q', TRUE);
    	$data['medical_record'] = [];
    	$data['default_patient_id'] = "";

    	if (isset($q) && $q = 'search') {
    		$data['medical_record'] = $this->MedicalRecordModel->get_medical_record($filter);

    		if (empty($data['medical_record'])) {
		    	$patient = $this->PatientModel->get_patient($filter);
		    	if (!empty($patient)) {
			    	$data['default_patient_id'] = $patient[0]['patient_id'];
		    	}
    		}
    	}

    	$data['filter'] = $filter;
    	
		$this->load->view('side/header');
		$this->load->view('medical_record', $data);
		$this->load->view('side/footer');
	}

	public function tambah() {
		$get = $this->input->get();
		if ($get['idpasien'] == "") {
			redirect(base_url().'rekammedis');
		}
		$filter['patient_id'] = $get['idpasien'];

    	$data['active_menu']['active_left_navbar'] = 'medical_record';
		$data['table_label'] = 'Tambah Data Rekam Medis';
		$data['add_js'] = 'medical-record';

		$data['default_value']['patient_id'] = $get['idpasien'];
		$patient = $this->PatientModel->get_patient($filter);
    	if (!empty($patient)) {
			$data['default_value']['patient_name'] = $patient[0]['patient_name'];
			$data['default_value']['birth_date'] = $patient[0]['birth_date'];
    	} else {
			redirect(base_url().'rekammedis');
    	}

		$data['action'] = 'add';
		$data['constant_conscious'] = $this->MedicalConstant->get_conscious();
		$data['medicine_record'] = [];
    	$data['medicine'] = $this->MedicineModel->get_medicine();

		$this->load->view('side/header');
		$this->load->view('medical_record_form', $data);
		$this->load->view('side/footer');
	}

	public function detail() {
    	$data['active_menu']['active_left_navbar'] = 'medical_record';
    	$data['table_label'] = 'Lihat/Perbarui Data Rekam Medis';
    	$data['add_js'] = 'medical-record';

		$filter['medical_record_id'] = $this->input->get('id', TRUE);
		if (empty($filter['medical_record_id'])) {
			redirect(base_url().'rekammedis');
		}

    	$data['medical_record'] = $this->MedicalRecordModel->get_medical_record($filter);
    	$data['medicine_record'] = $this->MedicineRecordModel->get_medicine_record($filter);
    	$data['medicine'] = $this->MedicineModel->get_medicine();

    	$data['filter'] = $filter;
    	$data['action'] = 'update';
    	$data['constant_conscious'] = $this->MedicalConstant->get_conscious();

		$this->load->view('side/header');
		$this->load->view('medical_record_form', $data);
		$this->load->view('side/footer');
	}

	// POST ACTION
	public function add() {
		$post = $this->input->post();
		$data['doctor_id'] = $this->get_session_by_id('user_id');
		$data['patient_id'] = $post['patient_id'];
		$data['symptom'] = $post['symptom'];
		$data['conscious'] = $post['conscious'];
		$data['blood_pressure'] = $post['blood_pressure'];
		$data['pulse'] = $post['pulse'];
		$data['body_temperature'] = $post['body_temperature'];
		$data['respiration'] = $post['respiration'];
		$data['height'] = $post['height'];
		$data['weight'] = $post['weight'];
		$data['diagnosis'] = $post['diagnosis'];
		$data['therapy'] = $post['therapy'];
		$data['lab_result'] = $post['lab_result'];
		$data['patient_education'] = $post['patient_education'];
		$data['service_fee'] = $post['service_fee'];
		
		$result = $this->MedicalRecordModel->add_medical_record($data);
		$medical_record_id = $this->db->insert_id();
		
		$this->upsert_medicine_record($post, $medical_record_id);
		if ($result) {
			$this->set_alert('success', 'Data Rekam Medis berhasil ditambahkan');
		} else {
			$this->set_alert('danger', 'Data Rekam Medis gagal ditambahkan. Coba ulangi lagi ya.');
		}

		redirect(base_url().'rekammedis/detail?id='.$medical_record_id);
		
	}

	public function update() {
		$post = $this->input->post();
		$data['symptom'] = $post['symptom'];
		$data['conscious'] = $post['conscious'];
		$data['blood_pressure'] = $post['blood_pressure'];
		$data['pulse'] = $post['pulse'];
		$data['body_temperature'] = $post['body_temperature'];
		$data['respiration'] = $post['respiration'];
		$data['height'] = $post['height'];
		$data['weight'] = $post['weight'];
		$data['diagnosis'] = $post['diagnosis'];
		$data['therapy'] = $post['therapy'];
		$data['lab_result'] = $post['lab_result'];
		$data['patient_education'] = $post['patient_education'];
		$data['service_fee'] = $post['service_fee'];
		$data['update_time'] = $this->TimeConstant->get_current_timestamp();
		$medical_record_id = $post['medical_record_id'];

		$result = $this->MedicalRecordModel->update_medical_record($data, $medical_record_id);
		$this->upsert_medicine_record($post, $medical_record_id);
		if ($result) {
			$this->set_alert('success', 'Data Rekam Medis berhasil diperbarui');
		} else {
			$this->set_alert('danger', 'Data Rekam Medis gagal diperbarui. Coba ulangi lagi ya.');
		}

		redirect(base_url().'rekammedis/detail?id='.$medical_record_id);
	}

	function upsert_medicine_record($data, $medical_record_id) {
		$this->MedicineRecordModel->delete_medicine_record($data['medicine_record_id'], $medical_record_id);

		for ($i = 0; $i < count($data['medicine_id']); $i++) { 
			$data_medicine_record['medicine_id'] = $data['medicine_id'][$i];
			$data_medicine_record['dosis'] = $data['dosis'][$i];
			$data_medicine_record['total_amount'] = $data['amount'][$i];
			$data_medicine_record['update_time'] = $this->TimeConstant->get_current_timestamp();

			if ($data['medicine_record_id'][$i] != "") {
				$this->MedicineRecordModel->update_medicine_record($data_medicine_record, $data['medicine_record_id'][$i]);
			} elseif ($data['medicine_id'][$i] != "") {
				$data_medicine_record['medical_record_id'] = $medical_record_id;
				$this->MedicineRecordModel->add_medicine_record($data_medicine_record);
			}
		}
	}
}

?>