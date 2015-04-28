<?php

class LoginController extends Zend_Controller_Action {

	public function indexAction(){
	    $this->_helper->layout()->disableLayout();
	    if($this->getRequest()->isPost()){
	        $data = $this->getRequest()->getParams();
	        $authentication = Application_Service_Authentication::getInstance();
	        $isAuthentication = $authentication->login($data);
	        switch($isAuthentication->getCode()){
	        	case Zend_Auth_Result::SUCCESS:
	        	    switch($isAuthentication->getIdentity()->type_user_id){
	        	    	case Application_Model_TypeUser::$typeUserArray['ADMIN']:
	        	    	    $this->_redirect('admin/index/index');
	        	    	    break;
        	    	    case Application_Model_TypeUser::$typeUserArray['EMPLOYEE']:
        	    	    	$this->_redirect('operator/index/index');
        	    	    	break;
	    	    		default:
	    	    		    $this->_redirect('login');
	    	    		    break;
	        	    }
	        	    break;
	        	case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
	        	    $messageArray = $isAuthentication->getMessages();
	        	    $this->view->error = $messageArray[0];
	        	    break;
	        	case Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS:
	        	    $messageArray = $isAuthentication->getMessages();
	        	    $this->view->error = $messageArray[0];
	        	    break;
	        	case Zend_Auth_Result::FAILURE:
	        	    $messageArray = $isAuthentication->getMessages();
	        	    $this->view->error = $messageArray[0];
	        	    break;   
	        }
	    }
	}
	
	public function logoutAction(){
		$authentication = Application_Service_Authentication::getInstance();
		$authentication->logout();
		$this->_redirect('login');
	}

}