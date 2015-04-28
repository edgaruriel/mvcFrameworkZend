<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $this->view->action = $this->getRequest()->getActionName();
    }

    public function indexAction()
    {
        // action body
    }
    
    public function deniedAction()
    {
        $this->_helper->layout()->disableLayout();
    	// action body
    }
}

