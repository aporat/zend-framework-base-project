<?php
/**
 * URL plugin
 */
class Application_View_Helper_SecureUrl extends Zend_View_Helper_Url
{
	/**
	 * Scheme
	 *
	 * @var string
	 */
	protected $_scheme;
	
	/**
	 * Host (including port)
	 *
	 * @var string
	 */
	protected $_host;
	
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		switch (true) {
			case (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] === true)):
			case (isset($_SERVER['HTTP_SCHEME']) && ($_SERVER['HTTP_SCHEME'] == 'https')):
			case (isset($_SERVER['SERVER_PORT']) && ($_SERVER['SERVER_PORT'] == 443)):
				$scheme = 'https';
				break;
			default:
				$scheme = 'http';
		}
		$this->setScheme($scheme);
	
		if (isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])) {
			$this->setHost($_SERVER['HTTP_HOST']);
		} else if (isset($_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT'])) {
			$name = $_SERVER['SERVER_NAME'];
			$port = $_SERVER['SERVER_PORT'];
	
			if (($scheme == 'http' && $port == 80) ||
					($scheme == 'https' && $port == 443)) {
				$this->setHost($name);
			} else {
				$this->setHost($name . ':' . $port);
			}
		}
	}
	
	/**
	 * Returns host
	 *
	 * @return string  host
	 */
	public function getHost()
	{
		return $this->_host;
	}
	
	/**
	 * Sets host
	 *
	 * @param  string $host                new host
	 * @return Zend_View_Helper_ServerUrl  fluent interface, returns self
	 */
	public function setHost($host)
	{
		$this->_host = $host;
		return $this;
	}
	
	/**
	 * Returns scheme (typically http or https)
	 *
	 * @return string  scheme (typically http or https)
	 */
	public function getScheme()
	{
		return $this->_scheme;
	}
	
	/**
	 * Sets scheme (typically http or https)
	 *
	 * @param  string $scheme              new scheme (typically http or https)
	 * @return Zend_View_Helper_ServerUrl  fluent interface, returns self
	 */
	public function setScheme($scheme)
	{
		$this->_scheme = $scheme;
		return $this;
	}
	
    /**
     * Generates an url given the name of a route.
     *
     * @access public
     *
     * @param  array $urlOptions Options passed to the assemble method of the Route object.
     * @param  mixed $name The name of a Route to use. If null it will use the current Route
     * @param  bool $reset Whether or not to reset the route defaults with those provided
     * @return string Url for the link href attribute.
     */
    public function secureUrl(array $urlOptions = array(), $name = null, $reset = false, $encode = true)
    {
    	$config = Zend_Registry::get('config');
    	
    	if ($config->ssl) {
    		$this->setScheme('https');
    	} else {
    		$this->setScheme('http');
    	}
    	
    	return $this->getScheme() . '://' . $this->getHost() . parent::url($urlOptions, $name, $reset, $encode);
    }
    

}
