<?php

/**
 * Base class containing the reflection object which
 * allows our magic __get and __set functions to perform
 * safely.
 */
class Base {
	
	/**
	 * @var RelectionObject reflection object
	 */
	protected $reflection;

	/**
	 * default constructor
	 */
	public function __construct() {
		$this->reflection = new ReflectionObject($this);
	}

	/**
	 * called upon unserialization - reinitiates our reflection objects
	 */ 
	public function __wakeup() {
		$this->reflection = new ReflectionObject($this);
	}

	/**
	 * Magic function to allow for variable retrieval
	 * @param string name of variable
	 * @return mixed returns value of requested variable
	 */
	public function __get($var) {
		if ($this->hasProperty($var)) {
			return $this->$var;
		} else {
			throw new Exception('Property ' . $var . ' does not exist');
		}
	}

	/**
	 * Magic function to allow for variable assignment
	 * @param string name of variable to assign
	 * @param mixed value of variable to assign
	 */
	public function __set($var, $value) {
		if ($this->hasProperty($var)) {
			$this->$var = $value;
		} else {
			throw new Exception('Property ' . $var . ' does not exist.');
		}
	}

	/**
	 * Determines if the requested property exists in this class
	 * @param string name of variable
	 * @return bool whether variable exists
	 */
	protected function hasProperty($name) {
		return $this->reflection->hasProperty($name);
	}
}