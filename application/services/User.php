<?php

class Application_Service_User
{
    private $userMapper;
    
    public function __construct(){
    	$this->userMapper = new Application_Model_Mapper_User();
    }
    
    public function findAll(){
        return $this->userMapper->findAll();
    }
    
    public function findById($id){
        return $this->userMapper->findOneBy($id);
    }
    
    public function addUser($user){
        return $this->userMapper->insert($user);
    }
    
    public function delete($user){
        $this->userMapper->delete($user);
    }
    
    public function update($user){
        return $this->userMapper->update($user);
    }
}

?>