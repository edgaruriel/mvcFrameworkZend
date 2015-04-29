<?php
class Operator_RentedMoviesController extends Zend_Controller_Action
{
    public function preDispatch()
    {
    	if (!Application_Service_Authentication::getInstance()->isAuthentication()) {
    		$this->_redirect('login');
    	}else{
    		if(Application_Service_Authentication::getInstance()->getTypeUser()==1){
    		    $this->_redirect('login');
    		}
    	}
    }
    
    public function init()
    {
    	/* Initialize action controller here */
    	$this->view->controller = 'index';
    	$this->view->action = $this->getRequest()->getActionName();
    }
    /**
     * The default action - show the home page
     */
    public function indexAction(){
        
    }
    
    public function newAction(){
        $clientService = new Application_Service_Client();
        $this->view->clients = $clientService->findAll();
        
        $movieService = new Application_Service_Movie();
        $this->view->movies = $movieService->findAll();
    }
    
}

?>