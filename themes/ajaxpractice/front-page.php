<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AJAX_Practice
 */

get_header();
?>

<main class="container_boxed">

	<div class="product_grid_head">
		<h1>Products</h1>
		<div class="filters_block">
			<div class="search_field">
				<label for="product__search">Search:</label>
				<input type="text" name="product__search" id="product__search">
			</div>
			<form class="filters">
				<div class="filter_container filter_by_category">
					<label for="product__category">Filter by category:</label>
					<select name="product__category" id="product__category">
						<option value="default">View All</option>
						<?php
						$products_categories = get_terms( array(
							'taxonomy' => 'products-categories',
							'hide_empty' => false,
						) );

						foreach ( $products_categories as $product_category ) {
							echo '<option value="' . $product_category->slug . '">' . $product_category->name . '</option>';
						}

						?>
					</select>
				</div>
				<div class="filter_container filter_by_sex">
					<label for="product__sex">Filter by sex:</label>
					<select name="product__sex" id="product__sex">
						<option value="default">View All</option>
						<?php
						$products_sex = get_terms( array(
							'taxonomy' => 'products-sex',
							'hide_empty' => false,
						) );

						foreach ( $products_sex as $product_sex ) {
							echo '<option value="' . $product_sex->slug . '">' . $product_sex->name . '</option>';
						}

						?>
					</select>
				</div>
				<div class="filter_container filter_by_color">
					<label for="product__color">Filter by color:</label>
					<select name="product__color" id="product__color">
						<option value="default">View All</option>
						<?php
						$products_sex = get_terms( array(
							'taxonomy' => 'products-color',
							'hide_empty' => false,
						) );

						foreach ( $products_sex as $product_sex ) {
							echo '<option value="' . $product_sex->slug . '">' . $product_sex->name . '</option>';
						}

						?>
					</select>
				</div>
				<div class="filter_container filter_by_size">
					<label for="product__size">Filter by size:</label>
					<select name="product__size" id="product__size">
						<option value="default">View All</option>
						<?php
						$products_sex = get_terms( array(
							'taxonomy' => 'products-size',
							'hide_empty' => false,
						) );

						foreach ( $products_sex as $product_sex ) {
							echo '<option value="' . $product_sex->slug . '">' . $product_sex->name . '</option>';
						}

						?>
					</select>
				</div>
				<div class="filter_container sort_by_name">
					<label for="sort_by_name">Sort by name: </label>
					<select name="sort_by_name" id="sort_by_name">
						<option value="DESC">DESC</option>
						<option value="ASC">ASC</option>
					</select>
				</div>
			</form>
		</div>
		
	</div>

	<div class="products_container">
		<?php
			$args = array(
				'posts_per_page' => 4,
				'post_status' => 'publish',
				'post_type' => 'products',
				'suppress_filters' => true,
			);

			$wp_query = new WP_Query($args);
		

			if( $wp_query->have_posts() ) :
		 
				while( $wp_query->have_posts() ): $wp_query->the_post();
				
				include "template-parts/templates/product_card.php";

				endwhile;

			endif;

				if ($wp_query->post_count === 0) : 
					echo '<h3 class="no_found_products">No found posts</h3>';
				endif; 

				wp_reset_postdata();
		?>
	</div>

<span id="loadmore_product">Load more</span> 
<?php  ?>
</main>

<?php
get_footer();
