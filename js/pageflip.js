/*

Removed this for now, since clicking a page to flip means you
can't select text on the page. Also clicking too fast means the
page content gets selected, which I think is annoying.

jQuery( ".book-page" ).click(function() {
  jQuery( this ).toggleClass( "flip" )

  if( !jQuery( ".book-page-1" ).hasClass( "flip" ) ) {
    jQuery( ".notebook" ).removeClass( "open" ).addClass( "closed" );
  }
  else {
    jQuery( ".notebook" ).removeClass( "closed" ).addClass( "open" );
  }
});
*/

function flipNext() {
  jQuery( '.notebook .book-page:not(.flip):first' ).addClass( 'flip' );
}
function flipPrev() {
  jQuery( '.notebook .book-page.flip:last' ).removeClass( 'flip' );
}

jQuery( "button.next" ).click(function() {
  flipNext();
});
jQuery( "button.prev" ).click(function() {
  flipPrev();
});

jQuery(document).keydown(
  function(e)
  {
    if (e.keyCode == 39) {
      flipNext();
    }
    if (e.keyCode == 37) {
      flipPrev();
    }
  }
);
