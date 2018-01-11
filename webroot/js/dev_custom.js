/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//password validation during registration
$.validator.addMethod("passwordStrength", function(value, element) {
        return this.optional(element) || /(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}/.test(value);
}, 'Password must contain atleast 1 alphabet, 1 number and 1 special character(eg.$@!%*#?&).');
//password validation during registration
$.validator.addMethod("password_strength", function(value, element) {
       return this.optional(element) || /(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}/.test(value);
},"Password must contain atleast 1 Alphabet, 1 Number and 1 Special Character(eg.$@!%*#?&).");
//Add custom method
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[A-Za-z']*$/.test(value);
}, "Only letters and make sure there are no spaces"); 
//facebook id
$.validator.addMethod( "facebook_id", function( value, element ) {
	return this.optional( element ) || /^[A-Za-z0-9@.]*$/.test( value );
},"Please enter valid facebook id");
//alphanumeric custom method
$.validator.addMethod( "alphanumeric", function( value, element ) {
	return this.optional( element ) || /^\w+$/i.test( value );
}, "Letters, numbers, and underscores only please" );
//restaurant name
$.validator.addMethod( "special_alphanumeric", function( value, element ) {
	return this.optional( element ) || /^[ A-Za-z0-9_@#&$-]*$/.test( value );
},"Please enter valid name. (You can use _ @ # & $ - and space)");
//Restaurant url
$.validator.addMethod( "hyphen_alphanumeric", function( value, element ) {
	return this.optional( element ) || /^[A-Za-z0-9-]*$/.test( value );
},"Please enter valid name(You can use only hyphen)");
//item  name
$.validator.addMethod( "apostrophe_hyphen_alphanumeric", function( value, element ) {
    return this.optional( element ) || /^[A-Za-z0-9-',./ ]*$/.test( value );
},"Please enter valid name. (Only hyphen, comma, backslash,full stop and apostrophe allowed)");
//ans space name
$.validator.addMethod( "and_hyphen_alphanumeric", function( value, element ) {
	return this.optional( element ) || /^[ A-Za-z0-9-_@#&$']*$/.test( value );
},"Please enter valid name,You can use only(&-_@#&$)");
//for float numeric validation
jQuery.validator.addMethod("customnumeric", function(value, element) { 
        return $.isNumeric(value); 
    }, "Value should be numeric"); 
jQuery(document).ready(function(){
    
    //
    setTimeout(function () {
        $('.alert').hide();
        $('#alertMessage').html('');
    }, 8000);
    
    $('[data-toggle="tooltip"]').tooltip();
    
});