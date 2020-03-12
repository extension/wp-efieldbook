<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<!-- child / taxonomy.php -->
<div id="taxonomy" class="wrap content-wrap">

	<?php if ( have_posts() ) : ?>
		<header class="page-header">
      <div class="taxonomy-archive-header">

			<?php
      $tax = get_taxonomy( get_queried_object()->taxonomy );
      $term = get_queried_object();
      // echo $term->name;

      $parents = get_ancestors($term->term_id, 'md_addiction');
      $parents = array_reverse($parents);
      // print_r($parents);

      echo '<h1 class="archive-page-title">';
      echo $tax->labels->singular_name;
      foreach($parents as $parent) {
        $foo = get_term( $parent);
        echo ' > ' . $foo->name;
      }
      echo ":</h1><h2>";
		  echo single_term_title();
      echo "</h2>";
				// the_archive_title( '<h1 class="archive-page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
      </div>
		</header><!-- .page-header -->
	<?php endif; ?>
<?php get_sidebar( 'header-branding' ); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

    <div class="flex-container">
		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', 'card' );

			endwhile;

			the_posts_pagination( array(
				'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
			) );

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>
      </div> <!-- .flex-container -->
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
