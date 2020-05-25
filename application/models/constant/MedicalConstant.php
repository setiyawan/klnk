<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MedicalConstant extends CI_Model {
	function get_blood_group() {
		return array(
			'-' => '-', 
			'A' => 'A',
			'B' => 'B',
			'AB' => 'AB',
			'O' => 'O' 
		);
	}

	function get_conscious() {
		return array(
			'1' => 'Compos Mentis',
			'2' => 'Somnolence',
			'3' => 'Sopor',
			'4' => 'Coma'
		);
	}
}

?>