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
    	    	 
		$this->view->headTitle($config['productName']);
		$this->view->headTitle()->setSeparator(' / ');

    	$helper = new Application_View_Helper_SecureUrl;
    	$this->view->registerHelper($helper, 'secureUrl');
    	 
    	$helper = new Application_View_Helper_DateLong();
    	$this->view->registerHelper($helper, 'dateLong');
    	 
    	$this->view->addScriptPath(APPLICATION_PATH . '/views/');    	
    	
    	$this->view->flashMessages = $this->_helper->flashMessenger->getMessages();
    	$this->_helper->flashMessenger->clearMessages();
  
    	$this->view->errors = array();
    	
    	// navigation
    	$pages = array(
    			array(
    					'label'      => 'Home',
    					'title'      => 'Go Home',
    					'module'     => 'default',
    					'controller' => 'index',
    					'action'     => 'index',
    					'order'      => -100
    			),
    			array(
    					'label'      => 'Features',
    					'title'      => 'Features',
    					'module'     => 'default',
    					'controller' => 'features',
    					'action'     => 'index',
    			)
    	);
    	
    	$container = new Zend_Navigation($pages);
    	$this->view->navigation($container);
    	
    }
}