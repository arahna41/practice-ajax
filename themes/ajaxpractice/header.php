<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package AJAX_Practice
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'ajaxpractice' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container_boxed">
			<a class="logo" href="/">AJAX Practice</a>
			<?php
				$args = array(
					'menu' => 'Header',
					'depth'	=> 1,
					'container' => 'nav',
					'container_class' => 'header_nav',
					'fallback_cb' => false
				);
					
				wp_nav_menu( $args );
			?>
		</div>
	</header><!-- #masthead -->
	<div class="main_content">
