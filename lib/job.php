<?php
/**
 * Job Instances.
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
     * Job Class
     *
     * Extends UsabilityDynamics\Utility to inherit version, text_domain, etc.
     *
     * @class Job
     * @author potanin@UD
     */
    class Job extends Utility {

      /**
       * Job Instance Defaults.
       *
       * @property $defaults
       * @public
       * @type {Array}
       */
      public static $defaults = array(
        "type" => '_default',
        "post_type" => "_ud_job"
      );

      /**
       * Job Instance ID.
       *
       * @property $_id
       * @private
       * @type {Integer}
       */
      private $_id = null;

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
      public function __construct( $settings = array() ) {

        // Save Settings to Instance, applying defaults.
        $this->_settings = self::defaults( $settings, self::$defaults );

        // Register Job Post Type, if needed.
        $this->_register_post_type();

        // Insert Job, get job ID.
        $this->_id = wp_insert_post( $this->_settings );

        // Handle creation error.
        if( $this->_id instanceof WP_Error ) {

        }

      }

      /**
       * Register Job Post Type
       *
       * @private
       * @uses get_post_type_object
       * @uses register_post_type
       */
      private function _register_post_type() {

        // Return if already registered.
        if( get_post_type_object( $this->_settings->post_type ) ) {
          return get_post_type_object( $this->_settings->post_type );
        }

        // Register;
        register_post_type( $this->_settings->post_type, array(
          'labels' => array(
            'name'               => __( 'Jobs', self::$text_domain ),
            'singular_name'      => __( 'Jobs', self::$text_domain ),
            'new_item'           => __( 'New Job', self::$text_domain ),
            'view_item'          => __( 'View Job', self::$text_domain ),
            'all_items'          => __( 'Jobs', self::$text_domain )
          ),
          'description'          => __( 'UsabilityDynamics Jobs.', self::$text_domain ),
          'public'               => false,
          'hierarchical'         => false,
          'exclude_from_search'  => true,
          'publicly_queryable'   => false,
          'show_ui'              => false,
          'show_in_menu'         => false,
          'show_in_nav_menus'    => false,
          'show_in_admin_bar'    => false,
          'map_meta_cap'         => false,
          'supports'             => array( 'raas' ),
          'has_archive'          => false,
          'rewrite'              => false,
          'query_var'            => false,
          'can_export'           => true,
          'delete_with_user'     => false,
          '_edit_link'           => 'veneer/?job=%d',
        ));

        // Return post type object.
        return get_post_type_object( $this->_settings->post_type );

      }

    }

  }

}

