<?php
class Form_Signin extends Form_Abstract
{
	public function __construct($options = array())
	{
		parent::__construct($options);
		
    	$this->setAttrib('id', 'signin-form');
    	$this->setAttrib('class', 'public-form');
    	 
		$helper = new Application_View_Helper_PortalUrl();    	
		$this->setAction($helper->portalUrl('signin', 'auth'));
    	    	
        $emailField = new Zend_Form_Element_Text('email');
        
        $emailField->setRequired(true)
        			  ->addFilter('StringTrim')
        			  ->addFilter('StripTags')
        			  ->setAttrib('class', 'required text')
				      ->addValidator('NotEmpty', false, array('messages'=>'E-mail address cannot be empty'))
        			  ->addValidator('StringLength', false, array(3, 512))
        			  ->addValidator('EmailAddress')
        			  ->addValidator(new Application_Validate_User())
        			  ->setLabel('E-mail:');
       	$this->addElement($emailField);
       	
       	$passwordField = new Zend_Form_Element_Password('password');
       	$passwordField->addFilter('StringTrim')
       				  ->addFilter('StripTags')
        			  ->setAttrib('class', 'required text')
        			  ->addValidator('NotEmpty', false, array('messages'=>'Password cannot be empty'))
        			  ->addValidator('StringLength', false, array(4, 256))
       				  ->setRequired(true)
       				  ->setLabel('Password:');
       	$this->addElement($passwordField);
       	
       	$rememberField = new Zend_Form_Element_Checkbox('remember');
       	$rememberField->setLabel('Remember Me')
       	->getDecorator('label')->setOption('placement', 'APPEND');
       	
       	$this->addElement($rememberField);
        	
       	$submit = new Zend_Form_Element_Submit('login');
       	$submit->setAttrib('class', 'btn btn-large btn-primary')
		   	   ->setLabel('Sign In');
       	$this->addElement($submit);

    }
}

