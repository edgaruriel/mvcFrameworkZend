<?php

class Application_Service_Movie
{
	private $movieMapper;

	public function __construct(){
		$this->movieMapper = new Application_Model_Mapper_Movie();
	}

	public function findAll(){
		return $this->movieMapper->findAll();
	}
	
	public function findById($id){
		return $this->movieMapper->findOneBy($id);
	}

	public function addMovie($movie){
		$this->movieMapper->insert($movie);
	}

	public function delete($movie){
		$this->movieMapper->delete($movie);
	}

	public function update($movie){
		$this->movieMapper->update($movie);
	}
	
	public function findAllMovieToday(){
	    return $this->movieMapper->findAllMovieToday();
	}
}

?>