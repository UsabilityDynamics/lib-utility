/**
 * UsabilityDynamics Utility
 *
 * @version 0.2.3
 * @returns {Object}
 */
define( 'udx.utility', function Utility( require, exports, module ) {
  // console.debug( module.id, 'loaded' );

  return {

    /**
     * HTTP GET Request
     *
     * The callback method follows Node.js format of returning an Error object as the first argument, or null.
     *
     * @method remote_get
     * @for Utility
     *
     * @param url {String|Object}
     * @param callback {Function}
     */
    remote_get: function remote_get() {
      var request = makeHttpObject();

      var url = arguments[0];
      var callback = arguments[1];

      request.open( 'GET' , url, true);

      request.send( null );

      request.onreadystatechange = function() {

        if (request.readyState == 4) {
          if (request.status == 200) {
            callback( null, request.responseText );
          } else if (failure) {
            callback( new Error( request.statusText) );
          }
        }

      };

    },

    /**
     * HTTP POST Request
     *
     */
    remote_post: function remote_post() {
      var request = makeHttpObject();

      var url = arguments[0];
      var callback = arguments[1];

      request.open( 'POST' , url, true);

      request.send( null );

      request.onreadystatechange = function() {

        if (request.readyState == 4) {
          if (request.status == 200) {
            callback( null, request.responseText );
          } else if (failure) {
            callback( new Error( request.statusText) );
          }
        }

      };

    },

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