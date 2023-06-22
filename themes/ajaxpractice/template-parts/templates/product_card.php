
<?php   
  $productCategories = get_the_terms( get_the_ID(), 'products-categories' );
  $productSex = get_the_terms( get_the_ID(), 'products-sex' );
  $productColors = get_the_terms(get_the_ID(), 'products-color');
  $productSizes = get_the_terms(get_the_ID(), 'products-size');
?>

<a href="<?php echo get_the_permalink(); ?>" class="product_item">
  <div class="image_wraper">
    <?php echo get_the_post_thumbnail();?>
    <span class="sex <?php echo $productSex[0]->slug; ?>"><?php echo $productSex[0]->name; ?></span>
  </div>
  <div class="content">
    <h3 class="category">Category: <?php 
    foreach ($productCategories as $productCategory) {
      echo $productCategory->name . ' ';
    }
    ?></h3>
    <h2 class="title"><?php echo get_the_title(); ?></h2>
    <span class="price">$<?php the_field('price'); ?></span>
    <?php
      $maxchar = 115;
      $text = strip_tags( get_the_content( ) );
      echo mb_substr( $text, 0, $maxchar );
    ?>
    <ul class="attributes">
      <li><strong>Color:</strong> <?php 
        foreach ($productColors as $productColor) {
          echo $productColor->name . ' ';
        }
      ?></li>
      <li><strong>Size:</strong> <?php 
        foreach ($productSizes as $productSize) {
          echo $productSize->name . ' ';
        }
      ?></li>
    </ul>
  </div>
</a>