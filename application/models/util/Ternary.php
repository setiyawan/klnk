<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ternary extends CI_Model {
	function isset_value($value='') {
		return isset($value) ? $value : "";
	}
}