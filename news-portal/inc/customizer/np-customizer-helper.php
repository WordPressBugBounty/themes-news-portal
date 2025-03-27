<?php
/**
 * Customizer helper where define functions related to customizer panel, sections and settings.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*---------------------- General Panel Choices ----------------------------- --*/
    
    if ( ! function_exists( 'news_portal_site_layout_choices' ) ) :

        /**
         * function to return choices of site layout.
         *
         * @since 1.5.0
         */
        function news_portal_site_layout_choices() {

            $site_layout_choices = apply_filters( 'news_portal_site_layout_choices',
                array(
                    'fullwidth_layout'  => array(
                        'title' => __( 'Full Width', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/full-width.png'
                    ),
                    'boxed_layout'      => array(
                        'title' => __( 'Boxed', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/boxed.png'
                    )
                )
            );

            return $site_layout_choices;

        }

    endif;

/*---------------------- Preloader Choices ----------------------------- --*/


    if ( ! function_exists( 'news_portal_preloader_style_choices' ) ) :

        /**
         * function to return choices for preloader styles.
         *
         * @since 1.0.0
         */
        function news_portal_preloader_style_choices() {

            $preloader_choices = apply_filters( 'news_portal_preloader_style_choices',
                array(
                    'three_bounce'    => array(
                        'title'     => __( 'Style 1', 'news-portal' ),
                        'src'       => get_template_directory_uri() . '/assets/images/three-bounce-preloader.gif'
                    ),
                    'wave'         => array(
                        'title'     => __( 'Style 2', 'news-portal' ),
                        'src'       => get_template_directory_uri() . '/assets/images/wave-preloader.gif'
                    ),
                    'folding_cube'         => array(
                        'title'     => __( 'Style 3', 'news-portal' ),
                        'src'       => get_template_directory_uri() . '/assets/images/folding-cube-preloader.gif'
                    ),
                )
            );

            return $preloader_choices;

        }

    endif;

/*----------------------Sidebar Layout Choices -------------------------------*/

    if ( ! function_exists( 'news_portal_sidebar_layout_choices' ) ) :

        /**
         * function to return choices of sidebar layout.
         *
         * @since 1.5.0
         */
        function news_portal_sidebar_layout_choices() {

            $sidebar_layout_choices = apply_filters( 'news_portal_sidebar_layout_choices',
               array(
                    'left_sidebar' => array(
                        'title' => esc_html__( 'Left Sidebar', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/left-sidebar.png'
                    ),
                    'right_sidebar' => array(
                        'title' => esc_html__( 'Right Sidebar', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/right-sidebar.png'
                    ),
                    'no_sidebar' => array(
                        'title' => esc_html__( 'No Sidebar', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/no-sidebar.png'
                    ),
                    'no_sidebar_center' => array(
                        'title' => esc_html__( 'No Sidebar Center', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/no-sidebar-center.png'
                    )
                )
            );

            return $sidebar_layout_choices;

        }

    endif;

/*----------------------Archive Layout Choices -------------------------------*/

    if ( ! function_exists( 'news_portal_archive_layout_choices' ) ) :

        /**
         * function to return choices of archive layout.
         *
         * @since 1.5.0
         */
        function news_portal_archive_layout_choices() {

            $archive_layout_choices = apply_filters( 'news_portal_archive_layout_choices',
                array(
                   'classic' => array(
                        'title' => esc_html__( 'Classic', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/archive-layout1.png'
                    ),
                    'grid' => array(
                        'title' => esc_html__( 'Grid', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/archive-layout2.png'
                    ),
                    'list' => array(
                        'title' => esc_html__( 'List', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/archive-layout3.png'
                    )
                )
            );

            return $archive_layout_choices;

        }

    endif;

/*----------------------Footer Widget Layout Choices -------------------------------*/

    if ( ! function_exists( 'news_portal_footer_widget_layout_choices' ) ) :

        /**
         * function to return choices of archive layout.
         *
         * @since 1.5.0
         */
        function news_portal_footer_widget_layout_choices() {

            $footer_layout_choices = apply_filters( 'news_portal_footer_widget_layout_choices',
                array(
                    'column_four' => array(
                        'title' => esc_html__( 'Columns Four', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/footer-4.png'
                    ),
                    'column_three' => array(
                        'title' => esc_html__( 'Columns Three', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/footer-3.png'
                    ),
                    'column_two' => array(
                        'title' => esc_html__( 'Columns Two', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/footer-2.png'
                    ),
                    'column_one' => array(
                        'title' => esc_html__( 'Column One', 'news-portal' ),
                        'src'   => get_template_directory_uri() . '/assets/images/footer-1.png'
                    )
                )
            );

            return $footer_layout_choices;

        }

    endif;


/*---------------------------------- Upgrade Control Choices -----------------------------------*/
    
    if ( ! function_exists( 'news_portal_upgrade_choices' ) ) :

        /**
         * function to return choices for upgrade to pro.
         *
         * @since 1.5.0
         */
        function news_portal_upgrade_choices( $setting_id ) {

            $upgrade_info_lists = array(
                'preloader'     => array( __( "10+ Preloader Styles", 'news-portal' ) ),
                'social_icon'   => array( __( 'Add unlimited social icons field.', 'news-portal' ) ),
                'widget_setting'=> array( __( '10+ Widgets', 'news-portal' ), __( 'Post Format Option', 'news-portal' ), __( 'Post Date Option', 'news-portal' ), __( 'Post Author Option', 'news-portal' ), __( 'Post Comment Option', 'news-portal' ), __( 'Post Review Option', 'news-portal' ) ),
                'header_options'=> array( __( "2 More Layouts", 'news-portal' ), __( 'Button on Menu', 'news-portal' ), __( 'Shadow Option on Menu', 'news-portal' ), ),
                'ticker'       => array( __( "1 More Layouts", 'news-portal' ), __( 'Content Type Options', 'news-portal' ), __( 'Adjustable Post Count Option', 'news-portal' ) ),
                'archive_page' =>  array( __( "2 More Layouts", 'news-portal' ), __( 'Custom 404 Page', 'news-portal' ) ),
                'single_page' =>  array( __( "4 Layouts", 'news-portal' ), __( 'Post Review Option', 'news-portal' ), __( 'Author Option', 'news-portal' ), __( 'Post View Option', 'news-portal' ), ),
                'footer_area'  => array( __( 'Background Options', 'news-portal' ) ),
                'bottom_area' =>  array( __( "2 Sub Footer Layouts", 'news-portal' ) ),
            );

            $setting_id = explode( 'news_portal_', $setting_id );
            $setting_id = $setting_id[1];

            return $upgrade_info_lists[$setting_id];

        }

    endif;