<!-- shortcode format: [extension_resource_cards] -->

<?php
  $args = array(
      'posts_per_page' => 100,
      'post_type' => 'extension_resource',
      'orderby'=> 'title', 'order' => 'ASC'
  );
  $post_query = new WP_Query($args);
  if($post_query->have_posts()) {
    echo '<div class="flex-container">';
    while($post_query->have_posts()) {
      $post_query->the_post();
      get_template_part( 'template-parts/post/content', 'card' );
    }
    echo '</div>';
    wp_reset_postdata();
  }
?>
