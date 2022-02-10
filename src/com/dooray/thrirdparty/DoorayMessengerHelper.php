<?php

namespace com\dooray\thrirdparty;

class DoorayMessengerHelper {
	public static function sendMessage($url, $message, $botName = null, $botIcon = null) {
		$requestBody = [
			"botName" => $botName,
			"botIconImage" => $botIcon,
			"text" => $message
		];

		return DynamicHttpClient::postJSON($url, $requestBody);
	}
}
