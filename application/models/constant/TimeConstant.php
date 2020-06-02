<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TimeConstant extends CI_Model {
	function get_current_timestamp() {
		return  date("Y-m-d h:i:s");
	}

	function get_current_date() {
		return  date("Y-m-d");
	}

	function get_current_year() {
		return  date("Y");
	}

	function get_current_month() {
		return  date("m");
	}

	function get_current_day() {
		return  date("d");
	}

	function get_date_min_x_days($day) {
		$modify = '-' .  $day. ' day';
		$current = $this->get_current_timestamp();

		return date('Y-m-d', strtotime($modify, strtotime($current)));
	}
}

?>