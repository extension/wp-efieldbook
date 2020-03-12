<?php


function my_theme_enqueue_styles() {

    $parent_style = 'twentyseventeen-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


function categorize_page_settings() {
  // Add category metabox to page
  register_taxonomy_for_object_type('category', 'page');
}
add_action( 'init', 'categorize_page_settings' );


function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/[.+]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}


function list_terms_custom_taxonomy( $atts ) {

  extract( shortcode_atts( array(
    'custom_taxonomy' => ''
  ), $atts ) );

  // arguments for function wp_list_categories
  $args = array(
    taxonomy => $custom_taxonomy,
    title_li => ''
  );
  ob_start();
  $output .= '<ul>';
  $output .= wp_list_categories($args);
  $output .= '</ul>';
  $output .= ob_get_clean();
  return $output;
}
add_shortcode( 'ct_terms', 'list_terms_custom_taxonomy' );

function card_gallery_func( $atts ) {
  $a = shortcode_atts( array(
    'key' => '',
    'tags' => '',
    'limit' => '5',
    'match_all_tags' => false,
    'event_type' => 'upcoming'
  ), $atts );
  $a['operator'] = ($a['match_all_tags'] == "true" ? "and" : '');
  ob_start();
  include(locate_template('card-gallery.php'));
  return ob_get_clean();
}

add_shortcode( 'extension_resource_cards', 'card_gallery_func' );

add_action( 'widgets_init', 'register_custom_sidebars' );
function  register_custom_sidebars() {
	register_sidebar(
		array(
      'name' => 'Header Branding ',
      'id' => 'sidebar-header-branding',
			'description' => 'A widget area for branding below the masthead and navigation',
      'before_widget' => '<div class="header-branding-item %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>'
		)
	);
}
?>
