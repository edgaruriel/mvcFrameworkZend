<?php
class Application_Service_Authentication
{
	private $auth;
	private static $instance;
	
	public static function getInstance() {
       if (self::$instance == NULL) {
          self::$instance = new Application_Service_Authentication();
       }
       return self::$instance;
    }
	
	private function __construct(){
		$this->auth = Zend_Auth::getInstance();
	}
	
	public function login($params)
	{
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter ->setTableName('user')
                     ->setIdentityColumn('username')
                     ->setCredentialColumn('password')
                     ->setIdentity($params['user'])
                     ->setCredential(sha1($params['password']));
        $result = $this->auth->authenticate($authAdapter);
            
    	if ($result->isValid()) {
    	    $userRow = $authAdapter->getResultRowObject();
    	    $userMapper = new Application_Model_Mapper_User();
    	    $user = $userMapper->findOneBy($userRow->id);
    	    if($user->getTypeUser()->getId() == Application_Model_TypeUser::$typeUserArray['EMPLOYEE']){
    	    	
    	    	$session = new Zend_Session_Namespace('mvc');
    	    	$session->user = 2;
    	    	$identity = (object) array('name' => $userRow->name,
    	    			'type_user_id' => $userRow->type_user_id,
    	    			'last_name' => $userRow->last_name);
    	    	$this->auth->getStorage()->write($identity);
    	    	return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS,$identity);
    	    }
    	    else if($user->getTypeUser()->getId() == Application_Model_TypeUser::$typeUserArray['ADMIN']){
    	    	$session = new Zend_Session_Namespace('mvc');
    	    	$session->user = 1;
    	    	$identity = (object) array('name' => $userRow->name,
    	    			'type_user_id' => $userRow->type_user_id,
    	    			'last_name' => $userRow->last_name);
    	    	$this->auth->getStorage()->write($identity);
    	    	return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS,$identity);
    	    }else{
    	        return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, null,array('Nombre de usuario y/o contrase&ntilde;a invalido'));
    	    }
        } else {
        	return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, null,array('Nombre de usuario y/o contrase&ntilde;a invalido'));
        }
	}
	public function getFullName(){
		$identity = $this->auth->getIdentity();
		return $identity->name.' '.$identity->last_name;
	}
	public function getTypeUser(){
	    $identity = $this->auth->getIdentity();
	    return $identity->type_user_id;
	}
	public function logout()
	{
		$this->auth->clearIdentity();
	}
	
	public function isAuthentication()
	{
		if ($this->auth->hasIdentity()) {
			return true;
        } else {
        	return false;
        }
	}
	
}