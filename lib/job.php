<?php
/**
 * Job
 *
 * This is a mixture of traditional UD Utility "log" methods with job handling.
 * Jobs may utilize RaaS support.
 *
 * @author team@UD
 * @version 0.2.4
 * @namespace UsabilityDynamics
 * @module Utility
 * @author potanin@UD
 */
namespace UsabilityDynamics {

  if( !class_exists( 'UsabilityDynamics\Job' ) ) {

    /**
     *
     * @class Job
     * @author potanin@UD
     */
    class Job {

      /**
       * Job Instance Defaults.
       *
       * @property $defaults
       * @public
       * @type {Array}
       */
      public static $defaults = array(
        "type" => '_default'
      );

      /**
       * Job Instance Settings.
       *
       * @property $_settings
       * @private
       * @type {Object}
       */
      private $_settings = stdClass;

      /**
       * Constructor for the Job class.
       *
       * @method __construct
       * @for Job
       * @constructor
       * @param array|\UsabilityDynamics\object $settings array
       * @return \UsabilityDynamics\Job
       * @version 0.0.1
       * @since 0.0.1
       */
      function __construct( $settings = array() ) {


        // Save Settings to Instance.
        $this->_settings = Utility::extend( $settings );


      }

    }

  }

}

