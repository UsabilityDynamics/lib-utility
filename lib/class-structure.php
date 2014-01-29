<?php
/**
 * Inits Custom Post Types, Taxonimies, Meta
 *
 * @author Usability Dynamics, Inc. <info@usabilitydynamics.com>
 * @package Theme
 * @author peshkov@UD
 */
namespace UsabilityDynamics {

  if( !class_exists( 'UsabilityDynamics\Structure' ) ) {

  static class Structure {
    
      public function define( $args = array() ) {
      
        $args = wp_parse_args( $args, array(
          'types' => array(), // Custom post types
          'meta' => array(), // Meta fields
          'taxonomies' => array(), // Taxonomies
        ) );
        
        //echo "<pre>"; print_r( $args ); echo "</pre>"; die();
      
      }

  }

}



