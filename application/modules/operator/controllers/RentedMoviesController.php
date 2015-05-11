<?php
class Operator_RentedMoviesController extends Zend_Controller_Action
{
    public function preDispatch()
    {
    	if (!Application_Service_Authentication::getInstance()->isAuthentication()) {
    		$this->_redirect('login');
    	}else{
    		if(Application_Service_Authentication::getInstance()->getTypeUser()==1){
    		    $this->_redirect('login');
    		}
    	}
    }
    
    public function init()
    {
    	/* Initialize action controller here */
    	$this->view->controller = 'index';
    	$this->view->action = $this->getRequest()->getActionName();
    }
    /**
     * The default action - show the home page
     */
    public function indexAction(){
        $rentedService = new Application_Service_Rented();
        $rentedMovies = $rentedService->findAll();
        $this->view->rentedMovies = $rentedMovies;
    }
    
    public function newAction(){
        $clientService = new Application_Service_Client();
        $movieService = new Application_Service_Movie();
        $rentedService = new Application_Service_Rented();
        
        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getParams();
            
            $client = $clientService->findById($data["clientId"]);
            
            $movies = json_decode($data["movies"],true);
            $today = date('Y-m-d');
            foreach ($movies as $movieAux){
                $movie = $movieService->findById($movieAux["id"]);
                
                $rented = new Application_Model_Rented();
                $rented->createFromArray($data);
                $rented->setClient($client);
                $rented->setIsRented(true);
                $rented->setTotal($movieAux["numberMovie"]);
                $rented->setRentedUnits($movieAux["numberMovie"]);
                $rented->setDate($today);
                
                $rentedUnits = $movie->getRentedUnits();
                $movie->setRentedUnits($rentedUnits + $movieAux["numberMovie"]);
                
                $rented->setMovie($movie);
                $rentedService->addRented($rented);
            }
            
            $this->_helper->redirector('index');
        }else{
            $this->view->clients = $clientService->findAll();
            $this->view->movies = $movieService->findAll();
        }
    }
    
    function returnMovieAction(){
        
        $rentedService = new Application_Service_Rented();
        $movieService = new Application_Service_Movie();
        $rentedMovie = $rentedService->findOneById($this->getRequest()->getParam("id"));
        $rentedMovie->setIsRented(false);
        
        $movie = $rentedMovie->getMovie();
        if(($movie->getRentedUnits() - $rentedMovie->getRentedUnits()) < 0){
        	$movie->setRentedUnits(0);
        }else{
        	$movie->setRentedUnits($movie->getRentedUnits() - $rentedMovie->getRentedUnits());
        }
        $rentedService->updateStatusRented($rentedMovie);
        $movieService->update($movie);
        
        $this->_helper->redirector('index');
    }
    
}

?>