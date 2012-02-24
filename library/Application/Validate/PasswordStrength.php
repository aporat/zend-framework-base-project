<?php 
class Application_Validate_PasswordStrength extends Zend_Validate_Abstract
{
    const LENGTH = 'length';
    const MIX  = 'mix';
    const LOWER  = 'lower';
    const DIGIT  = 'digit';
 
    protected $_messageTemplates = array(
        self::LENGTH => "Password must be at least 6 characters in length",
        self::MIX  => "Password must contain at least one letter, digit or speical symbol",
    );
 
    public function isValid($value)
    {
        $this->_setValue($value);
 
        $isValid = true;
 
        if (strlen($value) < 6) {
            $this->_error(self::LENGTH);
            $isValid = false;
        }
        
        $strength = 0;
        preg_match_all('/[A-Z]/', $value, $matches);
        $upper = count($matches[0]);
        if (count($matches[0])!=0) {
        	$strength++;
        }

        preg_match_all('/[a-z]/', $value, $matches);
        $lower = count($matches[0]);
        if (count($matches[0])!=0) {
        	$strength++;
        }        
        preg_match_all('/\d/', $value, $matches);
        $digits = count($matches[0]);
        if (count($matches[0])!=0) {
        	$strength++;
        }        
                
        $speical = strlen($value) - $upper - $lower - $digits;
        if ($speical!=0) {
        	$strength++;
        }
                
  		if ($strength<2) {
            $this->_error(self::MIX);
  			return false;
        }
        
        return true;
    }
}