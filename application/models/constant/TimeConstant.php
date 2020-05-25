<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TimeConstant extends CI_Model {
	function get_current_timestamp() {
		return  date("Y-m-d h:i:s");
	}

	function get_date_min_x_days($day) {
		$modify = '-' .  $day. ' day';
		$current = $this->get_current_timestamp();

		return date('Y-m-d', strtotime($modify, strtotime($current)));
	}
}

?>