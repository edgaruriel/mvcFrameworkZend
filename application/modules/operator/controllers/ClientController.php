<?php

require_once 'Zend/Controller/Action.php';

class Operator_ClientController extends Zend_Controller_Action
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
    	$this->view->controller = $this->getRequest()->getControllerName();
    	$this->view->action = $this->getRequest()->getActionName();
    }
	/**
	 * The default action - show the home page
	 */
	public function indexAction(){
	 	$clientService = new Application_Service_Client();
		$this->view->clients = $clientService->findAll();
	}
	
	public function newAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getParams();
	
			$client = new Application_Model_Client();
			$client->createFromArray($data);
	
			$clientService = new Application_Service_Client();
			$clientService->addClient($client);
	
			$this->_helper->redirector('index');
		}
	}
	
	public function editAction(){
		$idClient = $this->getRequest()->getParam('id');
	
		$clientService = new Application_Service_Client();
		$this->view->client = $clientService->findById($idClient);
	}
	
	public function updateAction(){
		if($this->getRequest()->isPost()){
			$data = $this->getRequest()->getParams();
			
			$client = new Application_Model_Client();
			$client->createFromArray($data);
	
			$clientService = new Application_Service_Client();
			$clientService->update($client);

            $this->_helper->redirector('index');

        }
	}
	
	public function deleteAction(){
		$idClient = $this->getRequest()->getParam('id');
	
		$client = new Application_Model_Client();
		$client->setId($idClient);
	
		$clientService = new Application_Service_Client();
		$clientService->delete($client);
	
		$this->_helper->redirector('index');
	}
}