<?php
class Application_Controller_Plugin_ModuleLoader extends Zend_Controller_Plugin_Abstract
{
	/**
	 * load the module resources
	 * 
     * @param Zend_Controller_Request_Abstract $request
     * @return Zend_Controller_Plugin_Abstract
     */
	
	
	public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request)
	{
		$autoloader = Zend_Loader_Autoloader::getInstance();
		
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
				'basePath'      => APPLICATION_PATH .'/modules/' . $request->getModuleName(),
				'namespace'     => '',
				'resourceTypes' => array(
						'acl' => array(
								'path'      => 'acls/',
								'namespace' => 'Acl',
							),
						'form' => array(
								'path'      => 'forms/',
								'namespace' => 'Form',
							),
						'model' => array(
								'path'      => 'models/',
								'namespace' => 'Model',
							),
						)
                ));

		return $this;
	}
        
}