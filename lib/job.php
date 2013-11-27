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
        "post_status" => 'job-ready',
        "post_type" => '_ud_job'
      );

      /**
       * Job Instance ID.
       *
       * @property $_id
       * @private
       * @type {Integer}
       */
      private $_id = null;

      private $_status = null;

      private $_batches = array();

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

        // Load job if ID is set.
        if( $this->_settings->id ) {
          return $this->load( $this->_settings->id );
        }

        // Insert Job, get job ID.
        $this->_id = wp_insert_post( $this->_settings );

        // Handle creation error.
        if( $this->_id instanceof WP_Error ) {
          wp_die( $this->_id );
        }

        // Register Worker Callback.
        if( is_callable( $this->_settings->worker )) {
          update_post_meta( $this->_id, 'callback::worker', json_encode( $this->_settings->worker ) );
        }

        // Register Completion Callback.
        if( is_callable( $this->_settings->complete )) {
          update_post_meta( $this->_id, 'callback::complete', json_encode( $this->_settings->complete ) );
        }

        // Reference status.
        $this->_status = $this->_settings->status;

        // Worker.
        return $this;

      }

      /**
       * Load Job
       *
       * @param null $id
       */
      public function load( $id = null ) {}

      /**
       * Run Job
       *
       */
      public function run() {}

      /**
       * Delete Job Instance.
       *
       */
      public function delete() {
        global $wpdb;

        // Kill Babies.
        foreach( (array) $wpdb->get_col( $_children_query = $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_parent=%d; ", $this->_id ) ) as $_child ) {
          $_post = wp_delete_post( $_child, true );
        }

        // Kill Parent.
        $_post = wp_delete_post( $this->_id, true );

        // Mark Status.
        $this->_status = 'deleted';

        // Return object.
        return $_post;

      }

      /**
       * Add Job Batch
       *
       * @param array $data
       * @param array $args
       *
       * @return int|void|\WP_Error
       */
      public function add_batch( $data = array(), $args = array() ) {

        // Convert to JSON String.
        $_data = json_encode( $data );

        $_batch_id = wp_insert_post( self::defaults( $args, array(
          'post_parent' => $this->_id,
          'post_status' => 'job-ready',
          'post_type' => $this->_settings->post_type,
          'post_content' => $_data
        )) );

        // Add to batch list if not an error.
        if( !is_wp_error( $_batch_id ) ) {
          $this->_batches[ $_batch_id ] = $_data;
        }

        return $_batch_id;

      }

      /**
       * Complete Job
       *
       */
      public function complete() {}

      /**
       * Process Job Instances.
       *
       */
      public static function process_jobs( $type = null, $args = array() ) {
        wp_die('process_jobs');
      }

      /**
       * Get Job Instances
       *
       * @param null  $type
       * @param array $args
       */
      public static function get_jobs( $type = null, $args = array() ) {
        wp_die('get_jobs');
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
          'hierarchical'         => true,
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

