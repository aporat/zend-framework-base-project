<?php

class Application_Validate_User extends Zend_Validate_Abstract
{
	const INVALID_USER_EMAIL = 'invalid';
	
	protected $_messageTemplates = array(
		self::INVALID_USER_EMAIL => "Email doesn't exist",
	);
	
	
	public function isValid($value)
	{
		$modelUsers = new Model_Users();
		$user = $modelUsers->fetchWithEmail($value);
	
		if (!$user instanceof Model_User) {
			$this->_error(self::INVALID_USER_EMAIL);
			return false;
		}
		
		return true;
	}
	
}