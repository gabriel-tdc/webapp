<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utils {
	public function convertInSeconds($time) {
		list($hour, $minute, $second) = explode(":", $time);
		$totalSeconds = ($second) +
						($minute * 60) +
						($hour * 60 * 60);

		return $totalSeconds;
	}
	
	public function convertSecondsInDate($seconds){
		$hours = floor($seconds / 3600);
		$minutes = floor(($seconds / 60) % 60);
		$seconds = $seconds % 60;			
		$time = str_pad($hours, 2 , '0', STR_PAD_LEFT) . ':' . str_pad($minutes, 2 , '0', STR_PAD_LEFT);
		return $time;
	}
}
