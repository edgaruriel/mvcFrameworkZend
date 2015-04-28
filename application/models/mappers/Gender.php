<?php

class Application_Model_Mapper_Gender implements Application_Model_Mapper_Abstract
{
    private $genderDbTable;
    //private $typeUser;
    
	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::__construct()
	 */
	public function __construct() {
		// TODO Auto-generated method stub
		$this->genderDbTable = new Application_Model_DbTable_Gender();
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::insert()
	 */
	public function insert($obj) {
		// TODO Auto-generated method stub

	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::update()
	 */
	public function update($obj) {
		// TODO Auto-generated method stub

	}
	
	/*public function getTypeUser() {
		if (!$this->typeUser) {
			$this->typeUser = $this->findParentRow('Application_Model_DbTable_User');
		}
		return $this->typeUser;
	}*/

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::delete()
	 */
	public function delete($obj) {
		// TODO Auto-generated method stub
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::findOneBy()
	 */
	public function findOneBy($id) {
		// TODO Auto-generated method stub
	    $row = $this->genderDbTable->fetchRow($this->genderDbTable->select()->where("id=?",$id))->toArray();  
	    $gender = new Application_Model_Gender();
	    $gender->createFromDbTable($row);
	    return $gender;
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::findAll()
	 */
	public function findAll() {
		// TODO Auto-generated method stub
	    $genderArray = array();
	    $result = $this->genderDbTable->fetchAll()->toArray();
	    foreach($result as $row){
	    	$gender = new Application_Model_Gender();
	    	$gender->createFromDbTable($row);
	    	array_push($genderArray, $gender);
	    }
	    return $genderArray;
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::find()
	 */
	public function find(array $filter) {
	
	}
}
?>