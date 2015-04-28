<?php
interface Application_Model_Mapper_Abstract
{
    /**
     * Default constructor
     */
    public function __construct();
    
    /**
     * Insert object
     * @param unknown $obj
     */
    public function insert($obj);
    
    /**
     * Update object
     * @param unknown $obj
     * @param unknown $id
     */
    public function update($obj);
    
    /**
     * Delete object
     * @param unknown $obj
     */
    public function delete($obj);
    
    /**
     * Find one by
     * @param unknown $id
     * @param string $bandera
     */
    public function findOneBy($id);
    
    //public function consultarElementos($key,array $values);
    
    /**
     * Find all elements
     */
    public function findAll();
    
    /**
     * Find elements
     * @param array $filter
     */
    public function find(array $filter);
}
