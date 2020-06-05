<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Converter extends CI_Model {
	function rupiah($angka){
		if ($angka > 0) {
			$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
			return $hasil_rupiah;
		}

		return "FREE";
	}

	function text_limit($plain_text, $max_character, $subs_text) {
		if (strlen($plain_text) > $max_character) {
			return substr($plain_text, 0, $max_character) . $subs_text; 
		}

		return $plain_text;
	}

	function to_indonesia_short_month($month) {
		$ina_month = array (
			1 => 'Jan',
			'Feb',
			'Mar',
			'Apr',
			'Mei',
			'Jun',
			'Jul',
			'Agu',
			'Sep',
			'Okt',
			'Nov',
			'Des'
		);
		return $ina_month[$month];
	}

	function to_indonesia_timestamp($time_stamp) {
		$date = date('d m Y H:i:s', strtotime($time_stamp));
		$split = explode(' ', $date);
		return $split[0] . ' ' . $this->to_indonesia_short_month((int)$split[1]) . ' ' . $split[2] . ' ' . $split[3];
	}

	function to_indonesia_date($time_stamp) {
		$date = date('d m Y', strtotime($time_stamp));
		$split = explode(' ', $date);
		return $split[0] . ' ' . $this->to_indonesia_short_month((int)$split[1]) . ' ' . $split[2];
	}

	function birth_date_to_age($date) {
		$bday = new DateTime($date); // Your date of birth
		$today = new Datetime(date('m/d/Y'));
		$diff = $today->diff($bday);

		$age = $diff->y . ' Tahun ' .  $diff->m . ' Bulan ' . $diff->d . ' Hari';
		return $age;
	}
}