<?php

class Application_Service_TypeUser
{
    private $typeUserMapper;
    
    public function __construct(){
    	$this->typeUserMapper = new Application_Model_Mapper_TypeUser();
    }
    
    public function findAll(){
        return $this->typeUserMapper->findAll();
    }
    
    public function findById($id){
        return $this->typeUserMapper->findOneBy($id);
    }

}

?>