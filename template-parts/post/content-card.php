<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

$post_activities_term_list = wp_get_post_terms($post->ID, 'dei_activity', array("fields" => "all"));

?>
  <div id="post-<?php the_ID(); ?>" class="card resource-<?php echo $term_list[0]->slug; ?>">
  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">

    <h2><?php the_title(); ?></h2></a>
    <p><?php echo excerpt(24); ?></p>
    <?php

      if ($post_activities_term_list) {
        echo '<div class="resource-post-tags taxonomy-dei_activity clearfix"><h3 class="card-tag-header">Activities</h3>';
        echo '<ul class="resource-tags">';
        foreach($post_activities_term_list as $tag) {
          echo '<li class="resource-tag"><span><a href="' . get_term_link($tag) . '">' . $tag->name . '</a></span></li>';
        }
        echo '</ul></div>';
      }
    ?>
  </div>
