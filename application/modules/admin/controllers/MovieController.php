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
    	$this->view->controller = 'movie';
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
			
	        $genderService = new Application_Service_Gender();
	        $gender = $genderService->findById($data["genderId"]);
	        
	        $movie->setGender($gender);
	        			
			$movieService = new Application_Service_Movie();
			$movieService->addMovie($movie);
	
			$this->_helper->redirector('index');
		}
		
		$genderService = new Application_Service_Gender();
		$this->view->genders = $genderService->findAll();
	}
	
	public function editAction(){
		$idMovie = $this->getRequest()->getParam('id');
	
		$movieService = new Application_Service_Movie();
		$this->view->movie = $movieService->findById($idMovie);
		
		$genderService = new Application_Service_Gender();
		$this->view->genders = $genderService->findAll();
	}
	
	public function updateAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getParams();
			
			$movie = new Application_Model_Movie();
			$movie->createFromArray($data);
			
			$genderService = new Application_Service_Gender();
			$gender = $genderService->findById($data["genderId"]);
			 
			$movie->setGender($gender);
	
			$movieService = new Application_Service_Movie();
			$movieService->update($movie);

            $this->_helper->redirector('index');

        }
	}
	
	public function deleteAction(){
		$idMovie = $this->getRequest()->getParam('id');
	
		$movie = new Application_Model_Movie();
		$movie->setId($idMovie);
	
		$movieService = new Application_Service_Movie();
		$movieService->delete($movie);
	
		$this->_helper->redirector('index');
	}
    
}

?>