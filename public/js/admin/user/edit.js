$(function(){
	
	$.validator.addMethod('email',
	        function(value, element){
	            return this.optional(element) || /(^[-!#$%&'*+/=?^_`{}|~0-9A-Z]+(\.[-!#$%&'*+/=?^_`{}|~0-9A-Z]+)*|^"([\001-\010\013\014\016-\037!#-\[\]-\177]|\\[\001-\011\013\014\016-\177])*")@((?:[A-Z0-9](?:[A-Z0-9-]{0,61}[A-Z0-9])?\.)+(?:[A-Z]{2,6}\.?|[A-Z0-9-]{2,}\.?)$)|\[(25[0-5]|2[0-4]\d|[0-1]?\d?\d)(\.(25[0-5]|2[0-4]\d|[0-1]?\d?\d)){3}\]$/i.test(value);
	        },'Verify you have a valid email address.'
	    );
	
	$('#form').validate({
	    rules: {
	        'username': 'required',
	        'name': 'required',
	        'password': 'required',
	        'lastName': 'required',
	        'email': {'required':true, 'email':true},
	        'typeUserId': 'required'
	    },
	    messages: {
	    	'username': '<label style="text-align: center; color: red;"> Campo obligatorio</label>',
	        'name': '<label style="text-align: center; color: red;"> Campo obligatorio</label>',
	        'password': '<label style="text-align: center; color: red;"> Campo obligatorio</label>',
	        'lastName': '<label style="text-align: center; color: red;"> Campo obligatorio</label>',
	        'email': {'required':'<label style="text-align: center; color: red;"> Campo obligatorio</label>', 'email':'<label style="text-align: center; color: red;"> Ingrese un email v&aacute;lido</label>'},
	        'typeUserId': '<label style="text-align: center; color: red;"> Campo obligatorio</label>'
	    },
	    debug: true,
	    submitHandler: function(form){
	    	validateUsername();
	    } 
	 });
});

function validateUsername(){
	var username = $('#username').val();
	var url = $('#urlEdit').val();
	var id = $('#id').val();
	$.ajax({
		type:"POST",
		data: {username:username, id:id},
		url: url,
		success: function(result){
			if(result==1){
				$('#errorName').show();
			}else{
				$('#errorName').hide();
				$('input[type=submit]').prop('disabled',true);
				form.submit();
			}
	}});
}