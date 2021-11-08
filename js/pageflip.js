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
  if( !jQuery( ".book-page-1" ).hasClass( "flip" ) ) {
    jQuery( ".notebook" ).removeClass( "closed" ).addClass( "open" );
    jQuery( "body" ).removeClass( "book-is-closed" ).addClass( "book-is-open" );
  }

  jQuery( '.notebook .book-page:not(.flip):first' ).addClass( 'flip' );
}
function flipPrev() {
  if( jQuery( ".flip" ).length == 1 ) {
    jQuery( ".notebook" ).removeClass( "open" ).addClass( "closed" );
    jQuery( "body" ).removeClass( "book-is-open" ).addClass( "book-is-closed" );
  }

  jQuery( '.notebook .book-page.flip:last' ).removeClass( 'flip' );
}

jQuery( "button.next" ).click(function() {
  flipNext();
});
jQuery( "button.prev" ).click(function() {
  flipPrev();
});


function applyView( view ) {
  if ( view == 'book-view' )
    jQuery( "body" ).removeClass( "list-view" ).addClass( "book-view" );
  else  if ( view == 'list-view' )
    jQuery( "body" ).removeClass( "book-view" ).addClass( "list-view" );

  jQuery( '#' + view ).prop('checked', true);
}

jQuery( "#list-view" ).click(function() {
    applyView( "list-view" );
    Cookies.set('view', 'list-view', { path: '/' });
});
jQuery( "#book-view" ).click(function() {
    applyView( "book-view" );
    Cookies.set('view', 'book-view', { path: '/' });
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


jQuery( document ).ready(function() {
  // Cookies.remove('view', { path: '/' });

  let the_view = Cookies.get('view');
//  alert( the_view );
  applyView( the_view );
});
