<?php
/**
 * News Portal Theme Customizer
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function news_portal_customize_register( $wp_customize ) {

    /*---------------------------- Override defaults ----------------------*/
    
    $wp_customize->get_section( 'title_tagline' )->priority = 10;
    $wp_customize->get_section( 'title_tagline' )->panel    = 'news_portal_header_settings_panel';

    $wp_customize->get_control( 'background_color' )->priority    = 50;
    $wp_customize->get_control( 'background_color' )->section    = 'news_portal_section_colors_base';

    $wp_customize->get_section( 'background_image' )->priority  = 50;
    $wp_customize->get_section( 'background_image' )->panel     = 'news_portal_general_settings_panel';
    $wp_customize->get_section( 'background_image' )->title     = __( 'Background', 'news-portal' );

     /**
     * Title and tagline checkbox
     *
     * @since 1.0.1
     */
    $wp_customize->add_setting( 
        'news_portal_site_title_option', 
        array(
            'default' => true,
            'sanitize_callback' => 'news_portal_sanitize_checkbox'
        )
    );
    $wp_customize->add_control( 
        'news_portal_site_title_option', 
        array(
            'label'     => esc_html__( 'Display Site Title and Tagline', 'news-portal' ),
            'section'   => 'title_tagline',
            'type'      => 'checkbox'
        )
    );

    /*---------------------------- Register Custom Controls ----------------------*/
    
    // Load/Register control radio image.
    require_once get_template_directory() . '/inc/customizer/custom-controls/radio-image/class-radio-image-control.php';
    $wp_customize->register_control_type( 'News_Portal_Control_Radio_Image' );

    // Load/Register control toggle.
    require_once get_template_directory() . '/inc/customizer/custom-controls/toggle/class-toggle-control.php';
    $wp_customize->register_control_type( 'News_Portal_Control_Toggle' );

    // Load/Register control repeater.
    require_once get_template_directory() . '/inc/customizer/custom-controls/repeater/class-repeater-control.php';

    // Load/Register control heading toggle.
    require_once get_template_directory() . '/inc/customizer/custom-controls/heading-toggle/class-heading-toggle-control.php';
    $wp_customize->register_control_type( 'News_Portal_Control_Heading_Toggle' );

    // Load/Register control upgrade.
    require_once get_template_directory() . '/inc/customizer/custom-controls/upgrade/class-upgrade-control.php';
    $wp_customize->register_control_type( 'News_Portal_Control_Upgrade' );

    // Load/Register control info content.
    require_once get_template_directory() . '/inc/customizer/custom-controls/info-content/class-info-content-control.php';

    // Load/Register control upsell.
    require_once get_template_directory() . '/inc/customizer/custom-controls/upsell/class-upsell-control.php';

    /*---------------------------- Partial refresh ----------------------*/
    
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
    $wp_customize->selective_refresh->add_partial( 
        'blogname', 
        array(
            'selector' => '.site-title a',
            'render_callback' => 'news_portal_customize_partial_blogname',
        )
    );

    $wp_customize->selective_refresh->add_partial( 
        'blogdescription', 
        array(
            'selector' => '.site-description',
            'render_callback' => 'news_portal_customize_partial_blogdescription',
        )
    );

    /**
     * Register custom section types.
     *
     * @since 1.0.6
     */
    $wp_customize->register_section_type( 'News_Portal_Customize_Section_Upsell' );

    /**
     * Register theme upsell sections.
     *
     * @since 1.0.6
     */
    $wp_customize->add_section( new News_Portal_Customize_Section_Upsell(
        $wp_customize, 'theme_upsell',
            array(
                'priority'  => 1,
                'title'     => __( 'News Portal Pro', 'news-portal' ),
                'pro_text'  => __( 'Buy Pro', 'news-portal' ),
                'pro_url'   => 'https://mysterythemes.com/wp-themes/news-portal-pro/'
            )
        )
    );

    /**
     * Add Important theme links Section
     *
     * @since 1.1.0
     */
    $wp_customize->add_section(
        'news_portal_imp_link_section',
        array(
            'title'      => __( 'Important Theme Links', 'news-portal' ),
            'priority'   => 35
        )
    );

    /**
     * Info Content field for Theme
     *
     * @since 1.1.0
     */
    $wp_customize->add_setting(
        'news_portal_imp_links',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new News_Portal_Info_Content(
        $wp_customize, 'news_portal_imp_links',
            array(
                'section'       => 'news_portal_imp_link_section',
                'description'   => '<a class="mt-imp-link" href="https://docs.mysterythemes.com/news-portal/" target="_blank">'.__( 'Documentation', 'news-portal' ).'</a><a class="mt-imp-link" href="https://demo.mysterythemes.com/news-portal-demos/" target="_blank">'.__( 'Live Demos', 'news-portal' ).'</a><a class="mt-imp-link" href="https://www.facebook.com/mysterythemes/" target="_blank">'.__( 'Like Us in Facebook', 'news-portal' ).'</a><a class="mt-imp-link" href="https://wpallresources.com/" target="_blank">'.__( 'WP Tutorials', 'news-portal' ).'</a><a class="mt-imp-link" href="https://mysterythemes.com/wp-themes/news-portal-pro/" target="_blank">'.__( 'Upgrade to Pro', 'news-portal' ).'</a>',
            )
        )
    );

    /**
     * Info Content field for Theme rating
     *
     * @since 1.1.0
     */
    $wp_customize->add_setting(
        'news_portal_rate_us',
        array(
            'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new News_Portal_Info_Content( 
        $wp_customize, 'news_portal_rate_us',
            array(
                'section'       => 'news_portal_imp_link_section',
                'description'   => sprintf(__( 'Please do rate our theme if you liked it %s', 'news-portal' ), '<a class="mt-imp-link" href="https://wordpress.org/support/theme/news-portal/reviews/?filter=5#new-post" target="_blank">Rate/Review</a>' ),
            )
        )
    );

}
add_action( 'customize_register', 'news_portal_customize_register' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function news_portal_customize_preview_js() {
	wp_enqueue_script( 'news_portal_customizer', get_template_directory_uri() . '/inc/customizer/assets/js/np-customizer.js', array( 'customize-preview' ), NEWS_PORTAL_VERSION, true );
}
add_action( 'customize_preview_init', 'news_portal_customize_preview_js' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue required scripts/styles for customizer panel
 *
 * @since 1.0.0
 */
function news_portal_customize_backend_scripts() {

    wp_enqueue_style( 'np-font-awesome', get_template_directory_uri() . '/assets/library/font-awesome/css/all.min.css', array(), '6.5.1' );

    wp_enqueue_style( 'np-extend-customizer', get_template_directory_uri() . '/inc/customizer/assets/css/np-extend-customizer.css', array(), NEWS_PORTAL_VERSION );
    
    wp_enqueue_style( 'news_portal_admin_customizer_style', get_template_directory_uri() . '/inc/customizer/assets/css/np-custom-control-styles.css', array(), NEWS_PORTAL_VERSION );

    wp_enqueue_script( 'np-extend-customizer', get_template_directory_uri(). '/inc/customizer/assets/js/np-extend-customizer.js', array('jquery'), NEWS_PORTAL_VERSION, true );

    wp_enqueue_script( 'news_portal_admin_customizer', get_template_directory_uri() . '/inc/customizer/assets/js/np-customizer-controls.js', array( 'jquery', 'customize-controls' ), NEWS_PORTAL_VERSION, true );

   $upgrade_image_path = get_template_directory_uri() . '/assets/images/';

    wp_localize_script( 'news_portal_admin_customizer', 'npcontrolsJSObject',
        array(
            'imgPath'    => $upgrade_image_path
        )
    );
}
add_action( 'customize_controls_enqueue_scripts', 'news_portal_customize_backend_scripts', 10 );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Load required files for customizer section
 *
 * @since 1.5.0
 */
require get_template_directory() . '/inc/customizer/extend-customizer/class-customize-panel.php';   // Extended Panel
require get_template_directory() . '/inc/customizer/extend-customizer/class-customize-section.php'; // Extended Section
require get_template_directory() . '/inc/customizer/np-register-panels-sections.php';               // Register Panel
require get_template_directory() . '/inc/customizer/np-customizer-helper.php';                      // Customizer helper
require get_template_directory() . '/inc/customizer/np-active-callback.php';                        // Customizer active callback
require get_template_directory() . '/inc/customizer/np-customizer-sanitize.php';                    // Customizer Sanitize
require get_template_directory() . '/inc/customizer/np-customizer-stater.php';                      // Customizer stater

$news_portal_sections_array = array(
    'general'         => array( 'site-style', 'preloader', 'colors', 'social-icons', 'sidebar','template-settings', 'widgets' , 'scroll-top' ),
    'header'          => array( 'top-area', 'header-option', 'ticker' ),
    'innerpage'       => array ( 'archive', 'post' ),
    'footer'          => array( 'main-area', 'bottom-area' )  
);

foreach ( $news_portal_sections_array as $key => $value ) {
    foreach ( $value as $k => $v ) {
        require get_template_directory() . '/inc/customizer/sections/'. $key . '/' . $v .'.php';
    }
}