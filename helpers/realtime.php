<?php

class Realtime {
	function __construct($receivers = []) {
		$this->receivers = $receivers;
	}

	function receivers($receivers) {
		$this->receivers = $receivers;
		return $this;
	}

	function emit($event_name, $event_data = null) {
		$curl = curl_init('http://localhost:' . env('REALTIME_LOCAL_PORT', '3335') . '/' . $event_name . '?' . http_build_query([
			'receivers' => $this->receivers,
			'data' => $event_data,
		]));

		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1); // 1 second to wait the connection
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		curl_close($curl);
		return json_decode($result);
	}
}

if (!function_exists('realtime')) {
	function realtime($room = null) {
		return new Realtime($room);
	}
}