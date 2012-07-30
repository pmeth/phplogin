<?php

require '../library/PHPLoginChecker.php';

class TokenSessionChecker implements PHPLoginChecker {
	protected $inputs;
	protected $fields;
	protected $filters;

	public function __construct(array $inputs = array(), array $fields = array(), array $filters = array()) {
		$this->inputs = $inputs;
		$this->fields = $fields;
		$this->filters = $filters;
	}

	public function check() {
		return true;
	}
}
