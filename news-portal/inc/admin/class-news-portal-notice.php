<?php
/**
 * News Portal main admin class
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'News_Portal_Notice' ) ) :

    /**
     * Class News_Portal_Admin_Main
     */
    class News_Portal_Notice {
        
    	public $theme_screenshot;
        public $theme_name;

        /**
         * news-portal- Notice constructor.
         */
        public function __construct() {

            global $admin_main_class;

            add_action( 'admin_enqueue_scripts', array( $this, 'news_portal_enqueue_scripts' ) );

            add_action( 'wp_loaded', array( $this, 'news_portal_hide_welcome_notices' ) );
            add_action( 'wp_loaded', array( $this, 'news_portal_welcome_notice' ) ); 

            add_action( 'wp_ajax_news_portal_activate_plugin', array( $admin_main_class, 'news_portal_activate_demo_importer_plugin' ) );
            add_action( 'wp_ajax_news_portal_install_plugin', array( $admin_main_class, 'news_portal_install_demo_importer_plugin' ) );

            add_action( 'wp_ajax_news_portal_install_free_plugin', array( $admin_main_class, 'news_portal_install_free_plugin' ) );
            add_action( 'wp_ajax_news_portal_activate_free_plugin', array( $admin_main_class, 'news_portal_activate_free_plugin' ) );

            //theme details
            $theme = wp_get_theme();

            if ( ! is_child_theme() ) {
                $this->theme_screenshot =  get_template_directory_uri()."/screenshot.png";
            } else {
                $this->theme_screenshot =  get_stylesheet_directory_uri()."/screenshot.png";
            }

            $this->theme_name = $theme->get( 'Name' );
        }

        /**
         * Localize array for import button AJAX request.
         */
        public function news_portal_enqueue_scripts() {
            wp_enqueue_style( 'news-portal-admin-style', get_template_directory_uri() . '/inc/admin/assets/css/admin.css', array(), NEWS_PORTAL_VERSION );

            wp_enqueue_script( 'news-portal-plugin-install-helper', get_template_directory_uri() . '/inc/admin/assets/js/plugin-handle.js', array( 'jquery' ), NEWS_PORTAL_VERSION );

            $demo_importer_plugin = WP_PLUGIN_DIR . '/mysterythemes-demo-importer/mysterythemes-demo-importer.php';
            if ( ! file_exists( $demo_importer_plugin ) ) {
                $action = 'install';
            } elseif ( file_exists( $demo_importer_plugin ) && !is_plugin_active( 'mysterythemes-demo-importer/mysterythemes-demo-importer.php' ) ) {
                $action = 'activate';
            } else {
                $action = 'redirect';
            }

            wp_localize_script( 'news-portal-plugin-install-helper', 'mtAdminObject',
                array(
                    'ajax_url'      => esc_url( admin_url( 'admin-ajax.php' ) ),
                    '_wpnonce'      => wp_create_nonce( 'news_portal_plugin_install_nonce' ),
                    'buttonStatus'  => esc_html( $action )
                )
            );
        }

        /**
         * Add admin welcome notice.
         */
        public function news_portal_welcome_notice() {

            if ( isset( $_GET['activated'] ) ) {
                update_option( 'news_portal_admin_notice_welcome', true );
            }

            $welcome_notice_option = get_option( 'news_portal_admin_notice_welcome' );

            // Let's bail on theme activation.
            if ( $welcome_notice_option ) {
                add_action( 'admin_notices', array( $this, 'news_portal_welcome_notice_html' ) );
            }
        }

        /**
         * Hide a notice if the GET variable is set.
         */
        public static function news_portal_hide_welcome_notices() {
            if ( isset( $_GET['news-portal-hide-welcome-notice'] ) && isset( $_GET['_news_portal_welcome_notice_nonce'] ) ) {
                if ( ! wp_verify_nonce( $_GET['_news_portal_welcome_notice_nonce'], 'news_portal_hide_welcome_notices_nonce' ) ) {
                    wp_die( esc_html__( 'Action failed. Please refresh the page and retry.', 'news-portal' ) );
                }

                if ( ! current_user_can( 'manage_options' ) ) {
                    wp_die( esc_html__( 'Cheat in &#8217; huh?', 'news-portal' ) );
                }

                $hide_notice = sanitize_text_field( $_GET['news-portal-hide-welcome-notice'] );
                update_option( 'news_portal_admin_notice_' . $hide_notice, false );
            }
        }

        /**
         * function to display welcome notice section
         */
        public function news_portal_welcome_notice_html() {
            $current_screen = get_current_screen();

            if ( $current_screen->id !== 'dashboard' && $current_screen->id !== 'themes' ) {
                return;
            }
            ?>
            <div id="news-portal-welcome-notice" class="news-portal-welcome-notice-wrapper updated notice">
                <a class="news-portal-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'news-portal-hide-welcome-notice', 'welcome' ) ), 'news_portal_hide_welcome_notices_nonce', '_news_portal_welcome_notice_nonce' ) ); ?>">
                    <span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'news-portal' ); ?>
                </a>

                <div class="welcome-notice-details-wrapper">
                    <div class="notice-detail-wrap general">
                        <div class="general-info-wrap">
                            <h2 class="general-title wrap-title"><?php printf( esc_html__( 'Congratulation! Welcome to %1$s', 'news-portal' ), $this->theme_name ); ?></h2>
                            <div class="general-content wrap-content">
                                <?php
                                    printf( wp_kses_post( 'All the fantastic features of <b>%1$s</b> are now at your disposal.
                                    Our theme has been successfully installed and is ready to use, offering a range of various powerful features for your website.
                                    To begin, click on the  <b>Get Started</b> button to install the <b>Mystery Themes Demo Importer </b> Plugin and quickly access the theme settings page. Alternatively, you can directly click on <b>Customize your site</b> to quickly begin the customization of your website. Thank you for choosing us and being part of our community.!', 'news-portal' ), $this->theme_name );
                                ?>
                            </div><!-- .wrap-content -->
                        </div><!-- .general-info-wrap -->

                        <div class="general-info-links">
                            <div class="buttons-wrap">
                                 <button class="news-portal-get-started button button-primary button-hero" data-done="<?php esc_attr_e( 'Done!', 'news-portal' ); ?>" data-process="<?php esc_attr_e( 'Processing', 'news-portal' ); ?>" data-redirect="<?php echo esc_url( wp_nonce_url( add_query_arg( 'news-portal-hide-welcome-notice', 'welcome', admin_url( 'themes.php' ).'?page=news-portal-dashboard&tab=starter' ) , 'news_portal_hide_welcome_notices_nonce', '_news_portal_welcome_notice_nonce' ) ); ?>">
                                    <?php printf( esc_html__( 'Get started with %1$s', 'news-portal' ), esc_html( $this->theme_name ) ); ?>
                                 </button>
                                    <a class="button button-hero" href="<?php echo esc_url( wp_customize_url() ); ?>">
                                        <?php esc_html_e( 'Customize your site', 'news-portal' ); ?>
                                    </a>

                                    <a class="button button-hero" target="_blank" rel="external noopener noreferrer" href="https://mysterythemes.com/wp-themes/news-portal"><span class="screen-reader-text"><?php esc_html_e( 'opens in a new tab', 'news-portal' ); ?></span><svg xmlns="http://www.w3.org/2000/svg" focusable="false" role="img" viewBox="0 0 512 512" width="12" height="12" style="margin-right: 5px;"><path fill="currentColor" d="M432 320H400a16 16 0 0 0-16 16V448H64V128H208a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16H48A48 48 0 0 0 0 112V464a48 48 0 0 0 48 48H400a48 48 0 0 0 48-48V336A16 16 0 0 0 432 320ZM488 0h-128c-21.4 0-32 25.9-17 41l35.7 35.7L135 320.4a24 24 0 0 0 0 34L157.7 377a24 24 0 0 0 34 0L435.3 133.3 471 169c15 15 41 4.5 41-17V24A24 24 0 0 0 488 0Z"></path></svg><?php esc_html_e( 'Stater Sites', 'news-portal' ); ?></a>

                                    <a class="button button-hero" target="_blank" rel="external noopener noreferrer" href="https://docs.mysterythemes.com/news-portal"><span class="screen-reader-text"><?php esc_html_e( 'opens in a new tab', 'news-portal' ); ?></span><svg xmlns="http://www.w3.org/2000/svg" focusable="false" role="img" viewBox="0 0 512 512" width="12" height="12" style="margin-right: 5px;"><path fill="currentColor" d="M432 320H400a16 16 0 0 0-16 16V448H64V128H208a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16H48A48 48 0 0 0 0 112V464a48 48 0 0 0 48 48H400a48 48 0 0 0 48-48V336A16 16 0 0 0 432 320ZM488 0h-128c-21.4 0-32 25.9-17 41l35.7 35.7L135 320.4a24 24 0 0 0 0 34L157.7 377a24 24 0 0 0 34 0L435.3 133.3 471 169c15 15 41 4.5 41-17V24A24 24 0 0 0 488 0Z"></path></svg><?php esc_html_e( 'Read full documentation', 'news-portal' ); ?></a>
                            </div><!-- .buttons-wrap -->
                        </div><!-- .general-info-links -->
                    </div><!-- .notice-detail-wrap.general -->
                    <div class="notice-detail-wrap image">
                        <figure> <img src="<?php echo esc_url( $this->theme_screenshot ); ?>"> </figure>
                    </div><!-- .notice-detail-wrap.image -->
                </div><!-- .welcome-notice-details-wrapper -->
            </div><!-- .news-portal-welcome-notice-wrapper -->
<?php
    }

}
    new News_Portal_Notice();

endif;