<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MedicineConstant extends CI_Model {
	function get_unit() {
		return array('1' => 'Butir', '2' => 'Strip' );
	}

	function get_expired_medicine() {
		return array('' => 'Semua', '1' => 'Masih Berlaku', '2' => 'Kadaluarsa');
	}

	function get_status_medicine() {
		return array('1' => 'Tersedia', '2' => 'Tidak Tersedia', '3' => 'Dihapus');
	}
}

?>