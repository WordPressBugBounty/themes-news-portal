<?php
/**
 * Customizer Heading Control.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'News_Portal_Control_Heading_Toggle' ) ) :
    
    /**
     * Heading control.
     *
     * @since 1.0.0
     */
    class News_Portal_Control_Heading_Toggle extends WP_Customize_Control {

        /**
         * The control type.
         *
         * @access public
         * @var string
         * @since 1.0.0
         */
        public $type = 'mt-heading-toggle';

        public $initial = true;

         /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['initial'] = $this->initial;
        }

        /**
         * Enqueue scripts/styles.
         *
         * @since 1.0.0
         */
        public function enqueue() {
            wp_enqueue_style( 'storeflex-customizer-section-heading-toggle', get_template_directory_uri() . '/inc/customizer/custom-controls/heading-toggle/heading-toggle.css', null );
            wp_enqueue_script( 'storeflex-customizer-section-heading-toggle', get_template_directory_uri() . '/inc/customizer/custom-controls/heading-toggle/heading-toggle.js', array( 'jquery' ), false, true );
        }

        /**
         *
         * @see WP_Customize_Control::print_template()
         *
         * @access protected
         */
        protected function content_template() {
    ?>
        <div class="mt-customize-heading-toggle">
            <h4 class="mt-customizer-heading-toggle">{{{ data.label }}}</h4>
             <span class="toggle-button"><span class="dashicons dashicons-arrow-up-alt2"></span></span>
            <# if ( data.description ) { #>
            <div class="description">{{{ data.description }}}</div>
            <# } #>
        </div>
    <?php
        }

    }

endif;