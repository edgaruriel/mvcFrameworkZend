<?php
class Application_Model_Rented extends Application_Model_Abstract
{
    public static $statusArray = Array("RENTED"=>1, "NOT_RENTED"=>0);
    
    public $id = null;
    public $client = null;
    public $movie = null;
    public $total = null;
    public $date = null;
    public $rentedUnits = null;
    public $devolutionDate = null;
    public $isRented = null;
    
	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $client
	 */
	public function getClient() {
		return $this->client;
	}

	/**
	 * @return the $movie
	 */
	public function getMovie() {
		return $this->movie;
	}

	/**
	 * @return the $total
	 */
	public function getTotal() {
		return $this->total;
	}

	/**
	 * @return the $date
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @return the $rentedUnits
	 */
	public function getRentedUnits() {
		return $this->rentedUnits;
	}

	/**
	 * @return the $devolutionDate
	 */
	public function getDevolutionDate() {
		return $this->devolutionDate;
	}

	/**
	 * @return the $isRented
	 */
	public function getIsRented() {
		return $this->isRented;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $client
	 */
	public function setClient($client) {
		$this->client = $client;
	}

	/**
	 * @param field_type $movie
	 */
	public function setMovie($movie) {
		$this->movie = $movie;
	}

	/**
	 * @param field_type $total
	 */
	public function setTotal($total) {
		$this->total = $total;
	}

	/**
	 * @param field_type $date
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * @param field_type $rentedUnits
	 */
	public function setRentedUnits($rentedUnits) {
		$this->rentedUnits = $rentedUnits;
	}

	/**
	 * @param field_type $devolutionDate
	 */
	public function setDevolutionDate($devolutionDate) {
		$this->devolutionDate = $devolutionDate;
	}

	/**
	 * @param field_type $isRented
	 */
	public function setIsRented($isRented) {
		$this->isRented = $isRented;
	}


    
}