<?php

class API_IndexController extends Application_Rest_Controller
{
	public function init()
	{
		parent::init();
		
	}

	public function getAction()
	{
		$id = $this->_getParam('id');
		
		$data = array();
		if (is_numeric($id)) {
			$data['response'] = $this->get();
		} else {
			$data['response'] = $this->listAll();
		}

		$this->sendResponse($data);
	}
	
	private function listAll()
	{	
		$items = array();
		$items[] = array('id' => 1, 'title' => 'Test 1');
		$items[] = array('id' => 2, 'title' => 'Test 2');
				
		return $items;
	}
	
	
	private function get()
	{
		$id = $this->_getParam('id', '');
		
		return array('id' => 1);
	}
	
	
	public function postAction()
	{
		$id = $this->_getParam('id', '');
	
		$data = array();
		if (is_numeric($id)) {
			$data['response'] = $this->update();
		} else {
			$data['response'] = $this->add();
		}
	
		$this->sendResponse($data);
	}
	
	private function update()
	{
		try {
				
		} catch (Exception $e) {
			$this->returnError($e->getMessage());
		}
	
		return array('id' => 1);
	}
	
	private function add()
	{
		try {
			
		} catch (Exception $e) {
			$this->returnError($e->getMessage());
		}
		
		return array('id' => 1);
	}
}