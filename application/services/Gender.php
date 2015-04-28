<?php

class Application_Service_Gender
{
    private $genderMapper;
    
    public function __construct(){
    	$this->genderMapper = new Application_Model_Mapper_Gender();
    }
    
    public function findAll(){
        return $this->genderMapper->findAll();
    }
    
    public function findById($id){
        return $this->genderMapper->findOneBy($id);
    }

}

?>