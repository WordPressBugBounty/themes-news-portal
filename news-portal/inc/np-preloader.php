<?php
/**
 * File to define functions and hooks related to preloader
 * 
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.5.0
 */


$news_portal_enable_preloader = news_portal_get_customizer_option_value( 'news_portal_preloader_option' );
	
if ( false == $news_portal_enable_preloader ) :
	return;
endif;


if ( ! function_exists( 'news_portal_preloader_items' ) ) :

	/**
	 * function to manage the requested preloader items
	 *
	 * @since 1.0.0
	 */
	function news_portal_preloader_items() {

		$news_portal_preloader =  news_portal_get_customizer_option_value( 'news_portal_preloader_choices' );

		?>
			<div id="news-portal-preloader" class="preloader-background">
				<div class="preloader-wrapper">
					<?php
						switch ( $news_portal_preloader ) {
							case 'three_bounce':
					?>
								<div class="news-portal-three-bounce">
		                            <div class="np-child np-bounce1"></div>
		                            <div class="np-child np-bounce2"></div>
		                            <div class="np-child np-bounce3"></div>
		                        </div>
					<?php
								break;

							case 'wave':
					?>
								<div class="news-portal-wave">
		                            <div class="np-rect np-rect1"></div>
		                            <div class="np-rect np-rect2"></div>
		                            <div class="np-rect np-rect3"></div>
		                            <div class="np-rect np-rect4"></div>
		                            <div class="np-rect np-rect5"></div>
		                        </div>
					<?php
								break;

							case 'folding_cube':
					?>
								<div class="news-portal-folding-cube">
		                            <div class="np-cube1 np-cube"></div>
		                            <div class="np-cube2 np-cube"></div>
		                            <div class="np-cube4 np-cube"></div>
		                            <div class="np-cube3 np-cube"></div>
		                        </div>
					<?php
								break;
						}
					?>
				</div><!-- .preloader-wrapper -->
			</div><!-- #news-portal-preloader -->
	<?php
	}

endif;

add_action( 'news_portal_before_page', 'news_portal_preloader_items', 5 );