(function($){
  $(function(){
    $('.button-collapse').sideNav();
  	$('select').material_select(); //init select
  	$('.materialboxed').materialbox(); //imagebox
  	$("#lateral").sideNav(); //side nav
  	$("#lateral2").sideNav(); //side nav


  	$('.slider').slider({full_width: true});
  }); // end of document ready
})(jQuery); // end of jQuery name space