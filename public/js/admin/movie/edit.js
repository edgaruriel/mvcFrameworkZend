$(function(){
	$('#form').validate({
        rules: {
	        'title': 'required',
	        'format': 'required',
	        'totalUnits': {'required':true, 'number':true},
	        'year': 'required',
	        'code': 'required',
	        'price': {'required':true, 'number':true},
	        'genderId': 'required'
        },
	    messages: {
	    	'title': '<label style="text-align: center; color: red;"> Campo obligatorio</label>',
	        'format': '<label style="text-align: center; color: red;"> Campo obligatorio</label>',
	        'totalUnits': {'required':'<label style="text-align: center; color: red;"> Campo obligatorio</label>', 'number':'<label style="text-align: center; color: red;"> Solo se admiten numeros</label>'},
	        'year': '<label style="text-align: center; color: red;"> Campo obligatorio</label>',
	        'code': '<label style="text-align: center; color: red;"> Campo obligatorio</label>',
	        'price': {'required':'<label style="text-align: center; color: red;"> Campo obligatorio</label>', 'number':'<label style="text-align: center; color: red;"> Solo se admiten numeros</label>'},
	        'genderId': '<label style="text-align: center; color: red;"> Campo obligatorio</label>'
	    },
	    debug: true,
	    submitHandler: function(form){
	    	form.submit();
	    } 
	 });
	
	document.getElementById("totalUnits").onkeypress= function(){return justNumbers(event)};
    document.getElementById("price").onkeypress= function(){return justNumbers(event)};
});

function justNumbers(e)
{
	var keynum = window.event ? window.event.keyCode : e.which;
	if ((keynum == 8) || (keynum == 46))
	return true;
	 
	return /\d/.test(String.fromCharCode(keynum));
}