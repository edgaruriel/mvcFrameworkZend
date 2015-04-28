<?php
class Admin_UserController extends Zend_Controller_Action
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
        $userService = new Application_Service_User();
        $this->view->users = $userService->findAll();
    }
	
	public function newAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getParams();
	
			$user = new Application_Model_User();
			$user->createFromArray($data);
			
	
			$userService = new Application_Service_User();
			$userService->addUser($user);
	
			$this->_helper->redirector('index');
		}
	}
	
	public function editAction(){
		$idUser = $this->getRequest()->getParam('id');
	
		$userService = new Application_Service_User();
		$this->view->user = $userService->findById($idUser);
	}
	
	public function updateAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getParams();
			
			$user = new Application_Model_User();
			$user->createFromArray($data);
			$user->setId($data["id_user"]);
	
			$userService = new Application_Service_User();
			$userService->update($user);

            $this->_helper->redirector('index');

        }
	}
	
	public function deleteAction(){
		$idUser = $this->getRequest()->getParam('id');
	
		$user = new Application_Model_User();
		$user->setId($idUser);
	
		$clientService = new Application_Service_User();
		$clientService->delete($user);
	
		$this->_helper->redirector('index');
	}
    
}

?>