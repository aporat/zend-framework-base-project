<?php

class Application_Validate_NotUser extends Zend_Validate_Abstract
{	
	protected $excludeAddress = null;
	
	const REGISTERED_USER_EMAIL = 'invalid';
	const REGISTERED_USER_EMAIL_MESSAGE = 'Email already registered';
	
	protected $_messageTemplates = array(
		self::REGISTERED_USER_EMAIL => self::REGISTERED_USER_EMAIL_MESSAGE,
	);
	
	public function __construct($excludeAddress = null)
	{
		$this->excludeAddress = $excludeAddress;
	}		

	public function isValid($value)
	{	
		// the exclude address is always allowed
		if ($value==$this->excludeAddress) {
			return true;
		}		
		
		$value = strtolower($value);
		
		$modelUsers = new Model_Users;
		$user = $modelUsers->fetchWithEmail($value);

		if ($user instanceof Model_User) {
			$this->isAlreadyRegisteredError = true;
			$this->_error(self::REGISTERED_USER_EMAIL);
			return false;
		}
		return true;
	}
	
}
