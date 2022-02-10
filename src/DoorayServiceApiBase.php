<?php

namespace Nhn\\PhpDooray\\;
	
class DoorayServiceApiBase {

	private $_commonApiUrl = 'https://api.dooray.com/common/v1';
	private $_projectApiUrl = 'https://api.dooray.com/project/v1';

	protected $_project;

	public function __construct($doorayAuthKey) {
		$this->_common = new DoorayHttpClientHelper($this->_commonApiUrl, $doorayAuthKey);
		$this->_project = new DoorayHttpClientHelper($this->_projectApiUrl, $doorayAuthKey);
	}

	protected function getUrl($urls, $page, $size, $filters) {
		if (!is_null($size)) {
			$urls[] = 'size='.$size.'&';
		}

		if (!is_null($page)) {
			$urls[] = 'page='.$page.'&';
		}

		foreach ($filters as $filterParamName => $paramValue) {
			if (is_array($paramValue)) {
				$urls[] = $filterParamName.'='.implode(',',$paramValue).'&';
			} else {
				$urls[] = $filterParamName.'='.$paramValue.'&';
			}
		}

		return implode('', $urls);
	}

	protected function getCommonList($path, $page = 0, $size = 100, $filters = []) {
		$urls = [$path.'?'];
		$url = $this->getUrl($urls, $page, $size, $filters);
		return $this->_common->getJSON($url);
		
	}

	protected function getProjectList($path, $page = 0, $size = 100, $filters = []) {
		$urls = [$path.'?'];
		$url = $this->getUrl($urls, $page, $size, $filters);
		return $this->_project->getJSON($url);
	}
}
