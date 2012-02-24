<?php
/**
 * URL plugin
 */
class Application_View_Helper_PortalUrl extends Zend_View_Helper_Url
{
	/**
	 * creates an url link
	 * 
	 * @param string $action
	 * @param string $controller
	 * @param array $args
	 */
    public function portalUrl($action = 'index', $controller = 'index', $args = array())
    {
    	$_args = array_merge($args, array(
    		'action' => $action,
    		'controller' => $controller
    	));
    	
    	return parent::url(
    		$_args,
    		null,
    		true
    	);
    }
    

}
