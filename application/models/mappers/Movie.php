<?php
class Application_Model_Mapper_Movie implements Application_Model_Mapper_Abstract
{
	
	private $movieDbTable;
	
	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::__construct()
	 */
	public function __construct() {
		// TODO Auto-generated method stub
		$this->movieDbTable = new Application_Model_DbTable_Movie();
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::insert()
	 */
	public function insert($obj) {
		// TODO Auto-generated method stub
		$data = array(
				"title"=>$obj->getTitle(),
		        "format"=>$obj->getFormat(),
				"total_units"=>$obj->getTotalUnits(),
				"year"=>$obj->getYear(),
				"price"=>$obj->getPrice(),
		        "code"=>$obj->getCode(),
		        "gender_id"=>$obj->getGender()->getId(),
		        "status"=>true,
		        "rented_units"=>$obj->getRentedUnits()
		);
		$this->movieDbTable->insert($data);
		
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::update()
	 */
	public function update($obj) {
		// TODO Auto-generated method stub
		$data = array(
				"title"=>$obj->getTitle(),
		        "format"=>$obj->getFormat(),
				"total_units"=>$obj->getTotalUnits(),
				"year"=>$obj->getYear(),
				"price"=>$obj->getPrice(),
		        "code"=>$obj->getCode(),
		        "gender_id"=>$obj->getGender()->getId(),
		        "rented_units"=>$obj->getRentedUnits()
		);
		$this->movieDbTable->update($data, "id = ".$obj->getId());		
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::delete()
	 */
	public function delete($obj) {
		// TODO Auto-generated method stub
		$data = array(
				"status"=>false
		);
		$this->movieDbTable->update($data, "id = ".$obj->getId());
		
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::findOneBy()
	 */
	public function findOneBy($id) {
		// TODO Auto-generated method stub
		$row = $this->movieDbTable->fetchRow($this->movieDbTable->select()->where("id=?",$id))->toArray();
		
		$genderMapper = new Application_Model_Mapper_Gender();
		$gender = $genderMapper->findOneBy($row["gender_id"]);
		
		$movie = new Application_Model_Movie();
		$movie->createFromDbTable($row);
		$movie->setGender($gender);
		return $movie;
	}
	
	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::findAll()
	 */
	public function findAll() {
		// TODO Auto-generated method stub
		$movieArray = array();
		$result = $this->movieDbTable->fetchAll($this->movieDbTable->select()->where("status=?",true))->toArray();
		$genderMapper = new Application_Model_Mapper_Gender();
		 
		foreach($result as $row){
    		$gender = $genderMapper->findOneBy($row["gender_id"]);
    		$movie = new Application_Model_Movie();
    		$movie->createFromDbTable($row);
    		$movie->setGender($gender);
    		array_push($movieArray,$movie);
		}
		return $movieArray;
	}

	/* (non-PHPdoc)
	 * @see Application_Model_Mapper_Abstract::find()
	 */
	public function find(array $filter) {
		// TODO Auto-generated method stub
		
	}

	
	
	
}
?>