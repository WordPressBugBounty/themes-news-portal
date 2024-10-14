<?php
/**
 * Add extended Global and Categories section and it's fields inside footer main area Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_footer_main_area_options' );

if ( ! function_exists( 'news_portal_register_footer_main_area_options' ) ) :

    /**
     * Register theme options for footer main area section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_footer_main_area_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Widget Area Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_section(
            'news_portal_footer_widget_section',
            array(
                'title'     => esc_html__( 'Widget Area', 'news-portal' ),
                'panel'     => 'news_portal_footer_settings_panel',
                'priority'  => 5,
            )
        );

        /**
         * Toggle option for footer widget area
         *
         * @since 1.0.0
         */
         $wp_customize->add_setting( 'news_portal_footer_widget_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_footer_widget_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_footer_widget_option',
                array(
                    'priority'      => 5,
                    'section'       => 'news_portal_footer_widget_section',
                    'settings'      => 'news_portal_footer_widget_option',
                    'label'         => __( 'Footer Widget Section', 'news-portal' ),
                    'description'   => __( 'Show/Hide option for footer widget area section.', 'news-portal' )
                )
            )
        );

        /**
         * Image Radio field for widget area column
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'footer_widget_layout',
            array(
                'default'           => news_portal_get_customizer_default( 'footer_widget_layout' ),
                'sanitize_callback' => 'news_portal_sanitize_select',
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Radio_Image(
            $wp_customize,
            'footer_widget_layout',
                array(
                    'priority'      => 10,
                    'label'         => esc_html__( 'Footer Widget Layout', 'news-portal' ),
                    'description'   => esc_html__( 'Choose layout from available layouts', 'news-portal' ),
                    'section'       => 'news_portal_footer_widget_section',
                    'choices'       => news_portal_footer_widget_layout_choices(),
                    'active_callback' => 'news_portal_has_enable_footer_widget'
                )
            )
        );

        /**
         * Upgrade field for footer main area
         *
         * @since 1.5.0
         */ 
        $wp_customize->add_setting( 'news_preloader_upgrade_footer_main_area',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Upgrade(
            $wp_customize, 'news_preloader_upgrade_footer_main_area',
                array(
                    'priority'      => 200,
                    'section'       => 'news_portal_footer_widget_section',
                    'settings'      => 'news_preloader_upgrade_footer_main_area',
                    'label'         => __( 'More Features with News Portal Pro', 'news-portal' ),
                    'choices'       => news_portal_upgrade_choices( 'news_portal_footer_area' )
                )
            )
        );
    }

endif;