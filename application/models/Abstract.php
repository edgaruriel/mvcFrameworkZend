<?php
class Application_Model_Abstract{
    
    /**
     * Set data of the object by DbTable
     * @param array $values
     */
    public function createFromDbTable(array $values)
    {
    	$methods = get_class_methods($this);
    
    	foreach ($values as $atributo => $value){
    		$method = 'set' . $this->changeNameField($atributo);
    		if (in_array($method, $methods)) {
    			$this->$method($value);
    		}
    	}
    }
    /**
     * Set data of the object by array
     * @param array $values
     */
	public function createFromArray(array $values)
    {
    	$metodos = get_class_methods($this);
    
    	foreach ($values as $atributo => $valor){
    		$metodo = 'set'.ucfirst($atributo);
    		if (in_array($metodo, $metodos)) {
    			$this->$metodo($valor);
    		}
    	}
    }
    /**
     * Change the name of the field
     * @param unknown $name
     * @return string
     */
    private function changeNameField($name)
    {
    	$result = "";
    	$nameArray = explode("_",$name);
    	if(count($nameArray)>1)
    	{
    		foreach ($nameArray as $item)
    		{
    			$result .= ucfirst(strtolower($item));
    		}
    	}else{
    		return ucfirst(strtolower($name));
    	}
    
    	return $result;
    }    
}