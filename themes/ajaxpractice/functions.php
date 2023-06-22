<?php
/**
 * AJAX Practice functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AJAX_Practice
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ajaxpractice_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on AJAX Practice, use a find and replace
		* to change 'ajaxpractice' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ajaxpractice', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'ajaxpractice' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'ajaxpractice_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'ajaxpractice_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ajaxpractice_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ajaxpractice_content_width', 640 );
}
add_action( 'after_setup_theme', 'ajaxpractice_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ajaxpractice_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ajaxpractice' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ajaxpractice' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ajaxpractice_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ajaxpractice_scripts() {
	wp_enqueue_style( 'ajaxpractice-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'ajaxpractice-style', 'rtl', 'replace' );

	wp_enqueue_script( 'ajaxpractice-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	if( is_page( 'rest-api' ) ){
		wp_enqueue_script( 'ajaxpractice-rest-api-script', get_template_directory_uri() . '/assets/js/script-rest-api.js', array(), _S_VERSION, true );
	}
	if( is_page( 'single-post' ) ){
		wp_enqueue_script( 'ajaxpractice-rest-api-script', get_template_directory_uri() . '/assets/js/single-post.js', array(), _S_VERSION, true );
	}
	if( is_page( 'googlemapsapi' ) ){
		wp_enqueue_script( 'ajaxpractice-rest-api-script', get_template_directory_uri() . '/assets/js/google-maps-api.js', array(), _S_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ajaxpractice_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* Add taxonomy category for custom post type products */

function add_tax_products_categories(){
	$labels = array(
            'name' => _x( 'Products Categories', 'taxonomy general name' ),
            'singular_name' => _x( 'Product Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Products Categories' ),
            'popular_items' => __( 'Popular Products Categories' ),
            'all_items' => __( 'All Products Categories' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit Product Category' ), 
            'update_item' => __( 'Update Product Category' ),
            'add_new_item' => __( 'Add New Product Category' ),
            'new_item_name' => __( 'New Product Category Name' ),
            'separate_items_with_commas' => __( 'Separate Product Category with commas' ),
            'add_or_remove_items' => __( 'Add or remove Product Category' ),
            'choose_from_most_used' => __( 'Choose from the most used Product Category' ),
            'menu_name' => __( 'Products Categories' ),
          ); 
         
        // Now register the non-hierarchical taxonomy like tag
         
          register_taxonomy('products-categories','products',array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => false,
						'rewrite' => array('slug' => 'products'),
          ));
}
add_action( 'init', 'add_tax_products_categories' );

/* Add taxonomy color for custom post type products */

