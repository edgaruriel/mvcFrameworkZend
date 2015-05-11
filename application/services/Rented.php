<?php
class Application_Service_Rented
{
    private $rentedMapper;
    
    public function __construct () {
        $this->rentedMapper = new Application_Model_Mapper_Rented();
    }
    
    public function findAll(){
    	return $this->rentedMapper->findAll();
    }
    
    public function findOneById($id){
    	return $this->rentedMapper->findOneBy($id);
    }
    
    public function updateStatusRented(Application_Model_Rented $rented){
    	$this->rentedMapper->updateStatusRented($rented);
    }
    
    public function addRented(Application_Model_Rented $rented){
    	$movieMapper = new Application_Model_Mapper_Movie();
    	
        $this->rentedMapper->insert($rented);
        $movieMapper->update($rented->getMovie());
    }
}