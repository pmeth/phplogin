<?php

class PHPLogin {
	protected $checkers;

	public function __construct() {
		$this->checkers = array();
	}

	function addChecker(PHPLoginChecker $checker) {
		$this->checkers[] = $checker;
	}

	function getUser() {
		foreach ($this->checkers as $checker) {
			$result = $checker->check();
			if ($result === 'skip') {
				continue;
			}
			if ($result === true) {
				return array('name' => 'peter', 'type' => 'authenticated');
			}

			if ($result === false) {
				return array('type' => 'anonymous');
			}
		}

		return array('type' => 'anonymous');
	}

	function getToken() {
		return rand();
	}
}
