<?php
if ( ! function_exists( 'theme_setup' ) ) {
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which runs
		 * before the init hook. The init hook is too late for some features, such as indicating
		 * support post thumbnails.
		 */
		function theme_setup() {
		 
		    /**
		     * Make theme available for translation.
		     * Translations can be placed in the /languages/ directory.
		     */
		    load_theme_textdomain( 'text_domain', get_template_directory() . '/languages' );
		 
		    /**
		     * Add default posts and comments RSS feed links to <head>.
		     */
		    add_theme_support( 'automatic-feed-links' );
		 
		    /**
		     * Enable support for post thumbnails and featured images.
		     */
		    add_theme_support( 'post-thumbnails' );
		 
		    /**
		     * Add support for two custom navigation menus.
		     */
		    register_nav_menus( array(
		        'primary'   => __( 'Primary Menu', 'text_domain' ),
		        'secondary' => __('Secondary Menu', 'text_domain' )
		    ) );
		 
		    /**
		     * Enable support for the following post formats:
		     * aside, gallery, quote, image, and video
		     */
		    add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
		}
} // theme_setup
add_action( 'after_setup_theme', 'theme_setup' );

function add_theme_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri());
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'./modules/bootstrap-5.2.2-dist/css/bootstrap.css');
    wp_enqueue_script( 'bootstrap',get_template_directory_uri().'./modules/bootstrap-5.2.2-dist/js/bootstrap.js' );
	wp_enqueue_script( 'script', get_template_directory_uri() . './assets/js/main.js', array('jquery'), 1.1, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

add_theme_support( 'custom-logo' );

function wpdocs_theme_slug_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'textdomain' ),
		'id'            => 'footer-widgets',
		'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wpdocs_theme_slug_widgets_init' );

// Our custom post type function
function create_my_custom_post_types() {
 
    register_post_type( 'my_movies',
		    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Movies' ),
                'singular_name' => __( 'Movie' )
            ),
            'public' => true,
            'has_archive' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
            'rewrite' => array('slug' => 'movie'),
            'show_in_rest' => true,
 
        )
    );

	register_post_type( 'my_actors',
		    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Actors' ),
                'singular_name' => __( 'Actor' )
            ),
            'public' => true,
            'has_archive' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
            'rewrite' => array('slug' => 'actor'),
            'show_in_rest' => true,
 
        )
    );

	register_post_type( 'my_directors',
		    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Directors' ),
                'singular_name' => __( 'Director' )
            ),
            'public' => true,
            'has_archive' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
            'rewrite' => array('slug' => 'director'),
            'show_in_rest' => true,
 
        )
    );

	register_taxonomy('my_genres', array('my_movies'), array(
		'labels' => array(
			'name' => __( 'Genres' ),
			'singular_name' => __( 'Genre' )
		),
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_rest' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'genre' ),
  ));

  register_taxonomy('my_years', array('my_movies'), array(
	'labels' => array(
		'name' => __( 'Years' ),
		'singular_name' => __( 'Year' )
	),
	'hierarchical' => true,
	'show_ui' => true,
	'show_in_rest' => true,
	'show_admin_column' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'year' ),
));
}
// Hooking up our function to theme setup
add_action( 'init', 'create_my_custom_post_types' );

add_action( 'mb_relationships_init', function() {
    MB_Relationships_API::register( [
        'id'   => 'movies_to_actors',
        'from' => [
            'post_type' => 'my_movies',
            'meta_box'    => [
                'title' => 'Actors',
            ],
        ],
        'to'   => [
            'post_type'   => 'my_actors',
            'meta_box'    => [
                'title' => 'Movies',
            ],
        ],
    ] );

    MB_Relationships_API::register( [
        'id'   => 'movies_to_directors',
        'from' => [
            'post_type' => 'my_movies',
            'meta_box'    => [
                'title' => 'Directors',
            ],
        ],
        'to'   => [
            'post_type'   => 'my_directors',
            'meta_box'    => [
                'title' => 'Movies',
            ],
        ],
    ] );
} );

function runtime_prettier($movie_length = 0) {
	if($movie_length == 0 || !is_numeric($movie_length)){
      return 'No runtime data';
	  }else if($movie_length == 1){
      return $movie_length.'minute';
	  }else if($movie_length>1 && $movie_length < 60){
	  return $movie_length.'minute';
	  }else{
		$hours = floor($movie_length / 60);
		$minutes = $movie_length % 60;
		return $hours.(($hours == 1)? ' hour ':' hours ').$minutes.(($minutes==1)? ' minute':' minutes');
	  }   
}

function check_old_movie($year  = 0){
    if($year<(date('Y')-40) && $year > 0){
        return date('Y')-$year; 
    }else{
        return false;
    }
}

function my_excerpt_length($length){return 15; } 

add_filter('excerpt_length', 'my_excerpt_length');

function new_excerpt_more($more) {
    return '...';
}

add_filter('excerpt_more', 'new_excerpt_more');

function my_custom_mail_sent(){
     setcookie('form_submitted', 'true', time() + (86400 * 30));
}

add_action('wpcf7_mail_sent', 'my_custom_mail_sent' );

function foo_modify_query_order( $query ) {
    if( $query->is_archive()){
        $query->set( 'orderby', 'title');
        $query->set( 'order', 'ASC' );
    }
}
add_action( 'pre_get_posts', 'foo_modify_query_order' );
