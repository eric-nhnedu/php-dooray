<?php

namespace Nhn\\PhpDooray;

class DoorayHttpClientHelper {

	private $_authKey;
	private $_apiBaseUrl;

	public function __construct($apiBaseUrl, $doorayAuthKey) {
		$this->_apiBaseUrl = $apiBaseUrl;
		$this->_authKey = $doorayAuthKey;
	}

	public function getJSON($targetUrl) {
		$response = DynamicHttpClient::getJSON($this->_apiBaseUrl.$targetUrl, ['Authorization: dooray-api '.$this->_authKey]);
		if (!$response->header->isSuccessful) {
			throw new Exception($response->header->resultMessage);
		}
		return $response->result;
	}

	public function postJSON($targetUrl, $requestBody = null) {
		$response = DynamicHttpClient::postJSON($this->_apiBaseUrl.$targetUrl, $requestBody, ['Authorization: dooray-api '.$this->_authKey]);
		if (!$response->header->isSuccessful) {
			throw new Exception($response->header->resultMessage);
		}
		return $response->result;
	}

	public function putJSON($targetUrl, $requestBody = null) {
		$response = DynamicHttpClient::putJSON($this->_apiBaseUrl.$targetUrl, $requestBody, ['Authorization: dooray-api '.$this->_authKey]);
		if (!$response->header->isSuccessful) {
			throw new Exception($response->header->resultMessage);
		}
		return $response->result;
	}

	public function deleteJSON($targetUrl) {
		$response = DynamicHttpClient::deleteJSON($this->_apiBaseUrl.$targetUrl, ['Authorization: dooray-api '.$this->_authKey]);
		if (!$response->header->isSuccessful) {
			throw new Exception($response->header->resultMessage);
		}
		return $response->result;
	}
}

