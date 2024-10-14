<?php
/**
 * Add extended Global and Categories section and it's fields inside post settings Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_post_settings_options' );

if ( ! function_exists( 'news_portal_register_post_settings_options' ) ) :

    /**
     * Register theme options for post settings section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_post_settings_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

         /**
         * Post Settings
         *
         * @since 1.0.0
         */
        $wp_customize->add_section(
            'news_portal_post_settings_section',
            array(
                'title'     => esc_html__( 'Post Settings', 'news-portal' ),
                'panel'     => 'news_portal_design_settings_panel',
                'priority'  => 15,
            )
        );      

        /**
         * Toggle option for Related posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_related_posts_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_related_posts_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_related_posts_option',
                array(
                    'priority'      => 10,
                    'section'       => 'news_portal_post_settings_section',
                    'settings'      => 'news_portal_related_posts_option',
                    'label'         => __( 'Related Post Option', 'news-portal' ),
                    'description'   => __( 'Show/Hide option for related posts section at single post page.', 'news-portal' )
                )
            )
        );

        /**
         * Text field for related post section title
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'news_portal_related_posts_title',
            array(
                'default'    => news_portal_get_customizer_default( 'news_portal_related_posts_title' ),
                'transport'  => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );

        $wp_customize->add_control(
            'news_portal_related_posts_title',
            array(
                'priority'          => 15,
                'type'              => 'text',
                'label'             => esc_html__( 'Related Post Section Title', 'news-portal' ),
                'section'           => 'news_portal_post_settings_section',
                'active_callback'   => 'news_portal_has_enable_related_post'
            )
        );

         /**
         * Upgrade field for single page
         *
         * @since 1.5.0
         */ 
        $wp_customize->add_setting( 'news_preloader_upgrade_single_page',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Upgrade(
            $wp_customize, 'news_preloader_upgrade_single_page',
                array(
                    'priority'      => 200,
                    'section'       => 'news_portal_post_settings_section',
                    'settings'      => 'news_preloader_upgrade_single_page',
                    'label'         => __( 'More Features with News Portal Pro', 'news-portal' ),
                    'choices'       => news_portal_upgrade_choices( 'news_portal_single_page' )
                )
            )
        );
        
        $wp_customize->selective_refresh->add_partial(
            'news_portal_related_posts_title', 
            array(
                'selector' => 'h2.np-related-title',
                'render_callback' => 'news_portal_customize_partial_related_title',
            )
        );

    }

endif;