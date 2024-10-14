<?php
/**
 * Add extended Global and Categories section and it's fields inside header option Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_header_options' );

if ( ! function_exists( 'news_portal_register_header_options' ) ) :

    /**
     * Register theme options for header area section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_header_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Header Section
         */
        $wp_customize->add_section(
            'news_portal_header_option_section',
            array(
                'title'     => __( 'Header Option', 'news-portal' ),
                'priority'  => 25,
                'panel'     => 'news_portal_header_settings_panel'
            )
        );    

        /**
         * Toggle option for primary menu sticky
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_menu_sticky_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_menu_sticky_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_menu_sticky_option',
                array(
                    'priority'      => 5,
                    'section'       => 'news_portal_header_option_section',
                    'settings'      => 'news_portal_menu_sticky_option',
                    'label'         => __( 'Sticky Menu', 'news-portal' ),
                    'description'   => __( 'Enable/Disable option for sticky menu.', 'news-portal' )
                )
            )
        );

        /**
         * Toggle option for Home Icon
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_home_icon_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_home_icon_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_home_icon_option',
                array(
                    'priority'      => 10,
                    'section'       => 'news_portal_header_option_section',
                    'settings'      => 'news_portal_home_icon_option',
                    'label'         => __( 'Home Icon', 'news-portal' ),
                    'description'   => __( 'Show/Hide option for home icon at primary menu.', 'news-portal' )
                )
            )
        );

        /**
         * Toggle option for Search Icon
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_search_icon_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_search_icon_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_search_icon_option',
                array(
                    'priority'      => 15,
                    'section'       => 'news_portal_header_option_section',
                    'settings'      => 'news_portal_search_icon_option',
                    'label'         => __( 'Search Icon', 'news-portal' ),
                    'description'   => __( 'Show/Hide option for search icon at primary menu.', 'news-portal' )
                )
            )
        );

        /**
         * Upgrade field for header options
         *
         * @since 1.5.0
         */ 
        $wp_customize->add_setting( 'news_preloader_upgrade_header_options',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Upgrade(
            $wp_customize, 'news_preloader_upgrade_header_options',
                array(
                    'priority'      => 200,
                    'section'       => 'news_portal_header_option_section',
                    'settings'      => 'news_preloader_upgrade_header_options',
                    'label'         => __( 'More Features with News Portal Pro', 'news-portal' ),
                    'choices'       => news_portal_upgrade_choices( 'news_portal_header_options' )
                )
            )
        );
        
    }

endif;