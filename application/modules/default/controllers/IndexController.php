<?php

class Default_IndexController extends Application_Controller
{

    public function init()
    {
    	parent::init();
    }

    public function indexAction()
    {
    	$this->view->headTitle('Homepage');
    }


}

