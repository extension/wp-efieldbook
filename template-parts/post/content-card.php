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
?>
<div id="post-<?php the_ID(); ?>" class="card resource-<?php echo $term_list[0]->slug; ?>">
  <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
    <h2><?php the_title(); ?></h2>
  </a>
  <p><?php echo excerpt(24); ?></p>
    <?php
    $tax = get_taxonomy( get_queried_object()->taxonomy );
    $term = get_queried_object();
    $id = get_the_ID();
    $args = array(
    'public'   => true,
    '_builtin' => false
    );
    $pods_colors = array();
    $i = 1;
    $output = 'objects'; // or objects
    $operator = 'and'; // 'and' or 'or'
    $taxonomies = get_taxonomies( $args, $output, $operator );
    // map the taxonomy name to a numeric value
    if ( $taxonomies ) {
      foreach ( $taxonomies  as $taxonomy ) {
          $pods_colors[$taxonomy->name] = $i;
          $i++;
      }
    }
    $n = 1;
    foreach ($taxonomies as $taxonomy) {
      if($n > 2)
        break;
      $term_list = wp_get_post_terms($post->ID, $taxonomy->name, array("fields" => "all"));
      if ((!empty($term_list)) && (!is_wp_error($term_list))) {
        $myArray = [];
        echo '<div class="taxonomy-taxonomy taxonomy-taxonomy' . $pods_colors[$taxonomy->name] . ' resource-post-tags clearfix"><h3 class="card-tag-header">' . $taxonomy->labels->singular_name . ':</h3>';
        echo '<ul class="resource-tags">';
        foreach($term_list as $term) {
          $parents = get_ancestors($term->term_id, $taxonomy );
          $parents = array_reverse($parents);
          array_push($parents, $term->term_id);
          $myArray = array_merge($myArray, $parents);
          $myArray = array_unique($myArray);
        }
        array_unique($myArray);
        foreach($myArray as $parent) {
          $foo = get_term( $parent);
          echo '<li class="resource-tag"><span><a href="' . get_term_link($foo) . '">' . $foo->name . '</a></span></li>';
        }
        echo "</ul>";
        echo '</div>';
        $n++;
      }
    }
    ?>
</div>
