<?php
/**
 * Includes theme customizer defaults and starter functions.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'news_portal_get_customizer_option_value' ) ) :

    /**
     * Get the customizer value `get_theme_mod()`
     * 
     * @since 1.5.0
     */
    function news_portal_get_customizer_option_value( $setting_id ) {

        return get_theme_mod( $setting_id, news_portal_get_customizer_default( $setting_id ) );

    }

endif;

if ( ! function_exists( 'news_portal_get_customizer_default' ) ) :

    /**
     * Returns an array of the desired default News portal Options
     *
     * @return array
     */
    function news_portal_get_customizer_default( $setting_id ) {

        $default_values = apply_filters( 'news_portal_get_customizer_defaults',
            array(
                //site layout
                'news_portal_site_layout'               => 'fullwidth_layout',
                'news_portal_site_mode_switcher_option' => true,
                'news_portal_dark_mode_option'          => false,

                //preloader
                'news_portal_preloader_option'          => false,
                'news_portal_preloader_choices'         => 'three_bounce',

                //colors
                'news_portal_theme_color'               => '#029FB2',
                'news_portal_site_title_color'          => '#029FB2',

                //social icons
                'social_media_icons'                    => '',

                //sidebar
                'news_portal_front_sidebar_sticky_option' => true,
                'news_portal_inner_sidebar_sticky_option' => true,
                'news_portal_archive_sidebar'             => 'right_sidebar',
                'news_portal_default_page_sidebar'        => 'right_sidebar',
                'news_portal_default_post_sidebar'        => 'right_sidebar',

                //scroll top 
                'news_portal_scroll_top_option'           => true,

                //widget settings
                'news_portal_widget_cat_link_option'      => true,
                'news_portal_widget_cat_color_option'     => true,

                //template settings
                'news_portal_home_template_content_option'      => true,
                'np_block_base_widget_editor_option'            => true,

                //top header section
                'news_portal_top_header_option'            => true,
                'news_portal_top_date_option'              => true,
                'news_portal_top_social_option'            => true,

                //header option
                'news_portal_menu_sticky_option'           => true,
                'news_portal_home_icon_option'             => true,
                'news_portal_search_icon_option'           => true,

                //ticker
                'news_portal_ticker_option'                => true,
                'news_portal_ticker_caption'               => 'Breaking News',

                //Archive settings
                'news_portal_archive_layout'               => 'classic',
                'news_portal_archive_read_more_text'       => 'Continue Reading',

                //Post Settings
                'news_portal_related_posts_option'         => true,
                'news_portal_related_posts_title'          => 'Related Posts',

                //Footer Widget Area
                'news_portal_footer_widget_option'         => true,
                'footer_widget_layout'                     => 'column_three',

                //Footer Bottom Section
                'news_portal_copyright_text'               => '',

            )
        );

        return  $default_values[$setting_id];

    }

endif;