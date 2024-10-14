<?php
/**
 * Active callback function.
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */

if ( ! function_exists( 'news_portal_has_enable_preloader' ) ) :

	/**
	 * check the setting preloader is enable or not.
	 * 
	 * @since 1.0.0
	 */
	function news_portal_has_enable_preloader( $control ) {
		if ( false !== $control->manager->get_setting( 'news_portal_preloader_option' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

endif;

if ( ! function_exists( 'news_portal_has_enable_header_top_area' ) ) :

	/**
	 * check the setting header top area is enable or not.
	 * 
	 * @since 1.0.0
	 */
	function news_portal_has_enable_header_top_area( $control ) {
		if ( false !== $control->manager->get_setting( 'news_portal_top_header_option' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

endif;

if ( ! function_exists( 'news_portal_has_enable_ticker' ) ) :

	/**
	 * check the setting ticker is enable or not.
	 * 
	 * @since 1.0.0
	 */
	function news_portal_has_enable_ticker( $control ) {
		if ( false !== $control->manager->get_setting( 'news_portal_ticker_option' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

endif;

if ( ! function_exists( 'news_portal_has_enable_related_post' ) ) :

	/**
	 * check the setting related post is enable or not.
	 * 
	 * @since 1.0.0
	 */
	function news_portal_has_enable_related_post( $control ) {
		if ( false !== $control->manager->get_setting( 'news_portal_related_posts_option' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

endif;

if ( ! function_exists( 'news_portal_has_enable_footer_widget' ) ) :

	/**
	 * check the setting footer widget is enable or not.
	 * 
	 * @since 1.0.0
	 */
	function news_portal_has_enable_footer_widget( $control ) {
		if ( false !== $control->manager->get_setting( 'news_portal_footer_widget_option' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

endif;

if ( ! function_exists( 'news_portal_has_enable_site_mode_switcher' ) ) :

	/**
	 * check the setting related post is enable or not.
	 * 
	 * @since 1.5.2
	 */
	function news_portal_has_enable_site_mode_switcher( $control ) {
		if ( false !== $control->manager->get_setting( 'news_portal_site_mode_switcher_option' )->value() ) {
			return false;
		} else {
			return true;
		}
	}

endif;

