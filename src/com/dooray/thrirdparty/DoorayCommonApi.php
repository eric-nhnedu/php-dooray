<?php

namespace com\dooray\thrirdparty;

class DoorayCommonApi extends DoorayServiceApiBase {
	public function getMembers($page = 0, $size = 100, $filters = []) {
		return $this->getCommonList('/members', $page, $size, $filters);
	}
}
