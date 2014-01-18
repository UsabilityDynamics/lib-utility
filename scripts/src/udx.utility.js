/**
 * UsabilityDynamics Utility
 *
 * @version 0.2.3
 * @returns {Object}
 */
define( 'udx.utility', function( require, exports, module ) {
  console.log( module.id, 'loaded' );

  return {

    /**
     * Create Slug from String.
     *
     * @param str
     * @return
     */
    create_slug: function create_slug( str ) {
      return str.replace( /[^a-zA-Z0-9_\s]/g, "" ).toLowerCase().replace( /\s/g, '_' );
    }

  }


});