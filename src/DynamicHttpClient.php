<?php

namespace Nhn\\PhpDooray;

class DynamicHttpClient {
	public static function send($httpMethod, 
								$targetUrl, 
								$requestBody = null, 
								$headers = [], 
								$contentType = 'application/x-www-form-urlencoded', 
								$responseJson = true) {

		$headers[] = 'Content-Type: application/json';

		$curl = curl_init();

		$curlOpt = [
			CURLOPT_URL => $targetUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_CUSTOMREQUEST => $httpMethod,
			CURLOPT_POSTFIELDS => $requestBody,
			CURLOPT_HTTPHEADER => $headers
		];

		curl_setopt_array($curl, $curlOpt);

		$response = curl_exec($curl);
		curl_close($curl);

		if ($responseJson) {
			return json_decode($response);
		}

		return $response;
	}

	public static function get($targetUrl, $headers = [], $contentType = null, $responseJson = false) {
		return self::send('GET', $targetUrl, null, $headers, $contentType, $responseJson);
	}

	public static function post($targetUrl, $requestBody, $headers = [], $contentType = null, $responseJson = false) {
		return self::send('POST', $targetUrl, $requestBody, $headers, $contentType, $responseJson);
	}

	public static function put($targetUrl, $requestBody, $headers = [], $contentType = null, $responseJson = false) {
		return self::send('PUT', $targetUrl, $requestBody, $headers, $contentType, $responseJson);
	}

	public static function delete($targetUrl, $headers = [], $contentType = null, $responseJson = false) {
		return self::send('DELETE', $targetUrl, null, $headers, $contentType, $responseJson);
	}


	public static function getJSON($targetUrl, $headers = []) {
		return self::send('GET', $targetUrl, null, $headers, 'application/json', true);
	}

	public static function postJSON($targetUrl, $requestBody, $headers = []) {
		return self::send('POST', $targetUrl, json_encode($requestBody), $headers, 'application/json', true);
	}

	public static function putJSON($targetUrl, $requestBody, $headers = []) {
		return self::send('PUT', $targetUrl, json_encode($requestBody), $headers, 'application/json', true);
	}

	public static function deleteJSON($targetUrl, $headers = []) {
		return self::send('DELETE', $targetUrl, null, $headers, 'application/json', true);
	}
}
