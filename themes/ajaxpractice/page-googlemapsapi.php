<?php
/*
Template Name: Google Maps Api
*/

get_header();
$markers = get_field('markers');
?>

	<main class="container_boxed">

    <h1><?php the_title(); ?></h1>
		<div class="markers">
			<?php 
				if ($markers) :
					foreach ($markers as $marker) :
						?>
							<span data-lat="<?php echo $marker['lat'] ?>" data-lng="<?php echo $marker['lng'] ?>"><?php echo $marker['title'] ?></span>
						<?php
					endforeach;
				endif;
			?>
		</div>

		<div id="map">

		</div>

	</main><!-- #main -->

<?php
get_footer();