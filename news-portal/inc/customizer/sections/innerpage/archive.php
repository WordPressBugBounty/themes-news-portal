<?php
/**
 * Add extended Global and Categories section and it's fields inside archive settings Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_archive_settings_options' );

if ( ! function_exists( 'news_portal_register_archive_settings_options' ) ) :

    /**
     * Register theme options for archive settings section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_archive_settings_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

         /**
         * Archive Settings
         *
         * @since 1.0.0
         */
        $wp_customize->add_section(
            'news_portal_archive_settings_section',
            array(
                'title'     => esc_html__( 'Archive Settings', 'news-portal' ),
                'panel'     => 'news_portal_design_settings_panel',
                'priority'  => 5,
            )
        );      

        /**
         * Image Radio field for archive layout
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'news_portal_archive_layout',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_archive_layout' ),
                'sanitize_callback' => 'news_portal_sanitize_select',
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Radio_Image(
            $wp_customize,
            'news_portal_archive_layout',
                array(
                    'priority' => 10,
                    'label'    => esc_html__( 'Archive Layouts', 'news-portal' ),
                    'description' => esc_html__( 'Choose layout from available layouts', 'news-portal' ),
                    'section'  => 'news_portal_archive_settings_section',
                    'choices'  => news_portal_archive_layout_choices(),
                )
            )
        );

        /**
         * Text field for archive read more
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'news_portal_archive_read_more_text',
            array(
                'default'      => news_portal_get_customizer_default( 'news_portal_archive_read_more_text' ),
                'transport'    => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control(
            'news_portal_archive_read_more_text',
            array(
                'type'          => 'text',
                'label'         => esc_html__( 'Read More Text', 'news-portal' ),
                'description'   => __( 'Enter read more button text for archive page.', 'news-portal' ),
                'section'       => 'news_portal_archive_settings_section',
                'priority'      => 15
            )
        );

        /**
         * Upgrade field for archive page
         *
         * @since 1.5.0
         */ 
        $wp_customize->add_setting( 'news_preloader_upgrade_archive_page',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Upgrade(
            $wp_customize, 'news_preloader_upgrade_archive_page',
                array(
                    'priority'      => 200,
                    'section'       => 'news_portal_archive_settings_section',
                    'settings'      => 'news_preloader_upgrade_archive_page',
                    'label'         => __( 'More Features with News Portal Pro', 'news-portal' ),
                    'choices'       => news_portal_upgrade_choices( 'news_portal_archive_page' )
                )
            )
        );

        $wp_customize->selective_refresh->add_partial( 
            'news_portal_archive_read_more_text', 
            array(
                'selector' => '.np-archive-more > a',
                'render_callback' => 'news_portal_customize_partial_archive_more',
            )
        );

    }

endif;