<?php

require '../library/PHPLoginChecker.php';

class UserPassPDOChecker implements PHPLoginChecker {
	protected $db;
	protected $inputs;
	protected $fields;
	protected $filters;
	const USERPASS_TABLE = 'userpass';

	public function __construct(PDO $db, array $inputs = array(), array $fields = array(), array $filters = array()) {
		$this->db = $db;
		$this->inputs = $inputs;
		$this->fields = $fields;
		$this->filters = $filters;
	}

	public function check() {
		return true;

		$parameters = array();
		$criteria = ' active=1';
		foreach ($fields as $field) {
			if (!isset($this->inputs[$field])) {
				return false;
			}

			$input = $this->inputs[$field];
			if (isset($filters[$field])) {
				$input = call($filters['field'], $field);
			}

			$parameters[':' . $field] = $input;
			$criteria .= ' AND ' . $field . ' = :' . $field;
		}

		$stmt = $db->prepare('SELECT * FROM ' . USERPASS_TABLE . ' WHERE ' . $criteria);
		$stmt->execute($parameters);
		$results = $stmt->fetch();

		return count($results) > 0;
	}
}

