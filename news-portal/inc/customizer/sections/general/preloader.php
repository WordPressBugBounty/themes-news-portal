<?php
/**
 * Add extended Global and Categories section and it's fields inside preloader Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_preloader_options' );

if ( ! function_exists( 'news_portal_register_preloader_options' ) ) :

    /**
     * Register theme options for preloader section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_preloader_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

         /**
         * Preloader Section
         *
         * @since 1.5.0
         */
        $wp_customize->add_section(
            'news_portal_preloader_section',
            array(
                'title'     => esc_html__( 'Preloaders', 'news-portal' ),
                'panel'     => 'news_portal_general_settings_panel',
                'priority'  => 15,
            )
        );

        /**
         * Toggle option for preloaders
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_preloader_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_preloader_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_preloader_option',
                array(
                    'priority'      => 5,
                    'section'       => 'news_portal_preloader_section',
                    'settings'      => 'news_portal_preloader_option',
                    'label'         => __( 'Preloader', 'news-portal' ),
                    'description'   => __( 'Enable/Disable option for preloader on site.', 'news-portal' )
                )
            )
        );

         /**
         * Image Radio field for preloader
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'news_portal_preloader_choices',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_preloader_choices' ),
                'sanitize_callback' => 'news_portal_sanitize_select',
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Radio_Image(
            $wp_customize,
            'news_portal_preloader_choices',
                array(
                    'priority'      => 10,
                    'description'   => esc_html__( 'Choose preloader from available gif', 'news-portal' ),
                    'section'       => 'news_portal_preloader_section',
                    'settings'      => 'news_portal_preloader_choices',
                    'choices'       => news_portal_preloader_style_choices(),
                    'active_callback' => 'news_portal_has_enable_preloader'
                )
            )
        );

         /**
         * Upgrade field for preloader
         *
         * @since 1.5.0
         */ 
        $wp_customize->add_setting( 'news_preloader_upgrade_preloader',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Upgrade(
            $wp_customize, 'news_preloader_upgrade_preloader',
                array(
                    'priority'      => 200,
                    'section'       => 'news_portal_preloader_section',
                    'settings'      => 'news_preloader_upgrade_preloader',
                    'label'         => __( 'More Features with News Portal Pro', 'news-portal' ),
                    'choices'       => news_portal_upgrade_choices( 'news_portal_preloader' )
                )
            )
        );
    }

endif;