<?php
/**
 * Add extended Global and Categories section and its fields inside Reading Progress Bar Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.14
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_theme_reading_progress_options' );

if ( ! function_exists( 'news_portal_register_theme_reading_progress_options' ) ) :

    /**
     * Register theme options for reading progress section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.5.14
     */
    function news_portal_register_theme_reading_progress_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Reading Progress Section
         *
         * @since 1.5.14
         */
        $wp_customize->add_section(
            'news_portal_reading_progress_section',
            array(
                'title'     => esc_html__( 'Reading Progress Bar', 'news-portal' ),
                'panel'     => 'news_portal_general_settings_panel',
                'priority'  => 40,
            )
        );

        /**
         * Toggle option for enabling reading progress bar
         *
         * @since 1.5.14
         */
        $wp_customize->add_setting( 'news_portal_reading_progress_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_reading_progress_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_reading_progress_option',
                array(
                    'priority'      => 5,
                    'section'       => 'news_portal_reading_progress_section',
                    'settings'      => 'news_portal_reading_progress_option',
                    'label'         => __( 'Enable Reading Progress Bar', 'news-portal' ),
                    'description'   => __( 'Enable/Disable reading progress bar on single post pages.', 'news-portal' )
                )
            )
        );

        /**
         * Toggle option for reading progress percentage tooltip
         *
         * @since 1.5.14
         */
        $wp_customize->add_setting( 'news_portal_reading_progress_percentage_option',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_reading_progress_percentage_option' ),
                'sanitize_callback' => 'news_portal_sanitize_checkbox'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Toggle(
            $wp_customize, 'news_portal_reading_progress_percentage_option',
                array(
                    'priority'      => 10,
                    'section'       => 'news_portal_reading_progress_section',
                    'settings'      => 'news_portal_reading_progress_percentage_option',
                    'label'         => __( 'Show Percentage Tooltip', 'news-portal' ),
                    'description'   => __( 'Show/Hide percentage tooltip on the progress bar.', 'news-portal' )
                )
            )
        );

        /**
         * Color Picker for Reading Progress Bar Color
         *
         * @since 1.5.14
         */
        $wp_customize->add_setting( 'news_portal_reading_progress_color',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_reading_progress_color' ),
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize, 'news_portal_reading_progress_color',
                array(
                    'priority'   => 15,
                    'section'    => 'news_portal_reading_progress_section',
                    'settings'   => 'news_portal_reading_progress_color',
                    'label'      => __( 'Progress Bar Color', 'news-portal' ),
                    'description'=> __( 'Select custom color for the reading progress bar fill.', 'news-portal' )
                )
            )
        );

        /**
         * Color Picker for Tooltip Text Color
         *
         * @since 1.5.14
         */
        $wp_customize->add_setting( 'news_portal_reading_progress_tooltip_text_color',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_reading_progress_tooltip_text_color' ),
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize, 'news_portal_reading_progress_tooltip_text_color',
                array(
                    'priority'   => 20,
                    'section'    => 'news_portal_reading_progress_section',
                    'settings'   => 'news_portal_reading_progress_tooltip_text_color',
                    'label'      => __( 'Tooltip Text Color', 'news-portal' ),
                    'description'=> __( 'Select custom text color for the percentage tooltip.', 'news-portal' )
                )
            )
        );

        /**
         * Color Picker for Tooltip Background Color
         *
         * @since 1.5.14
         */
        $wp_customize->add_setting( 'news_portal_reading_progress_tooltip_bg_color',
            array(
                'default'           => news_portal_get_customizer_default( 'news_portal_reading_progress_tooltip_bg_color' ),
                'sanitize_callback' => 'sanitize_hex_color',
            )
        );
        $wp_customize->add_control( new WP_Customize_Color_Control(
            $wp_customize, 'news_portal_reading_progress_tooltip_bg_color',
                array(
                    'priority'   => 25,
                    'section'    => 'news_portal_reading_progress_section',
                    'settings'   => 'news_portal_reading_progress_tooltip_bg_color',
                    'label'      => __( 'Tooltip Background Color', 'news-portal' ),
                    'description'=> __( 'Select custom background color for the percentage tooltip.', 'news-portal' )
                )
            )
        );

    }

endif;
