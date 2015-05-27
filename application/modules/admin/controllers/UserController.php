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
			$user->setPassword(sha1($data["password"]));
			
			$typeUserService = new Application_Service_TypeUser();
			$typeUser = $typeUserService->findById($data["typeUserId"]);
			
			$user->setTypeUser($typeUser);
			
			$userService = new Application_Service_User();
			$userService->addUser($user);
			
	
			$this->_helper->redirector('index');
		}
		
		$typeUserService = new Application_Service_TypeUser();
		$this->view->typeUsers = $typeUserService->findAll();
	}
	
	public function editAction(){
		$idUser = $this->getRequest()->getParam('id');
	
		$userService = new Application_Service_User();
		$this->view->user = $userService->findById($idUser);
		
		$typeUserService = new Application_Service_TypeUser();
		$this->view->typeUsers = $typeUserService->findAll();
	}
	
	public function updateAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getParams();
			
			$userService = new Application_Service_User();
			$userEdit = $userService->findById($data["id"]);
			
			$user = new Application_Model_User();
			$user->createFromArray($data);
			
			if($data["password"]!=null || $data["password"]!=""){
			    $user->setPassword(sha1($data["password"]));
			}else{
			    $user->setPassword($userEdit->getPassword());
			}
			
			$typeUserService = new Application_Service_TypeUser();
			$typeUser = $typeUserService->findById($data["typeUserId"]);
				
			$user->setTypeUser($typeUser);
	
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
	
	public function evaluateNewAction(){
		if($this->getRequest()->isPost()){
			$this->_helper->layout()->disableLayout();
			$this->_helper->viewRenderer->setNoRender(true);
			$data = $this->getRequest()->getParams();
			$username = $data["username"];
			$userService = new Application_Service_User();
			$result = $userService->findByUsername($username);
			if($result!=null){
				echo '1';
			}else{
				echo '0';
			}
		}
	}
	
	public function evaluateEditAction(){
		if($this->getRequest()->isPost()){
			$this->_helper->layout()->disableLayout();
			$this->_helper->viewRenderer->setNoRender(true);
			$data = $this->getRequest()->getParams();
			$id = $data["id"];
			$username = $data["username"];
			$userService = new Application_Service_User();
			$result = $userService->findByUsername($username);
			if($result!=null){
				if($result->getId()==$id){
					echo '0';
				}else{
					echo '1';
				}
			}else{
				echo '0';
			}
		}
	}
    
}

?>