<?php

function learningWordPress_resources() {
	
	wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'learningWordPress_resources');



// Get top ancestor
function get_top_ancestor_id() {
	
	global $post;
	
	if ($post->post_parent) {
		$ancestors = array_reverse(get_post_ancestors($post->ID));
		return $ancestors[0];
		
	}
	
	return $post->ID;
	
}

// Does page have children?
function has_children() {
	
	global $post;
	
	$pages = get_pages('child_of=' . $post->ID);
	return count($pages);
	
}

// Customize excerpt word count length
function custom_excerpt_length() {
	return 22;
}

add_filter('excerpt_length', 'custom_excerpt_length');



// Theme setup
function learningWordPress_setup() {
	
	// Navigation Menus
	register_nav_menus(array(
		'primary' => __( 'Primary Menu'),
    'footer' => __( 'Footer Menu' )
	));
	
  // Add logo support
  add_theme_support( 'custom-logo' );

	// Add featured image support
	add_theme_support('post-thumbnails');
	add_image_size('small-thumbnail', 180, 120, true);
	add_image_size('square-thumbnail', 200, 200 ,true);
	add_image_size('banner-image', 1100, 250, array('left', 'top'));

  // Add Shortcodes support
  add_filter('widget_text','do_shortcode');
	
	// Add post type support
	add_theme_support('post-formats', array('aside', 'gallery', 'link'));
}

add_action('after_setup_theme', 'learningWordPress_setup');

// Add Widget Areas
function ourWidgetsInit() {
	
	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar1',
		'before_widget' => '<div class="widget-item">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

add_action('widgets_init', 'ourWidgetsInit');

function wpb_list_child_pages() { 

  global $post; 

  if ( is_page() && $post->post_parent )
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' );

  elseif (is_category())
    while (have_posts()) : the_post();
      echo '<a class="post-sidebar-link" href="';
      echo the_permalink();
      echo '">';
      echo the_title();
      echo '</a>';
    endwhile;
  
  elseif (is_single()) {
    $categories = get_the_category();
    $posts_list = get_posts(array(
      'category' => '5',
      'numberposts' => 10
    ) );

    foreach ($posts_list as $workpost) {
      echo '<a class="post-sidebar-link" href="';
      echo the_permalink($workpost->ID);
      echo '">';
      echo get_the_title($workpost->ID);
      echo '</a>';
    }
  }
  elseif (is_home()) {
    $posts_list = get_posts(array(
      'numberposts' => 50
    ) );

    foreach ($posts_list as $workpost) {
      echo '<a class="post-sidebar-link" href="';
      echo the_permalink($workpost->ID);
      echo '">';
      echo get_the_title($workpost->ID);
      echo '</a>';
    }
  }
  else
    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0' );

  if ( $childpages ) {

    $string = '<ul class="sidebar-menu-pages">' . $childpages . '</ul>';
  }

  return $string;

}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');


function intro_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function intro_add_meta_box() {
	add_meta_box(
		'intro-intro',
		__( 'intro', 'intro' ),
		'intro_html',
		'post',
		'advanced',
		'default'
	);
	add_meta_box(
		'intro-intro',
		__( 'intro', 'intro' ),
		'intro_html',
		'page',
		'advanced',
		'default'
	);
}
add_action( 'add_meta_boxes', 'intro_add_meta_box' );

function intro_html( $post) {
	wp_nonce_field( '_intro_nonce', 'intro_nonce' ); ?>

	<p>Fill in the intro for the page</p>

	<p>
		<textarea style="width: 100%; height: 200px; resize: none;" name="intro_intro" id="intro_intro" ><?php echo intro_get_meta( 'intro_intro' ); ?></textarea>
	
	</p><?php
}

function intro_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['intro_nonce'] ) || ! wp_verify_nonce( $_POST['intro_nonce'], '_intro_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['intro_intro'] ) )
		update_post_meta( $post_id, 'intro_intro', esc_attr( $_POST['intro_intro'] ) );
}
add_action( 'save_post', 'intro_save' );