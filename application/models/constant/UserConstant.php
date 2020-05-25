<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserConstant extends CI_Model {
	function get_gender() {
		return array('1' => 'Laki-laki', '2' => 'Perempuan' );
	}
}

?>