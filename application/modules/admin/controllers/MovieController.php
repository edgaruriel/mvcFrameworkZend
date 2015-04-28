<?php
class Admin_MovieController extends Zend_Controller_Action
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
    	$this->view->controller = 'catalog';
    	$this->view->action = $this->getRequest()->getActionName();
    }
    /**
     * The default action - show the home page
     */
    public function indexAction(){
        $movieService = new Application_Service_Movie();
        $this->view->movies = $movieService->findAll();
    }
	
	public function newAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getParams();
	
			$movie = new Application_Model_Movie();
			$movie->createFromArray($data);
			
	
			$movieService = new Application_Service_Movie();
			$movieService->addUser($movie);
	
			$this->_helper->redirector('index');
		}
	}
	
	public function editAction(){
		$idMovie = $this->getRequest()->getParam('id');
	
		$movieService = new Application_Service_Movie();
		$this->view->movie = $movieService->findById($idMovie);
	}
	
	public function updateAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getParams();
			
			$movie = new Application_Model_Movie();
			$movie->createFromArray($data);
			$movie->setId($data["id_user"]);
	
			$movieService = new Application_Service_Movie();
			$movieService->update($movie);

            $this->_helper->redirector('index');

        }
	}
	
	public function deleteAction(){
		$idMovie = $this->getRequest()->getParam('id');
	
		$movie = new Application_Model_User();
		$movie->setId($idMovie);
	
		$movieService = new Application_Service_Movie();
		$movieService->delete($movie);
	
		$this->_helper->redirector('index');
	}
    
}

?>