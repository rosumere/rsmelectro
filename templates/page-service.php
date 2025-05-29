<?php

/**
 * Template name: Страница сервис
 */

get_header();


?>



<main class="main page-standart section-light">
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

            <div class="user-content">
              <?php
              $parent_page = get_page_by_path('page-service');
              $parent_id = $parent_page->ID;
              $args = [
                'post_type'      => 'page',
                'posts_per_page' => -1, // вывести все
                'post_parent'    => $parent_id, // ID родительской страницы
                'order'          => 'ASC', // сортировка
                'orderby'        => 'menu_order' // по порядку в меню (или 'title', 'date')
              ];

              $query = new WP_Query($args); ?>

              <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                  <h2><?php the_title(); ?></h2>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

              <?php else : ?>
                <p><?php esc_html_e('Нет постов по вашим критериям.'); ?></p>
              <?php endif; ?>

            </div>
          </div>
        </div>
        <div class="section-line"></div>
    </div>
  <?php endwhile; ?>
  </div>
</main>



<?php get_footer(); ?>
