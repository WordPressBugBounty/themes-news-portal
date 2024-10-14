<?php
/**
 * Add extended Global and Categories section and it's fields inside scroll top Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_theme_scroll_top_options' );

if ( ! function_exists( 'news_portal_register_theme_scroll_top_options' ) ) :

    /**
     * Register theme options for scroll top section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_theme_scroll_top_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

         /**
         * Scroll Top Section
         *
         * @since 1.5.0
         */
        $wp_customize->add_section(
            'news_portal_scroll_top_section',
            array(
                'title'     => esc_html__( 'Scroll Top', 'news-portal' ),
                'panel'     => 'news_portal_general_settings_panel',
                'priority'  => 35,
            )
        );

        /**
         * Toggle option for scroll top sticky
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_scroll_top_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_scroll_top_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_scroll_top_option',
                array(
                    'priority'      => 5,
                    'section'       => 'news_portal_scroll_top_section',
                    'settings'      => 'news_portal_scroll_top_option',
                    'label'         => __( 'Scroll Top', 'news-portal' ),
                    'description'   => __( 'Enable/Disable option for scroll top on site.', 'news-portal' )
                )
            )
        );
       
    }

endif;