<?php

get_header();

?>

<main class="main page page--product page-product">

  <?php while (have_posts()) : the_post(); ?>
    <div class="container">
      <div class="product-main">
        <div class="breadcrumbs">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
          }
          ?>
        </div>
        <div class="product-main__inner">
          <div class="produсt-main__cover">
            <?php
            $image_id = get_field('product_image');
            if ($image_id) {
              echo wp_get_attachment_image($image_id, 'full', false, array('class' => 'product-main__cover-img'));
            }
            ?>
          </div>
          <div class="product-main__info">
            <div class="product-main__parameters">
              <?php the_field('product_rated_voltage'); ?>
              <?php the_field('product_rated_power'); ?>

            </div>
            <h1 class="page__title">
              <?php the_title(); ?>
            </h1>
          </div>
        </div>
      </div>


    </div>

  <?php endwhile; ?>


  <?php
  get_template_part('template-parts/contacts');

  ?>
</main>

<?php
get_footer();
