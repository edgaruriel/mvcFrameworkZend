<?php

class Application_Model_Mapper_User implements Application_Model_Mapper_Abstract
{
    private $userDbTable;
    
	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::__construct()
	 */
	public function __construct() {
		// TODO Auto-generated method stub
		$this->userDbTable = new Application_Model_DbTable_User();
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::insert()
	 */
	public function insert($obj) {
		// TODO Auto-generated method stub
		$data = array(
		        "username"=>$obj->getUsername(),
		        "password"=>$obj->getPassword(),
		        "type_user_id"=>$obj->getTypeUser()->getId(),
		        "email"=>$obj->getEmail(),
		        "name"=>$obj->getName(),
		        "last_name"=>$obj->getLastName(),
		        "status"=>true
		);
		  $id = $this->userDbTable->insert($data);
		  $obj->setId($id);
		  return $obj;
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::update()
	 */
	public function update($obj) {
		// TODO Auto-generated method stub
	    $data = array(
		        "username"=>$obj->getUsername(),
		        "password"=>$obj->getPassword(),
		        "type_user_id"=>$obj->getTypeUser()->getId(),
		        "email"=>$obj->getEmail(),
		        "name"=>$obj->getName(),
		        "last_name"=>$obj->getLastName()
		);
	    $id=$this->userDbTable->update($data, "id = ".$obj->getId());
	    $obj->setId($id);
	    return $obj;
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::delete()
	 */
	public function delete($obj) {
		// TODO Auto-generated method stub
		
	   $data = array(
		        "status"=>false
		);
	    $id=$this->userDbTable->update($data, "id = ".$obj->getId());
	    $obj->setId($id);
	    return $obj;
	    
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::findOneBy()
	 */
	public function findOneBy($id) {
		// TODO Auto-generated method stub
	    $row = $this->userDbTable->fetchRow($this->userDbTable->select()->where("id=?",$id))->toArray();
	    
	    $mapperTypeUser = new Application_Model_Mapper_TypeUser();
	    $typeUser =$mapperTypeUser->findOneBy($row["type_user_id"]);
	    $user = new Application_Model_User();
	    $user->createFromDbTable($row);
	    $user->setTypeUser($typeUser);
	    return $user;
	}
	
	public function findOneByUsername($username) {
		// TODO Auto-generated method stub
		$row = $this->userDbTable->fetchRow($this->userDbTable->select()->where("username=?",$username))->toArray();
		 
		$mapperTypeUser = new Application_Model_Mapper_TypeUser();
		$typeUser =$mapperTypeUser->findOneBy($row["type_user_id"]);
		$user = new Application_Model_User();
		$user->createFromDbTable($row);
		$user->setTypeUser($typeUser);
		return $user;
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::findAll()
	 */
	public function findAll() {
		// TODO Auto-generated method stub
	    $userArray = array();
	    $result = $this->userDbTable->fetchAll($this->userDbTable->select()->where("status=?",true))->toArray();
	    foreach($result as $row){           
	        $mapperTypeUser = new Application_Model_Mapper_TypeUser();
	        $typeUser =$mapperTypeUser->findOneBy($row["type_user_id"]);
	    	$user = new Application_Model_User();
	    	$user->createFromDbTable($row);
	    	$user->setTypeUser($typeUser);
	    	array_push($userArray, $user);
	    }
	    return $userArray;
	}

	/* (non-PHPdoc)
	 * @see Application_Mapper_abstract::find()
	 */
	public function find(array $filter) {
		// TODO Auto-generated method stub
		
	}
}

?>