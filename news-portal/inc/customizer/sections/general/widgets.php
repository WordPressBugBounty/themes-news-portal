<?php
/**
 * Add extended Global and Categories section and it's fields inside  widget settings Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_widget_settings_options' );

if ( ! function_exists( 'news_portal_register_widget_settings_options' ) ) :

    /**
     * Register theme options for Widget Settings section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_widget_settings_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

         /**
         * Widget Settings
         *
         * @since 1.0.0
         */
        $wp_customize->add_section(
            'news_portal_widget_settings_section',
            array(
                'title'     => esc_html__( 'Widget Settings', 'news-portal' ),
                'panel'     => 'news_portal_general_settings_panel',
                'priority'  => 40,
            )
        );

        /**
         * Toggle option for category link at widget title
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_widget_cat_link_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_widget_cat_link_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_widget_cat_link_option',
                array(
                    'priority'      => 5,
                    'section'       => 'news_portal_widget_settings_section',
                    'settings'      => 'news_portal_widget_cat_link_option',
                    'label'         => __( 'Category Link', 'news-portal' ),
                    'description'   => __( 'Enable/Disable option for category link for widget title in block layout widget.', 'news-portal' )
                )
            )
        );

        /**
         * Toggle option for category color at widget title
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_widget_cat_color_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_widget_cat_color_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_widget_cat_color_option',
                array(
                    'priority'      => 10,
                    'section'       => 'news_portal_widget_settings_section',
                    'settings'      => 'news_portal_widget_cat_color_option',
                    'label'         => __( 'Category Color', 'news-portal' ),
                    'description'   => __( 'Enable/Disable option for category color for widget title in block layout widget.', 'news-portal' )
                )
            )
        );

        /**
         * Upgrade field for social icons
         *
         * @since 1.5.0
         */ 
        $wp_customize->add_setting( 'news_preloader_upgrade_widget_settings',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Upgrade(
            $wp_customize, 'news_preloader_upgrade_widget_settings',
                array(
                    'priority'      => 200,
                    'section'       => 'news_portal_widget_settings_section',
                    'settings'      => 'news_preloader_upgrade_widget_settings',
                    'label'         => __( 'More Features with News Portal Pro', 'news-portal' ),
                    'choices'       => news_portal_upgrade_choices( 'news_portal_widget_setting' )
                )
            )
        );
    }

endif;