<?php
class Application_Model_Mapper_Client implements Application_Model_Mapper_Abstract
{
	
	private $clientDbTable;
	
	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::__construct()
	 */
	public function __construct() {
		// TODO Auto-generated method stub
		$this->clientDbTable = new Application_Model_DbTable_Client();
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::insert()
	 */
	public function insert($obj) {
		// TODO Auto-generated method stub
		$data = array(
				"name"=>$obj->getName(),
		        "last_name"=>$obj->getLastName(),
				"email"=>$obj->getEmail(),
				"ife"=>$obj->getIfe(),
				"status"=>true
		);
		$this->clientDbTable->insert($data);
		
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::update()
	 */
	public function update($obj) {
		// TODO Auto-generated method stub
		$data = array(
				"name"=>$obj->getName(),
		        "last_name"=>$obj->getLastName(),
				"email"=>$obj->getEmail(),
				"ife"=>$obj->getIfe()
		);
		$this->clientDbTable->update($data, "id = ".$obj->getId());		
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::delete()
	 */
	public function delete($obj) {
		// TODO Auto-generated method stub
		$data = array(
				"status"=>false
		);
		$this->clientDbTable->update($data, "id = ".$obj->getId());
		
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::findOneBy()
	 */
	public function findOneBy($id) {
		// TODO Auto-generated method stub
		$row = $this->clientDbTable->fetchRow($this->clientDbTable->select()->where("id=?",$id))->toArray();
		
		$client = new Application_Model_Client();
		$client->createFromDbTable($row);
		return $client;
	}
	
	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::findAll()
	 */
	public function findAll() {
		// TODO Auto-generated method stub
		$clientArray = array();
		$result = $this->clientDbTable->fetchAll($this->clientDbTable->select()->where("status=?",true))->toArray();
		 
		foreach($result as $row){
			$client = new Application_Model_Client();			
			$client->createFromDbTable($row);
			array_push($clientArray, $client);
		}
		return $clientArray;
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::find()
	 */
	public function find(array $filter) {
		// TODO Auto-generated method stub
		
	}

	
	
	
}
?>