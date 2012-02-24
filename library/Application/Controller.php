<?php

class Application_Controller extends Zend_Controller_Action
{

	/**
	 * @var Model_User
	 */
	protected $_user;
	
	/**
	 * @var Model_Account
	 */
	protected $_account;
	
    public function init()
    {
		$config = $this->getInvokeArg('bootstrap')->getOptions();		
    	    	 
		$this->view->headTitle($config['productName'], Zend_View_Helper_Placeholder_Container_Abstract::SET);
    	$this->pageTitle = $config['productName'];

       	// preload helpers
		$helper = new Application_View_Helper_PortalUrl;    	
    	$this->view->registerHelper($helper, 'portalUrl');

    	$helper = new Application_View_Helper_SecureUrl;
    	$this->view->registerHelper($helper, 'securePortalUrl');
    	 
    	
    	$helper = new Application_View_Helper_DateLong();
    	$this->view->registerHelper($helper, 'dateLong');
    	 
    	
    	$this->view->flashMessages = $this->_helper->flashMessenger->getMessages();
    	$this->_helper->flashMessenger->clearMessages();
    	/*
    	$this->_user = Application_Auth::revalidate();
    	$this->view->user = $this->_user;
    	Zend_Registry::set('user', $this->_user);
    	*/
    	if ($this->_user instanceof Model_User) {
	    	$roles = $this->_user->findDependentRowset('Model_Users_Roles');
	    	$role = $roles->current();
	    	
	    	$this->_account = $role->findParentRow('Model_Accounts');
    	}
    	
    	$this->view->errors = array();
    }
}