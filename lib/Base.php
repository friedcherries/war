<?php

class Base {
	
	protected $reflection;

	public function __construct() {
		$this->reflection = new ReflectionObject($this);
	}

	public function __wakeup() {
		$this->reflection = new ReflectionObject($this);
	}

	public function __get($var) {
		if ($this->hasProperty($var)) {
			return $this->$var;
		} else {
			throw new Exception('Property ' . $var . ' does not exist');
		}
	}

	public function __set($var, $value) {
		if ($this->hasProperty($var)) {
			$this->$var = $value;
		} else {
			throw new Exception('Property ' . $var . ' does not exist.');
		}
	}

	protected function hasProperty($name) {
		return $this->reflection->hasProperty($name);
	}
}