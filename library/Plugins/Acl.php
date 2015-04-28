<?php
class Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
    private $acl;
    
    public function __construct(){
    	$this->acl = new Custom_Acl();
    }
    
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
	    $auth = Zend_Auth::getInstance();
		$usersNs = new Zend_Session_NameSpace("users");	

		$typeUser = new Application_Model_TypeUser();
		$arrayTypeUsers = $typeUser->getTypeUserArray();
		
		
		if(Application_Service_Authentication::getInstance()->isAuthentication()){
		    
		    $typeUser = Application_Service_Authentication::getInstance()->getTypeUser();
		    		    
		    if ($typeUser==$arrayTypeUsers["EMPLOYEE"]) {
		    	$roleName="empleado";
		    }else{
		        if ($typeUser==$arrayTypeUsers["ADMIN"]) {
		        	$roleName="admin";
		        }
		    }
		}else{
		    $roleName="invitado";
		} 
		
		$resource = $this->getResource($request);
		
		if(!$this->acl->isAllowed($roleName,$resource,$request->getActionName())){
		    if($roleName!='invitado'){
		        $request->setModuleName('default');
		        $request->setControllerName('index');
		        $request->setActionName('denied');
		    }
		}
    }
    
    protected function getResource($request) {
        $module = $request->getModuleName();
        $controller = $request->getControllerName();
    	$resource = $module.':'.$controller;
    	
    	if (!$this->acl->has($resource))
    	{
    		$resource = $module.':all';
    
    		if (!$this->acl->has($resource))
    		{
    			$resource = null;
    		}
    	}
    
    	return $resource;
    }
}
?>