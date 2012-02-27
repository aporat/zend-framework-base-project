<?php

abstract class Application_Rest_Controller extends Zend_Rest_Controller
{
	private $contexts = array(
        'get' => array('xml', 'json')
    );
	
	public function init()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->no_results = array('status' => 'NO_RESULTS');

        $this->_helper->contextSwitch()->initContext();
		
        $this->_helper->contextSwitch()->setAutoJsonSerialization(false);
	        
		parent::init();
	}

	protected function returnError($errorMessage) {
		
		$data = array(
			'response' => array(
				'message' => $errorMessage
			),
			'status' => 'failed'
		);
		
		$this->sendResponse($data);

	}

	/**
	 * send the response as a XML or JSON
	 * 
	 * @param unknown_type $data
	 */
	protected function sendResponse($data) {
		
		if (!empty($data['response']) && !array_key_exists('status', $data)) {
			$data['status'] = 'success';
		}
		
		$format = $this->_getParam('format', 'xml');
		
		if ($format=='xml') {
			header ("content-type: text/xml");
			echo $this->formatXmlString($this->toXml($data));
			
		} else {
			echo $this->_helper->json($data, array('enableJsonExprFinder' => false));
		}		
		exit;

	}

	/**
	 * The index action handles index/list requests; it should respond with a
	 * list of the requested resources.
	 */
	public function indexAction() {
		//HTTP code 500 might not good choice here.
		$this->getResponse ()->setHttpResponseCode ( 500 );
		$this->getResponse ()->appendBody ( "no list/index allowed" );

	}

	/**
	 * The post action handles POST requests; it should accept and digest a
	 * POSTed resource representation and persist the resource state.
	 */
	public function putAction() {
		$this->_forward('post');
	}
	

	/**
	 * The delete action handles DELETE requests and receives an 'id'
	 * parameter; it should update the server resource state of the resource
	 * identified by the 'id' value.
	 */
	public function deleteAction() {

	}


	/**
	 * The main function for converting to an XML document.
	 * Pass in a multi dimensional array and this recrusively loops through and builds up an XML document.
	 *
	 * @param array $data
	 * @param SimpleXMLElement $xml - should only be used recursively
	 * @return string XML
	 */
	private function toXml($data, $xml = null)
	{
		if ($xml == null) {
			$xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><data />");
		}
 
		// loop through the data passed in.
		foreach($data as $key => $value) {
			// no numeric keys in our xml please!
			if (is_numeric($key)) {
				$key = 'item';
			}
 
			// replace anything not alpha numeric
			$key = preg_replace('/[^a-z_]/i', '', $key);
 
			// if there is another array found recrusively call this function
			if (is_array($value)) {
				$node = $xml->addChild($key);
				$this->toXml($value, $node);
			} else {
				// add single node.
                $value = htmlentities($value);
				$xml->addChild($key,$value);
			}
		}
		
		return $xml->asXML();
	}

 
    
 	private function formatXmlString($xml) {  
	  
		$dom = new DOMDocument;
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml);
		
		echo $dom->saveXML();
	}  
}