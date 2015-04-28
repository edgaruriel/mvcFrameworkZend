<?php

class Application_Model_TypeUser extends Application_Model_Abstract
{
    public $id;
    public $name;
    public static $typeUserArray = array("ADMIN"=>1,"EMPLOYEE"=>2);


	/**
	 * @return the $typeUserArray
	 */
	public static function getTypeUserArray() {
		return Application_Model_TypeUser::$typeUserArray;
	}

	/**
	 * @param multitype:number  $typeUserArray
	 */
	public static function setTypeUserArray($typeUserArray) {
		Application_Model_TypeUser::$typeUserArray = $typeUserArray;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

    
    
}

?>