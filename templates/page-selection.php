<?php

/**
 * Страница - подбор АКБ
 */

get_header();

?>

<main class="main page-standart page-selection section-light">
  <div class="page-standart__wrapper">
    <div class="container">
      <?php while (have_posts()) : the_post(); ?>
        <div class="breadcrumbs">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
          }
          ?>
        </div>
        <div class="page-standart__inner">
          <div class="page-standart__sidebar">
            <h1 class="page-standart__title"><?php the_title(); ?></h1>
          </div>
          <div class="page-standart__content">
            <div class="page-section__content">

            </div>
          </div>
        </div>
        <div class="section-line"></div>
    </div>
  <?php endwhile; ?>
  </div>
</main>



<?php get_footer(); ?>
