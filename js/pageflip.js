jQuery( ".page" ).click(function() {
  jQuery( this ).toggleClass( "flip" )

  if( !jQuery( ".page-1" ).hasClass( "flip" ) ) {
    jQuery( ".notebook" ).removeClass( "open" ).addClass( "closed" );
  }
  else {
    jQuery( ".notebook" ).removeClass( "closed" ).addClass( "open" );    
  }
});
