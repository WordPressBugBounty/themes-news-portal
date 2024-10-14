<?php
/**
 * Add extended Global and Categories section and it's fields inside bottom footer Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_footer_bottom_options' );

if ( ! function_exists( 'news_portal_register_footer_bottom_options' ) ) :

    /**
     * Register theme options for bottom footer section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_footer_bottom_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Bottom Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_section(
            'news_portal_footer_bottom_section',
            array(
                'title'     => esc_html__( 'Bottom Section', 'news-portal' ),
                'panel'     => 'news_portal_footer_settings_panel',
                'priority'  => 10,
            )
        );

        /**
         * Text field for copyright
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'news_portal_copyright_text',
            array(
                'default'    => news_portal_get_customizer_default( 'news_portal_copyright_text' ),
                'transport'  => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'news_portal_copyright_text',
            array(
                'type'      => 'text',
                'label'     => esc_html__( 'Copyright Text', 'news-portal' ),
                'section'   => 'news_portal_footer_bottom_section',
                'priority'  => 5
            )
        );

        /**
         * Upgrade field for footer bottom area
         *
         * @since 1.5.0
         */ 
        $wp_customize->add_setting( 'news_preloader_upgrade_footer_bottom_area',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Upgrade(
            $wp_customize, 'news_preloader_upgrade_footer_bottom_area',
                array(
                    'priority'      => 200,
                    'section'       => 'news_portal_footer_bottom_section',
                    'settings'      => 'news_preloader_upgrade_footer_bottom_area',
                    'label'         => __( 'More Features with News Portal Pro', 'news-portal' ),
                    'choices'       => news_portal_upgrade_choices( 'news_portal_bottom_area' )
                )
            )
        );
        
        $wp_customize->selective_refresh->add_partial( 
            'news_portal_copyright_text', 
            array(
                'selector' => 'span.np-copyright-text',
                'render_callback' => 'news_portal_customize_partial_copyright',
            )
        );
    }

endif;