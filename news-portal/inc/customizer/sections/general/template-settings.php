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

add_action( 'customize_register', 'news_portal_register_template_settings_options' );

if ( ! function_exists( 'news_portal_register_template_settings_options' ) ) :

    /**
     * Register theme options for Template Settings section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_template_settings_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

       /**
         * Templates Settings
         *
         * @since 1.0.0
         */
        $wp_customize->add_section(
            'news_portal_templates_settings_section',
            array(
                'title'         => __( 'Template Settings', 'news-portal' ),
                'description'   => __( 'Manage the settings for available templates.', 'news-portal' ),
                'priority'      => 45,
                'panel'         => 'news_portal_general_settings_panel',
            )
        );

        /**
         * Toggle option for homepage template content show hide
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_home_template_content_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_home_template_content_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_home_template_content_option',
                array(
                    'priority'      => 10,
                    'section'       => 'news_portal_templates_settings_section',
                    'settings'      => 'news_portal_home_template_content_option',
                    'label'         => __( 'Home Page Template', 'news-portal' ),
                    'description'   => __( 'Show/Hide option to display content of the pages that uses home page template.', 'news-portal' )
                )
            )
        );

        /**
         * Toggle option for block base widget editor.
         * 
         * @since 1.3.0
         */
         $wp_customize->add_setting( 'np_block_base_widget_editor_option',
            array(
                'default'           => news_portal_get_customizer_default( 'np_block_base_widget_editor_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'np_block_base_widget_editor_option',
                array(
                    'priority'      => 20,
                    'section'       => 'news_portal_templates_settings_section',
                    'settings'      => 'np_block_base_widget_editor_option',
                    'label'         => __( 'Block Widget Editor Option', 'news-portal' ),
                    'description'   => __( 'Enable/disable Block-based Widgets Editor(since WordPress 5.8).', 'news-portal' )
                )
            )
        );

    }

endif;