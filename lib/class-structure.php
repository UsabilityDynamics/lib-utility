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

    class Structure {
    
      /**
       *
       *
       */
      static private $args;
      
      /**
       *
       *
       */
      static public function define( $args = array() ) {
      public static function define( $args = array() ) {
      
        self::$args = wp_parse_args( $args, array(
          'types' => array(), // Custom post types
          'meta' => array(), // Meta fields
          'taxonomies' => array(), // Taxonomies
        ) );
        
        
        foreach( (array) self::$args[ 'types' ] as $object_type => $type ) { 
          
          // STEP 1. Register post_type
          
          // Register Post Type
          $data = ( isset( $type[ 'data' ] ) && is_array( $type[ 'data' ] ) ) ? $type[ 'data' ] : array();
          register_post_type( $object_type, self::_prepare_post_type( $object_type, $data ) );
          
          // Define post type's taxonomies
          $taxonomies = ( isset( $type[ 'taxonomies' ] ) && is_array( $type[ 'taxonomies' ] ) ) ? $type[ 'taxonomies' ] : array(
            'post_tag',
            'category',
          );
          
          // STEP 2. Register taxonomy
          
          // Initialize taxonomies if they don't exist and assign them to the current post type
          foreach( $taxonomies as $taxonomy ) {
            
            if( empty( $taxonomy ) || !is_string( $taxonomy ) ) {
              continue;
            }
            
            if( !taxonomy_exists( $taxonomy ) ) {
              $data = self::_prepare_taxonomy( $taxonomy );
              register_taxonomy( $taxonomy, null, $data );
            }
            
            register_taxonomy_for_object_type( $taxonomy, $object_type );
            
          }
          
          // STEP 3. Set meta fields and meta boxes
          
          // Break if Meta Box class doesn't exist
          if( !class_exists( '\RW_Meta_Box' ) ) {
            return false;
          }
          
          // Init \RW_Meta_Box defines if needed
          if ( !defined( 'RWMB_VER' ) ) {
            $reflector = new \ReflectionClass( '\RW_Meta_Box' );
            $file = dirname( dirname( $reflector->getFileName() ) ) . '/meta-box.php';
            if( !file_exists( $file ) ) {
              return false;
            }
            include_once( $file );
          }
          
          $metaboxes = ( isset( $type[ 'meta' ] ) && is_array( $type[ 'meta' ] ) ) ? $type[ 'meta' ] : array();
          foreach( $metaboxes as $key => $data ) {
            $data = self::_prepare_metabox( $key, $object_type, $data );
            
            if( $data ) {
              new \RW_Meta_Box( $data );
            }
          }
          
        }
        
        //die();
        //echo "<pre>"; print_r( $args ); echo "</pre>"; die();
      }
      
      /**
       *
       *
       */
      static private function _prepare_metabox( $key, $object_type, $data ) {
        $label = \UsabilityDynamics\Utility::de_slug( $key );
        
        $data = wp_parse_args( $data, array(
          'id' => $key,
          'title' => $label,
          'pages' => array( $object_type ),
          'context'  => 'normal',
          'priority' => 'high',
          'autosave' => false,
          'fields' => array(),
        ) );
        
        // There is no sense to init empty metabox
        if( !is_array( $data[ 'fields' ] ) || empty( $data[ 'fields' ] ) ) {
          return false;
        }
        
        $fields = array();
        foreach( $data[ 'fields' ] as $field ) {
          $fields[] = self::_prepare_metafield( $field );
        }
        $data[ 'fields' ] = $fields;
        
        return $data;
      }
      
      /**
       *
       *
       */
      static private function _prepare_metafield( $key ) {
        $data = isset( self::$args[ 'meta' ][ $key ] ) ? (array) self::$args[ 'meta' ][ $key ] : array();
        $data = wp_parse_args( $data, array(
          'id' => $key,
          'name' => \UsabilityDynamics\Utility::de_slug( $key ),
          'type' => 'text',
        ) );
        return $data;
      }
      
      /**
       *
       *
       */
      static private function _prepare_taxonomy( $key ) {
        $data = isset( self::$args[ 'taxonomies' ][ $key ] ) && is_array( self::$args[ 'taxonomies' ][ $key ] ) ? self::$args[ 'taxonomies' ][ $key ] : array();
        $data = wp_parse_args( $data, array(
          'label' => \UsabilityDynamics\Utility::de_slug( $key ),
        ) );
        return $data;
      }
      
      /**
       *
       *
       */
      static private function _prepare_post_type( $key, $args = array() ) {
        $args = wp_parse_args( $args, array(
          'label' => \UsabilityDynamics\Utility::de_slug( $key ),
          'exclude_from_search' => false,
        ) );
        return $args;
      }

    }

  }

}



