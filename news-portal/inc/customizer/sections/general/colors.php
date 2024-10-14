<?php
/**
 * Add extended Global and Categories section and it's fields inside Colors Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_theme_colors_options' );

if ( ! function_exists( 'news_portal_register_theme_colors_options' ) ) :

    /**
     * Register theme options for Colors section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_theme_colors_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Add Color Section
         * 
         * General Settings > Colors
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new News_Portal_Customize_Section (
            $wp_customize, 'news_portal_section_colors',
                array(
                    'priority'  => 20,
                    'panel'     => 'news_portal_general_settings_panel',
                    'title'     => __( 'Colors', 'news-portal' ),
                )
            )
        );

        /**
         * Add Base Colors Section
         * 
         * General Settings > Colors
         * 
         * @uses $wp_customize->add_section() https://developer.wordpress.org/reference/classes/wp_customize_manager/add_section/
         * @since 1.0.0
         */
        $wp_customize->add_section( new News_Portal_Customize_Section (
            $wp_customize, 'news_portal_section_colors_base',
                array(
                    'priority'  => 10,
                    'panel'     => 'news_portal_general_settings_panel',
                    'section'   => 'news_portal_section_colors',
                    'title'     => __( 'Base Colors', 'news-portal' ),
                )
            )
        );

        /**
         * Color Picker field for Primary Theme Color
         * 
         * General Settings > Colors > Base Colors
         * 
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_theme_color',
            array(
                'default'           => news_portal_get_customizer_default ( 'news_portal_theme_color' ),
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize, 'news_portal_theme_color',
                array(
                    'priority'   => 5,
                    'section'    => 'news_portal_section_colors_base',
                    'settings'   => 'news_portal_theme_color',
                    'label'      => __( 'Primary Theme Color', 'news-portal' )
                )
            )
        );

        /**
         * Color Picker field for Header Text Color
         * 
         * General Settings > Colors > Base Colors
         * 
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_site_title_color',
            array(
                'default'           => news_portal_get_customizer_default ( 'news_portal_site_title_color' ),
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize, 'news_portal_site_title_color',
                array(
                    'priority'   => 10,
                    'section'    => 'news_portal_section_colors_base',
                    'settings'   => 'news_portal_site_title_color',
                    'label'      => __( 'Header Text Color', 'news-portal' )
                )
            )
        );

        /**
         * Category Color Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_section( new News_Portal_Customize_Section (
            $wp_customize, 'news_portal_categories_color_section',
                array(
                    'priority'  => 10,
                    'panel'     => 'news_portal_general_settings_panel',
                    'section'   => 'news_portal_section_colors',
                    'title'     => __( 'Categories Color', 'news-portal' ),
                )
            )
        );


        $priority = 5;
        $categories = get_categories( array( 'hide_empty' => 1 ) );
        $wp_category_list = array();

        foreach ( $categories as $category_list ) {

            $wp_customize->add_setting( 
                'news_portal_category_color_'.esc_html( strtolower( $category_list->slug ) ),
                array(
                    'default'              => '#00a9e0',
                    'capability'           => 'edit_theme_options',
                    'sanitize_callback'    => 'sanitize_hex_color'
                )
            );

            $wp_customize->add_control( new WP_Customize_Color_Control(
                $wp_customize, 
                'news_portal_category_color_'.esc_html( strtolower( $category_list->slug ) ),
                    array(
                        'label'    => sprintf( esc_html__( ' %s', 'news-portal' ), esc_html( $category_list->name ) ),
                        'section'  => 'news_portal_categories_color_section',
                        'priority' => $priority
                    )
                )
            );
            $priority++;
        }

    }

endif;