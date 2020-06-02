<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php
  $custom_fields = get_post_custom();
  $my_custom_field = $custom_fields['gain_attention'];
  if ((!empty($my_custom_field[0])) && (!is_wp_error($my_custom_field[0]))) { ?>
    <div id="gain_attention">
      <?php echo $my_custom_field[0]; ?>
    </div>
<?php } ?>

<div class="wrap content-wrap">
  <?php get_sidebar( 'header-branding' ); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<!-- eFieldbook Base child / page.php -->
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
  <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
