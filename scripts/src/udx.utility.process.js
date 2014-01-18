/**
 * UsabilityDynamics Utility - Process
 *
 * Handles pocess running.
 *
 * @example
 *
 *    require( 'udx.utility.process' ).create({
 *      id: 'some-task',
 *      url: 'admin-ajax.php?action=some-task',
 *      interval: 100,
 *      onError: function() {},
 *      onComplete: function() {}
 *    });
 *
 * @version 0.1.0
 */
define( 'udx.utility.process', [ 'async' ], function() {
  console.log( 'udx.utility.process loaded' );

  // Modules.
  var Auto    = require( 'async' ).auto;
  var Series  = require( 'async' ).series;

  // Module Properties.
  var _processes = {};

  /**
   * Process Instance
   *
   */
  function Process() {
    console.log( 'new Process' );

    return this;

  }

  /**
   * Instance Properties.
   *
   */
  Object.defineProperties( Process.prototype, {
    auto: {
      /**
       * Auto Task Runner.
       *
       */
      value: require( 'async' ).auto,
      enumerable: true,
      configurable: true,
      writable: true
    },
    testMethod: {
      /**
       * Test Prototypal Method.
       *
       */
      value: function testMethod() {
        console.log( 'testMethod' );
      },
      enumerable: true,
      configurable: true,
      writable: true
    }
  });

  /**
   * Constructor Properties.
   *
   */
  Object.defineProperties( Process, {
    create: {
      /**
       * Create Process.
       *
       * @returns {Process}
       */
      value: function create() {
        return new Process( arguments[0] );
      },
      enumerable: true,
      configurable: true,
      writable: true
    }
  });

  // Expose Process.
  return Process;

});
