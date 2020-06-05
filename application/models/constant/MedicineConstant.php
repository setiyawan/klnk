<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MedicineConstant extends CI_Model {
	function get_unit() {
		$unit =  array(
			'1' => 'Tablet', 
			'2' => 'Kapsul', 
			'3' => 'Strip', 
			'4' => 'Botol',
			'5' => 'Ampul',
			'6' => 'Tube',
			'7' => 'Sachet'
		);
		asort($unit);
		
		return $unit;
	}

	function get_expired_medicine() {
		return array(
			'' => 'Semua', 
			'1' => 'Masih Berlaku', 
			'2' => 'Kadaluarsa')
		;
	}

	function get_status_medicine() {
		return array(
			'1' => 'Tersedia', 
			'2' => 'Tidak Tersedia', 
			'3' => 'Dihapus'
		);
	}
}

?>