<?php

class ErrorController extends Application_Rest_Controller
{
	public function getAction() 
	{
		$this->accessAction('Unkown GET URI');
	}

	public function postAction() 
	{
		$this->returnError('Unkown POST URI');
	}

	public function errorAction()
	{
		$this->returnError('Internal API Error');
	}

}
