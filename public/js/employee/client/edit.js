$(function(){
	$('#form').validate({
        rules: {
	        'name': 'required',
	        'lastName': 'required',
	        'email': {'required':true, 'email':true},
	        'ife': 'required'
        },
	    messages: {
	    	'name': '<label style="text-align: center; color: red;"> Campo obligatorio</label>',
	        'lastName': '<label style="text-align: center; color: red;"> Campo obligatorio</label>',
	        'email': {'required':'<label style="text-align: center; color: red;"> Campo obligatorio</label>', 'email':'<label style="text-align: center; color: red;"> Ingrese un email v&aacute;lido</label>'},
	        'ife': '<label style="text-align: center; color: red;"> Campo obligatorio</label>'
	    },
	    debug: true,
	    submitHandler: function(form){
	    	form.submit();
	    } 
	 });
	
});
