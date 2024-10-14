<?php
/**
 * Add extended Global and Categories section and it's fields inside ticker Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_ticker_options' );

if ( ! function_exists( 'news_portal_register_ticker_options' ) ) :

    /**
     * Register theme options for ticker section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_ticker_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Ticker Section
         */
        $wp_customize->add_section(
            'news_portal_ticker_section',
            array(
                'title'     => __( 'Ticker Section', 'news-portal' ),
                'priority'  => 30,
                'panel'     => 'news_portal_header_settings_panel'
            )
        );

        /**
         * Toggle option for ticker section
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 'news_portal_ticker_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_ticker_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_ticker_option',
                array(
                    'priority'      => 5,
                    'section'       => 'news_portal_ticker_section',
                    'settings'      => 'news_portal_ticker_option',
                    'label'         => __( 'Ticker Option', 'news-portal' ),
                    'description'   => __( 'Show/Hide option for news ticker section.', 'news-portal' )
                )
            )
        );

        /**
         * Text field for ticker caption
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'news_portal_ticker_caption',
            array(
                'default'    => news_portal_get_customizer_default( 'news_portal_ticker_caption' ),
                'transport'  => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        
        $wp_customize->add_control(
            'news_portal_ticker_caption',
            array(
                'priority'          => 10,
                'type'              => 'text',
                'label'             => esc_html__( 'Ticker Caption', 'news-portal' ),
                'section'           => 'news_portal_ticker_section',
                'active_callback'   => 'news_portal_has_enable_ticker'
            )
        );

        /**
         * Upgrade field for ticker
         *
         * @since 1.5.0
         */ 
        $wp_customize->add_setting( 'news_preloader_upgrade_ticker',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Upgrade(
            $wp_customize, 'news_preloader_upgrade_ticker',
                array(
                    'priority'      => 200,
                    'section'       => 'news_portal_ticker_section',
                    'settings'      => 'news_preloader_upgrade_ticker',
                    'label'         => __( 'More Features with News Portal Pro', 'news-portal' ),
                    'choices'       => news_portal_upgrade_choices( 'news_portal_ticker' )
                )
            )
        );

        $wp_customize->selective_refresh->add_partial(
            'news_portal_ticker_caption', 
            array(
                'selector' => '.ticker-caption',
                'render_callback' => 'news_portal_customize_partial_ticker_caption',
            )
        );
    }

endif;