<?php

class Application_Model_Mapper_TypeUser implements Application_Model_Mapper_Abstract
{
    private $typeUserDbTable;
    //private $typeUser;
    
	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::__construct()
	 */
	public function __construct() {
		// TODO Auto-generated method stub
		$this->typeUserDbTable = new Application_Model_DbTable_TypeUser();
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
	    $row = $this->typeUserDbTable->fetchRow($this->typeUserDbTable->select()->where("id=?",$id))->toArray();  
	    $typeUser = new Application_Model_TypeUser();
	    $typeUser->createFromDbTable($row);
	    return $typeUser;
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::findAll()
	 */
	public function findAll() {
		// TODO Auto-generated method stub
	    $userArray = array();
	    $result = $this->typeUserDbTable->fetchAll()->toArray();
	    foreach($result as $row){
	    	$typeUser = new Application_Model_TypeUser();
	    	$typeUser->createFromDbTable($row);
	    	array_push($userArray, $typeUser);
	    }
	    return $userArray;
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::find()
	 */
	public function find(array $filter) {
	
	}
}
?>