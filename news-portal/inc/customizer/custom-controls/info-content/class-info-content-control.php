<?php
/**
 * Customizer Info Content Control.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'News_Portal_Info_Content' ) ) :
    
    /**
     * Theme Info Content
     *
     * @since 1.1.0
     */
    class News_Portal_Info_Content extends WP_Customize_Control {
        public $type = 'mt-info';
        public function render_content() {
    ?>            
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div class="description customize-control-description"><?php echo wp_kses_post($this->description); ?></div>
    <?php
        }
    }// end News_Portal_Info_Content

endif;