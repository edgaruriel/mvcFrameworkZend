<?php

class Application_Service_Date {
	
	
	public static function getDate($dateTimeStamp){
		$days = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		
		$year = date('Y',$dateTimeStamp);
		$month = date('n',$dateTimeStamp)-1;
		$day = date('d',$dateTimeStamp);
		$dayOfWeek = date('w',$dateTimeStamp);
		
		return $day." de ".$months[$month]. " del ".$year;
	}
	
	public static function getDateTime($dateTimeStamp){
		$days = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	
		$year = date('Y',$dateTimeStamp);
		$month = date('n',$dateTimeStamp)-1;
		$day = date('d',$dateTimeStamp);
		
		$hour = date('h',$dateTimeStamp);
		$minut = date('i',$dateTimeStamp);
		$second = date('s',$dateTimeStamp);
		$meridiem = date('a',$dateTimeStamp);
		
		$dayOfWeek = date('w',$dateTimeStamp);
	
		return $day." de ".$months[$month]. " del ".$year." a las ".$hour.":".$minut.":".$second." ".$meridiem;
	}
	
	public static function getDateTimeNote($dateTimeStamp){
		 
		$dateTimeStamp = strtotime($dateTimeStamp);
		$days = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
		$months = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	
		$year = date('Y',$dateTimeStamp);
		$month = date('n',$dateTimeStamp)-1;
		$day = date('d',$dateTimeStamp);
	
		$hour = date('h',$dateTimeStamp);
		$minut = date('i',$dateTimeStamp);
		$second = date('s',$dateTimeStamp);
		$meridiem = date('a',$dateTimeStamp);
	
		$dayOfWeek = date('w',$dateTimeStamp);
	
		return $day."/".$months[$month]. "/".$year;
		//return $day."/".$months[$month]. "/".$year." ".$hour.":".$minut." ".$meridiem;
	}
}

?>