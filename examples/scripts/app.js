/**
 *
 */
require( [ 'udx.utility' ], function onLoaded() {

  var utility = require( 'udx.utility' );

  // Load CSS
  require.loadStyle( 'styles/app.css' );

  if( utility.isVisible( 'tablet' ) ) {
    console.log( 'tablet visible' );
  }

  if( utility.isVisible( 'mobile' ) ) {
    console.log( 'mobile visible' );
  }

  if( utility.isVisible( 'desktop' ) ) {
    console.log( 'desktop visible' );
  }

});
