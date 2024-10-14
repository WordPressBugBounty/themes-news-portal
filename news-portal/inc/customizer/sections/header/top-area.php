<?php
/**
 * Add extended Global and Categories section and it's fields inside header top area Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_header_top_area_options' );

if ( ! function_exists( 'news_portal_register_header_top_area_options' ) ) :

    /**
     * Register theme options for top header area section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_header_top_area_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Top Header Section
         */
        $wp_customize->add_section(
            'news_portal_top_header_section',
            array(
                'title'     => __( 'Top Header Section', 'news-portal' ),
                'priority'  => 20,
                'panel'     => 'news_portal_header_settings_panel'
            )
        );

        /**
         * Toggle option for Top Header
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_top_header_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_top_header_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_top_header_option',
                array(
                    'priority'      => 5,
                    'section'       => 'news_portal_top_header_section',
                    'settings'      => 'news_portal_top_header_option',
                    'label'         => __( 'Top Header Section', 'news-portal' ),
                    'description'   => __( 'Show/Hide option for top header section.', 'news-portal' )
                )
            )
        );

        /**
         * Toggle option for Current Date
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_top_date_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_top_date_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_top_date_option',
                array(
                    'priority'      => 10,
                    'section'       => 'news_portal_top_header_section',
                    'settings'      => 'news_portal_top_date_option',
                    'label'         => __( 'Current Date', 'news-portal' ),
                    'description'   => __( 'Show/Hide option for current date at top header section.', 'news-portal' ),
                    'active_callback' => 'news_portal_has_enable_header_top_area'
                )
            )
        );

        /**
         * Toggle option for Social Icon
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_top_social_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_top_social_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_top_social_option',
                array(
                    'priority'      => 15,
                    'section'       => 'news_portal_top_header_section',
                    'settings'      => 'news_portal_top_social_option',
                    'label'         => __( 'Social Icons', 'news-portal' ),
                    'description'   => __( 'Show/Hide option for social media icons at top header section.', 'news-portal' ),
                    'active_callback' => 'news_portal_has_enable_header_top_area'
                )
            )
        );

      
    }

endif;