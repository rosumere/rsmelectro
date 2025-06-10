<?php

/**
 * Template name: Страница - подбор АКБ
 */

get_header();

?>

<main class="main page-standart page-selection section-light">
  <div class="page-standart__wrapper ">
    <div class="container">
      <?php while (have_posts()) : the_post(); ?>
        <div class="breadcrumbs">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
          }
          ?>
        </div>
        <div class="page-standart__inner tabs" data-tabs-container data-tabs-default="parameters-selection">
          <div class="page-standart__sidebar">
            <h1 class="page-standart__title"><?php the_title(); ?></h1>

            <div class="tabs__buttons">
              <button class="tabs__btn" data-tab="parameters-selection">Подбор по параметрам</button>
              <button class="tabs__btn" data-tab="models-selection">Подбор по модели ИБП</button>
            </div>
          </div>
          <div class="page-standart__content">
            <div class="tabs__content" data-tab="parameters-selection">
              <?php echo do_shortcode('[catalog_filter_form]'); ?>
            </div>

            <div class="tabs__content" data-tab="models-selection">
              Подбор по модели ИБП
            </div>
          </div>
        </div>
        <div class="section-line"></div>
    </div>
  <?php endwhile; ?>
  </div>
</main>



<?php get_footer(); ?>
