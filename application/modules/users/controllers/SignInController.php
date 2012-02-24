<?php

class Users_SignInController extends Application_Controller
{

    public function init()
    {
    	parent::init();
    }

    public function indexAction()
    {
    	
    	$modelUsers = new Model_Users;
    	// signin form
    	$form = $this->getSigninForm();
    	
    	
    	$this->view->errors = array();
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$post = $request->getPost();
    		
    		if ($form->isValid($post)) {
    			$values = $form->getValues();

    			$info = array (
    				'email' => $values['email'],
    				'password' => $values['password'],
    			);

    			if (Application_Auth::attemptLogin($info)) {
    				$user = Application_Auth::revalidate();
    				$user->last_login = date('Y-m-d H:i:s');
    				$user->save();

					return $this->_helper->redirector('index', 'dashboard');
     			} else {
    				$this->view->errors = array(array('message' => 'Invalid email or password'));
    			}
    		} else {
    			$this->view->errors = $form->errors();
    		}
    	}
    	
    	$this->view->form = $form;
    }
    

    
    public function signoutAction()
    {
		Zend_Auth::getInstance()->clearIdentity();
		
		return $this->_helper->redirector('signin');
    } 
		
    private function getSigninForm()
    {
    	$form = new Form_Signin(array(
    		'method' => 'post',
    		'action' => $this->_helper->url('signin'),
    	));
    	    	
    	return $form;
    }  


}

