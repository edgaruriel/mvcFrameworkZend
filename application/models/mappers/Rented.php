<?php
class Application_Model_Mapper_Rented implements Application_Model_Mapper_Abstract
{
    private $rentedDbTable;
	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::__construct()
	 */
	public function __construct() {
		// TODO Auto-generated method stub
		$this->rentedDbTable = new Application_Model_DbTable_Rented();
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::insert()
	 */
	public function insert($obj) {
		// TODO Auto-generated method stub
		$data = Array(
		        "client_id"=>$obj->getClient()->getId(),
		        "movie_id"=>$obj->getMovie()->getId(),
		        "rented_units"=>$obj->getRentedUnits(),
		        "total"=>$obj->getTotal(),
		        "date"=>$obj->getDate(),
		        "devolution_date"=>$obj->getDevolutionDate(),
		        "is_rented"=>$obj->getIsRented()
		        );
		$id = $this->rentedDbTable->insert($data);
		$obj->setId($id);
		return $obj;
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::update()
	 */
	public function update($obj) {
		// TODO Auto-generated method stub
	   
	}
	
	public function updateStatusRented($obj){
	    $data = Array(
	    		"is_rented"=>$obj->getIsRented()
	    );
	    
	    $this->rentedDbTable->update($data, " id=".$obj->getId());
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::delete()
	 */
	public function delete($obj) {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::findOneBy()
	 */
	public function findOneBy($id) {
		// TODO Auto-generated method stub
	    $clientMapper = new Application_Model_Mapper_Client();
	    $movieMapper = new Application_Model_Mapper_Movie();
		$row = $this->rentedDbTable->fetchRow($this->rentedDbTable->select()->where("id =?",$id))->toArray();
		
		$rented = new Application_Model_Rented();
		$client = $clientMapper->findOneBy($row["client_id"]);
		$movie = $movieMapper->findOneBy($row["movie_id"]);
		$rented->createFromDbTable($row);
		$rented->setClient($client);
		$rented->setMovie($movie);
		
		return $rented;
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::findAll()
	 */
	public function findAll() {
		// TODO Auto-generated method stub
		$rentedArray = Array();
		$rowsAux = $this->rentedDbTable->fetchAll();
		if($rowsAux != null){
			$rows = $rowsAux->toArray();
			$clientMapper = new Application_Model_Mapper_Client();
			$movieMapper = new Application_Model_Mapper_Movie();
			
			foreach ($rows as $row){
				$rented = new Application_Model_Rented();
				$client = $clientMapper->findOneBy($row["client_id"]);
				$movie = $movieMapper->findOneBy($row["movie_id"]);
				$rented->createFromDbTable($row);
				$rented->setClient($client);
				$rented->setMovie($movie);
				
				array_push($rentedArray, $rented);
			} 
		}
		return $rentedArray;
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::find()
	 */
	public function find(array $filter) {
		// TODO Auto-generated method stub
		
	}

    
}