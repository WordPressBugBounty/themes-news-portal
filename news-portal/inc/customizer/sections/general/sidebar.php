<?php
/**
 * Add extended Global and Categories section and it's fields inside Sidebar Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_sidebar_options' );

if ( ! function_exists( 'news_portal_register_sidebar_options' ) ) :

    /**
     * Register theme options for Sidebar section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_sidebar_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

         /**
         * Sidebar Section
         *
         * @since 1.5.0
         */
        $wp_customize->add_section(
            'news_portal_sidebar_section',
            array(
                'title'     => esc_html__( 'Sidebars', 'news-portal' ),
                'panel'     => 'news_portal_general_settings_panel',
                'priority'  => 30,
            )
        );

         /**
         * Toggle option for front page sticky sidebar
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_front_sidebar_sticky_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_front_sidebar_sticky_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_front_sidebar_sticky_option',
                array(
                    'priority'      => 5,
                    'section'       => 'news_portal_sidebar_section',
                    'settings'      => 'news_portal_front_sidebar_sticky_option',
                    'label'         => __( 'Frontpage Sticky', 'news-portal' ),
                    'description'   => __( 'Enable/Disable sticky sidebar for frontpage sidebar.', 'news-portal' )
                )
            )
        );


         /**
         * Toggle option for inner page sticky sidebar
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_inner_sidebar_sticky_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_inner_sidebar_sticky_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_inner_sidebar_sticky_option',
                array(
                    'priority'      => 5,
                    'section'       => 'news_portal_sidebar_section',
                    'settings'      => 'news_portal_inner_sidebar_sticky_option',
                    'label'         => __( 'Innerpage Sticky', 'news-portal' ),
                    'description'   => __( 'Enable/Disable sticky sidebar for innperpages like( archive, single, search ) pages.', 'news-portal' )
                )
            )
        );

        /**
         * Heading Toggle field for Archive Sidebar Layout
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_archive_sidebar_heading_toggle', 
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Heading_Toggle( 
            $wp_customize, 'news_portal_archive_sidebar_heading_toggle', 
                array(
                    'priority'    => 5,
                    'label'       => esc_html__( 'Archive Sidebars', 'news-portal' ),
                    'section'     => 'news_portal_sidebar_section',

                )
            )
        );

         /**
         * Image Radio field for archive sidebar
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'news_portal_archive_sidebar',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_archive_sidebar' ),
                'sanitize_callback' => 'news_portal_sanitize_select',
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Radio_Image(
            $wp_customize,
            'news_portal_archive_sidebar',
                array(
                    'description' => esc_html__( 'Choose sidebar from available layouts', 'news-portal' ),
                    'section'  => 'news_portal_sidebar_section',
                    'choices'  => news_portal_sidebar_layout_choices(),
                    'priority' => 10
                )
            )
        );

        /**
         * Heading Toggle field for Page Sidebar Layout
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_page_sidebar_heading_toggle', 
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Heading_Toggle( 
            $wp_customize, 'news_portal_page_sidebar_heading_toggle', 
                array(
                    'priority'    => 15,
                    'label'       => esc_html__( 'Page Sidebars', 'news-portal' ),
                    'section'     => 'news_portal_sidebar_section',
                    'initial'     => false,
                )
            )
        );

         /**
         * Image Radio for page sidebar
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'news_portal_default_page_sidebar',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_default_page_sidebar' ),
                'sanitize_callback' => 'news_portal_sanitize_select',
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Radio_Image(
            $wp_customize,
            'news_portal_default_page_sidebar',
                array(
                    'label'    => esc_html__( 'Page Sidebars', 'news-portal' ),
                    'description' => esc_html__( 'Choose sidebar from available layouts', 'news-portal' ),
                    'section'  => 'news_portal_sidebar_section',
                    'choices'  => news_portal_sidebar_layout_choices(),
                    'priority' => 20
                )
            )
        );

        /**
         * Heading Toggle field for Post Sidebar Layout
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_post_sidebar_heading_toggle', 
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Heading_Toggle( 
            $wp_customize, 'news_portal_post_sidebar_heading_toggle', 
                array(
                    'priority'    => 25,
                    'label'       => esc_html__( 'Post Sidebars', 'news-portal' ),
                    'section'     => 'news_portal_sidebar_section',
                    'initial'     => false,
                )
            )
        );

        /**
         * Image Radio for post sidebar
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'news_portal_default_post_sidebar',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_default_post_sidebar' ),
                'sanitize_callback' => 'news_portal_sanitize_select',
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Radio_Image(
            $wp_customize,
            'news_portal_default_post_sidebar',
                array(
                    'description' => esc_html__( 'Choose sidebar from available layouts', 'news-portal' ),
                    'section'  => 'news_portal_sidebar_section',
                    'choices'  => news_portal_sidebar_layout_choices(),
                    'priority' => 30
                )
            )
        );      
    }

endif;