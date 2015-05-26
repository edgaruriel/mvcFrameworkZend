$(function(){  		
 		 $('#formLogin').validate({
 		        rules: {
 		        'password': 'required',	        
 		        'user': 'required'
 		        },
 		    messages: {
 		        'password': 'Campo obligatorio',
 		        'user': 'Campo obligatorio'
 		    },
 		   
 		    submitHandler: function(form){
 		    	form.submit(); 		    
 		    } 
 		 });
  		
  	});