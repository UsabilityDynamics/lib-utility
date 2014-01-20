/**
 * UsabilityDynamics Utility
 *
 * @version 0.2.3
 * @returns {Object}
 */
define( 'udx.utility', function( require, exports, module ) {
  // console.debug( module.id, 'loaded' );

  return {

    /**
     * Deep Extend Object.
     *
     * @param destination
     * @param source
     * @returns {*}
     */
    extend: function extend( destination, source ) {
      // console.debug( 'udx.utility', 'extend' );

      for( var property in source ) {
        if( source[property] && source[property].constructor && source[property].constructor === Object ) {
          destination[property] = destination[property] || {};
          arguments.callee( destination[property], source[property] );
        } else {
          destination[property] = source[property];
        }
      }
      return destination;
    },

    /**
     * Extend Defaults into Object
     *
     * @param str
     * @return
     */
    defaults: function( target, defaults ) {
      // console.debug( 'udx.utility', 'defaults' );

      return this.extend( defaults || {}, target || {} );

    },

    /**
     * Create Slug from String.
     *
     * @param str
     * @return
     */
    create_slug: function create_slug( str ) {
      // console.debug( 'udx.utility', 'create_slug' );

      return str.replace( /[^a-zA-Z0-9_\s]/g, "" ).toLowerCase().replace( /\s/g, '_' );
    }

  }

});