$(document).ready(function(){
  $( '.dropdown' ).click(function() {
    $( this ).find('ul').stop().slideToggle('slow');
    
  });
});
//update copyright info
const copy = document.querySelector('.copyright');
copy.innerHTML = '&copy; www.agoodlifeguide.hasinaakhter.com 2017-2018 All rights reserved.';