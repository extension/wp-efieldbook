<?php
/* Template Name: eXtension Resource Archive  */

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


      <?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

			endwhile; // End of the loop.
      ?>

		</main><!-- #main -->
	</div><!-- #primary -->
  <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