function add_tax_products_colors(){
	$labels = array(
            'name' => _x( 'Products Colors', 'taxonomy general name' ),
            'singular_name' => _x( 'Product Color', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Products Colors' ),
            'popular_items' => __( 'Popular Products Colors' ),
            'all_items' => __( 'All Products Colors' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit Product Color' ), 
            'update_item' => __( 'Update Product Color' ),
            'add_new_item' => __( 'Add New Product Color' ),
            'new_item_name' => __( 'New Product Color Name' ),
            'separate_items_with_commas' => __( 'Separate Product Color with commas' ),
            'add_or_remove_items' => __( 'Add or remove Product Color' ),
            'choose_from_most_used' => __( 'Choose from the most used Product Color' ),
            'menu_name' => __( 'Products Colors' ),
          ); 
         
        // Now register the non-hierarchical taxonomy like tag
         
          register_taxonomy('products-color','products',array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => false,
						'rewrite' => array('slug' => 'products'),
          ));
}
add_action( 'init', 'add_tax_products_colors' );

/* Add taxonomy size for custom post type products */

function add_tax_products_sizes(){
	$labels = array(
            'name' => _x( 'Products Sizes', 'taxonomy general name' ),
            'singular_name' => _x( 'Product Size', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Products Sizes' ),
            'popular_items' => __( 'Popular Products Sizes' ),
            'all_items' => __( 'All Products Sizes' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit Product Size' ), 
            'update_item' => __( 'Update Product Size' ),
            'add_new_item' => __( 'Add New Product Size' ),
            'new_item_name' => __( 'New Product Size Name' ),
            'separate_items_with_commas' => __( 'Separate Product Size with commas' ),
            'add_or_remove_items' => __( 'Add or remove Product Size' ),
            'choose_from_most_used' => __( 'Choose from the most used Product Size' ),
            'menu_name' => __( 'Products Sizes' ),
          ); 
         
        // Now register the non-hierarchical taxonomy like tag
         
          register_taxonomy('products-size','products',array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => false,
						'rewrite' => array('slug' => 'products'),
          ));
}
add_action( 'init', 'add_tax_products_sizes' );

/* Add taxonomy sex for custom post type products */

function add_tax_products_sex(){
	$labels = array(
            'name' => _x( 'Products Sex', 'taxonomy general name' ),
            'singular_name' => _x( 'Product Sex', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Products Sex' ),
            'popular_items' => __( 'Popular Products Sex' ),
            'all_items' => __( 'All Products Sex' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit Product Sex' ), 
            'update_item' => __( 'Update Product Sex' ),
            'add_new_item' => __( 'Add New Product Sex' ),
            'new_item_name' => __( 'New Product Sex Name' ),
            'separate_items_with_commas' => __( 'Separate Product Sex with commas' ),
            'add_or_remove_items' => __( 'Add or remove Product Sex' ),
            'choose_from_most_used' => __( 'Choose from the most used Product Sex' ),
            'menu_name' => __( 'Products Sex' ),
          ); 
         
        // Now register the non-hierarchical taxonomy like tag
         
          register_taxonomy('products-sex','products',array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => false,
						'rewrite' => array('slug' => 'products-sex'),
          ));
}
add_action( 'init', 'add_tax_products_sex' );

/* Add custom post type products */

function create_posttype_products() {
  
	register_post_type( 'products',
	
			array(
					'labels' => array(
							'name' => __( 'Products' ),
							'singular_name' => __( 'Product' ),
							'add_new_item' => 'Add New Product',
							'new_item' => 'New Product',
					),
					'public' => true,
					'hierarchical' => true,
					'show_in_menu ' => true,
					'show_in_nav_menus' => true,
					'show_in_admin_bar' => true,
 					'has_archive' => false,
					'rewrite' => array('slug' => 'product'),
					'show_in_rest' => true,
					'taxonomies' => array('products-categories'),
					'menu_icon' => 'dashicons-hammer'

			)
	);
}
add_action( 'init', 'create_posttype_products'  );

/* Add thumbnail for custom post type products */

add_post_type_support( 'products', 'thumbnail' );


/* Load more products */
add_action( 'wp_enqueue_scripts', 'load_more_products_localize_script');

function load_more_products_localize_script() {
	global $wp_query;

	wp_register_script( 'load_more_products_scripts', get_stylesheet_directory_uri() . '/assets/js/load_more.js', array('jquery') );
 
	wp_localize_script( 'load_more_products_scripts', 'loadmore_products_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'load_more_products_scripts' );
}

add_action('wp_ajax_loadmorebutton', 'loadmore_product_ajax_handler');
add_action('wp_ajax_nopriv_loadmorebutton', 'loadmore_product_ajax_handler');
 
function loadmore_product_ajax_handler(){

	$args = json_decode( stripslashes( $_POST['query'] ), true );

	$args = array(
		'posts_per_page' => 4,
		'paged' => $_POST['page'] + 1,
		'post_status' => 'publish',
		'post_type' => 'products',
		'orderby ' => 'name',
		'order' => $_POST['sortByName'],
	);

	$tax_query = array( 'relation' => 'AND' );
	if ($_POST['productCategory'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-categories',
			'field' => 'slug',
			'terms' => $_POST['productCategory'],
		);

		$args[ 'tax_query' ] = $tax_query;
	}
	if ($_POST['productSex'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-sex',
			'field' => 'slug',
			'terms' => $_POST['productSex'],
		);
		$args[ 'tax_query' ] = $tax_query;
	}
	if ($_POST['productColor'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-color',
			'field' => 'slug',
			'terms' => $_POST['productColor'],
		);
		$args[ 'tax_query' ] = $tax_query;
	}
	if ($_POST['productSize'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-size',
			'field' => 'slug',
			'terms' => $_POST['productSize'],
		);
		$args[ 'tax_query' ] = $tax_query;
	}
	if (!empty($_POST['productSearch'])) {
		$args['s'] = $_POST['productSearch'];
	}

	$wp_query = new WP_Query($args);
 
	if( $wp_query->have_posts() ) :

		ob_start();
 
		while( $wp_query->have_posts() ): $wp_query->the_post();
				
		include "template-parts/templates/product_card.php";
	
		endwhile;

		$posts_html = ob_get_contents();
   	ob_end_clean();

	endif;

	echo json_encode( array(
		'posts' => json_encode( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $posts_html,
	) );

	die();
}

/* Filter products */

add_action('wp_ajax_filters', 'filters_ajax_handler');
add_action('wp_ajax_nopriv_filters', 'filters_ajax_handler');
 
function filters_ajax_handler(){

	$args = json_decode( stripslashes( $_POST['query'] ), true );

	$args = array(
		'posts_per_page' => 4,
		'post_status' => 'publish',
		'post_type' => 'products',
		'orderby ' => 'name',
		'order' => $_POST['sortByName'],
	);

	$tax_query = array( 'relation' => 'AND' );
	if ($_POST['productCategory'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-categories',
			'field' => 'slug',
			'terms' => $_POST['productCategory'],
		);

		$args[ 'tax_query' ] = $tax_query;
	}
	if ($_POST['productSex'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-sex',
			'field' => 'slug',
			'terms' => $_POST['productSex'],
		);
		$args[ 'tax_query' ] = $tax_query;
	}
	if ($_POST['productColor'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-color',
			'field' => 'slug',
			'terms' => $_POST['productColor'],
		);
		$args[ 'tax_query' ] = $tax_query;
	}
	if ($_POST['productSize'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-size',
			'field' => 'slug',
			'terms' => $_POST['productSize'],
		);
		$args[ 'tax_query' ] = $tax_query;
	}
	if (!empty($_POST['productSearch'])) {
		$args['s'] = $_POST['productSearch'];
	}
	
	$wp_query = new WP_Query($args);
 
	if( $wp_query->have_posts() ) :

		ob_start();
 
		while( $wp_query->have_posts() ): $wp_query->the_post();
		
		include "template-parts/templates/product_card.php";
	
		endwhile;

		$posts_html = ob_get_contents();
   	ob_end_clean();

	else: $posts_html = '<h3>Nothing found...</h3>';
	endif;

	echo json_encode( array(
		'posts' => json_encode( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $posts_html
	) );

	die();
}

/* Search for products */

add_action('wp_ajax_search', 'search_ajax_handler');
add_action('wp_ajax_nopriv_search', 'search_ajax_handler');
 
function search_ajax_handler(){

	$args = json_decode( stripslashes( $_POST['query'] ), true );

	$args = array(
		'posts_per_page' => 4,
		'post_status' => 'publish',
		'post_type' => 'products',
		'orderby ' => 'name',
		'order' => $_POST['sortByName'],
		's' => $_POST['productSearch'],
	);

	$tax_query = array( 'relation' => 'AND' );
	if ($_POST['productCategory'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-categories',
			'field' => 'slug',
			'terms' => $_POST['productCategory'],
		);

		$args[ 'tax_query' ] = $tax_query;
	}
	if ($_POST['productSex'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-sex',
			'field' => 'slug',
			'terms' => $_POST['productSex'],
		);
		$args[ 'tax_query' ] = $tax_query;
	}
	if ($_POST['productColor'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-color',
			'field' => 'slug',
			'terms' => $_POST['productColor'],
		);
		$args[ 'tax_query' ] = $tax_query;
	}
	if ($_POST['productSize'] !== 'default') {
		$tax_query[] = array(
			'taxonomy' => 'products-size',
			'field' => 'slug',
			'terms' => $_POST['productSize'],
		);
		$args[ 'tax_query' ] = $tax_query;
	}
	
	$wp_query = new WP_Query($args);
 
	if( $wp_query->have_posts() ) :

		ob_start();
 
		while( $wp_query->have_posts() ): $wp_query->the_post();
		
		include "template-parts/templates/product_card.php";
	
		endwhile;

		$posts_html = ob_get_contents();
   	ob_end_clean();

	else: $posts_html = '<h3>Nothing found...</h3>';
	endif;

	echo json_encode( array(
		'posts' => json_encode( $wp_query->query_vars ),
		'max_page' => $wp_query->max_num_pages,
		'found_posts' => $wp_query->found_posts,
		'content' => $posts_html
	) );

	die();
}