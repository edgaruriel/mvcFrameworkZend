<?php
class Admin_CashRegisterController extends Zend_Controller_Action
{
    public function preDispatch()
    {
    	if (!Application_Service_Authentication::getInstance()->isAuthentication()) {
    		$this->_redirect('login');
    	}else{
    		if(Application_Service_Authentication::getInstance()->getTypeUser()==2){
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
        $movieService = new Application_Service_Movie();
        $this->view->moviesRented = $movieService->findAllMovieToday();
    }
    
}

?>