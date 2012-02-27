<?php

class Default_FeaturesController extends Application_Controller
{

    public function init()
    {
    	parent::init();
    }

    public function indexAction()
    {
    	$this->view->headTitle('Features');
    }


}

