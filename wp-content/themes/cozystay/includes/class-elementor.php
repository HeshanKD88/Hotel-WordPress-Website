<?php
/**
* Elementor frontend render class.
*/

class CozyStay_Elementor {
    /**
    * Object current class instance to make sure only once instance in running
    */
    public static $instance = false;
    /*
    * Boolean is site header enabled
    */
    protected $is_site_header_enabled = false;
    /*
    * Boolean is site footer enabled
    */
    protected $is_site_footer_enabled = false;
    /*
    * Construction function
    */
    public function __construct() {
        add_action( 'template_redirect', array( $this, 'check_elementor_site_header_footer' ) );
    }
    /*
    * Check elementor pro site header footer
    */
    public function check_elementor_site_header_footer() {
        if ( class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) { 
            $header_locations = ElementorPro\Modules\ThemeBuilder\Module::instance()->get_conditions_manager()->get_documents_for_location( 'header' ); 
            $footer_locations = ElementorPro\Modules\ThemeBuilder\Module::instance()->get_conditions_manager()->get_documents_for_location( 'footer' );

            $this->is_site_header_enabled = cozystay_is_valid_array( $header_locations );
            $this->is_site_footer_enabled = cozystay_is_valid_array( $footer_locations );
        }

        if ( $this->is_site_header_enabled || $this->is_site_footer_enabled ) {
            if ( $this->is_site_header_enabled ) {
                add_action( 'elementor/theme/before_do_header', array( $this, 'before_elementor_site_header' ) );
                add_action( 'elementor/theme/after_do_header', array( $this, 'after_elementor_site_header' ) );
            } else {
                add_action( 'wp_body_open', array( $this, 'before_elementor_site_header' ), 9999 );
                add_action( 'wp_body_open', array( $this, 'after_elementor_site_header' ), 9999 );
            }

            if ( $this->is_site_footer_enabled ) {
                add_action( 'elementor/theme/before_do_footer', array( $this, 'before_elementor_site_footer' ) );
                add_action( 'elementor/theme/after_do_footer', array( $this, 'after_elementor_site_footer' ) );
            } else {
                add_action( 'wp_footer', array( $this, 'before_elementor_site_footer' ), 0 );
                add_action( 'wp_footer', array( $this, 'after_elementor_site_footer' ), 0 );
            }
        }
    }
    /*
    * Before elementor site header
    */
    public function before_elementor_site_header() { ?>
        <div id="page"><?php 
            do_action( 'cozystay_the_page_open' );
    }
    /*
    * After elementor site header
    */
    public function after_elementor_site_header() { ?>
        <div id="content" <?php cozystay_the_content_class(); ?>><?php 
            do_action( 'cozystay_the_content_open' );
    }
    /*
    * Before Elementor site footer
    */ 
    public function before_elementor_site_footer() {
            do_action( 'cozystay_the_content_close' ); ?>
        </div> <!-- end of #content --><?php
    }
    /*
    * After Elementor site footer
    */ 
    public function after_elementor_site_footer() { 
            do_action( 'cozystay_the_page_close' ); ?>
        </div> <!-- end of #page --><?php 
        // did_action( 'wp_footer' ) ? '' : wp_footer();
        do_action( 'cozystay_after_site_footer' );
    }
    /**
    * Instance Loader class, there can only be one instance of loader
    * @return class Loader instance
    */
    public static function _instance() {
        if ( false === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
add_action( 'loftocean_init_elementor', 'CozyStay_Elementor::_instance' );