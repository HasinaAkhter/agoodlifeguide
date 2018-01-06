$(document).ready(function(){
  $( '.dropdown' ).click(function() {
    $( this ).find('ul').stop().slideToggle('slow');
    
  });
});
