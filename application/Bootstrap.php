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
		$frontController = Zend_Controller_Front::getInstance();
		$frontController->addModuleDirectory(APPLICATION_PATH . '/modules');
		$frontController->setParam('prefixDefaultModule', true);

		
		$frontController->registerPlugin(new Application_Controller_Plugin_ModuleLoader());
		
		
		$options = $this->getOptions();
		$systemDomainName = $options['system']['domain'];
		
		// our api is located at api.domainname.com
		if ( ($_SERVER['HTTP_HOST'] == 'api.' . $systemDomainName)) {
			$frontController->setDefaultModule('api');
		
			$restRoute = new Zend_Rest_Route($frontController);
			$frontController->getRouter()->addRoute('default', $restRoute);
		}
			
	}
	
}

