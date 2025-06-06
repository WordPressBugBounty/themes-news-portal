<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mystery Themes
 * @subpackage News Portal
 * @since 1.0.0
 */

get_header(); ?>

<div class="mt-archive-content-wrapper">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			$news_portal_archive_layout = news_portal_get_customizer_option_value( 'news_portal_archive_layout' );

			while ( have_posts() ) : the_post();

				get_template_part( 'layouts/archive/'. $news_portal_archive_layout );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php news_portal_get_sidebar(); ?>

</div><!-- .mt-archive-content-wrapper -->

<?php
get_footer();