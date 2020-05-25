<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Dashboard extends My_Controller {

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
        $this->load->model('PatientModel');
    }
    
    // GET ACTION
    public function index() {
    	$data['active_menu']['active_left_navbar'] = 'dashboard';
    	
    	$filter['x_days'] = $this->TimeConstant->get_date_min_x_days(2);
    	$data['patient_count'] = $this->PatientModel->get_patient_count();
    	$data['medical_record_count'] = $this->MedicalRecordModel->get_medical_record_count();
    	$data['medical_record_count_7_days'] = $this->MedicalRecordModel->get_medical_record_count($filter);

		$this->load->view('side/header');
		$this->load->view('dashboard', $data);
		$this->load->view('side/footer');
	}
}