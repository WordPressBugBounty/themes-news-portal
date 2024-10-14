<?php
/**
 * Add extended Global and Categories section and it's fields inside Social icons Section.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'customize_register', 'news_portal_register_social_icons_options' );

if ( ! function_exists( 'news_portal_register_social_icons_options' ) ) :

    /**
     * Register theme options for Social Icons section.
     * 
     * @param WP_Customize_Manager $wp_customize Object that holds the customizer data.
     * @since 1.0.0
     */
    function news_portal_register_social_icons_options( $wp_customize ) {

        /*
         * Failsafe is safe
         */
        if ( ! isset( $wp_customize ) ) {
            return;
        }

        /**
         * Social Icons Section
         *
         * @since 1.0.0
         */
        $wp_customize->add_section(
            'news_portal_social_icons_section',
            array(
                'title'     => esc_html__( 'Social Icons', 'news-portal' ),
                'panel'     => 'news_portal_general_settings_panel',
                'priority'  => 25,
            )
        );

        /**
         * Repeater field for social media icons
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting( 
            'social_media_icons', 
            array(
                'sanitize_callback' => 'news_portal_sanitize_repeater',
                'default' => json_encode(array(
                    array(
                        'social_icon_class' => 'fab fa-facebook-f',
                        'social_icon_url' => '',
                    )
                ))
            )
        );
        $wp_customize->add_control( new News_Portal_Repeater_Controler(
            $wp_customize, 
                'social_media_icons', 
                array(
                    'label'   => __( 'Social Media Icons', 'news-portal' ),
                    'section' => 'news_portal_social_icons_section',
                    'settings' => 'social_media_icons',
                    'priority' => 5,
                    'news_portal_box_label' => __( 'Social Media Icon','news-portal' ),
                    'news_portal_box_add_control' => __( 'Add Icon','news-portal' )
                ),
                array(
                    'social_icon_class' => array(
                        'type'        => 'social_icon',
                        'label'       => __( 'Social Media Logo', 'news-portal' ),
                        'description' => __( 'Choose social media icon.', 'news-portal' )
                    ),
                    'social_icon_url' => array(
                        'type'        => 'url',
                        'label'       => __( 'Social Icon Url', 'news-portal' ),
                        'description' => __( 'Enter social media url.', 'news-portal' )
                    )
                )
            ) 
        );

         /**
         * Upgrade field for social icons
         *
         * @since 1.5.0
         */ 
        $wp_customize->add_setting( 'news_preloader_upgrade_social_icons',
            array(
                'sanitize_callback' => 'sanitize_text_field'
            )
        );
        $wp_customize->add_control( new News_Portal_Control_Upgrade(
            $wp_customize, 'news_preloader_upgrade_social_icons',
                array(
                    'priority'      => 200,
                    'section'       => 'news_portal_social_icons_section',
                    'settings'      => 'news_preloader_upgrade_social_icons',
                    'label'         => __( 'More Features with News Portal Pro', 'news-portal' ),
                    'choices'       => news_portal_upgrade_choices( 'news_portal_social_icon' )
                )
            )
        );
    }

endif;