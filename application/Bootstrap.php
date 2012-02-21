<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initAutoload()
	{
		$autoloader = new Zend_Application_Module_Autoloader(array(
				'namespace' => '',
				'basePath'  => dirname(__FILE__),
		));
	
		$autoloader = Zend_Loader_Autoloader::getInstance()
		->registerNamespace('Application')
		->registerNamespace('Services');
	
		return $autoloader;
	}

	protected function _initModules()
	{
		$front = Zend_Controller_Front::getInstance();
		$front->addModuleDirectory(APPLICATION_PATH . '/modules');
		
		$frontController = Zend_Controller_Front::getInstance();
	
	}
	
}

