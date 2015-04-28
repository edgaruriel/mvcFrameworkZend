<?php

class Application_Service_Client
{
	private $clientMapper;

	public function __construct(){
		$this->clientMapper = new Application_Model_Mapper_Client();
	}

	public function findAll(){
		return $this->clientMapper->findAll();
	}
	
	public function findById($id){
		return $this->clientMapper->findOneBy($id);
	}

	public function addClient($client){
		$this->clientMapper->insert($client);
	}

	public function delete($client){
		$this->clientMapper->delete($client);
	}

	public function update($client){
		$this->clientMapper->update($client);
	}
}

?>