<?php

/**
 * Template Name: Политика конфиденциальности
 */
get_header();
?>
<main class="main page-privacy page-large page-line-light">
  <div class="page-large__wrapper">
    <div class="container">
      <?php while (have_posts()) : the_post(); ?>
        <div class="breadcrumbs">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
          }
          ?>
        </div>
        <div class="page-large__inner page-privacy__inner">
          <div class="page-large__sidebar">
            <?php
            // Сначала загружаем весь контент в переменную
            $content = apply_filters('the_content', get_the_content());

            // Затем генерируем TOC
            $toc = do_shortcode('[ez-toc]');
            ?>

            <div class="page-privacy__table-content">
              <?php echo $toc; ?>
            </div>
          </div>
          <div class="page-large__content">
            <h1 class="page-large__title"><?php the_title(); ?></h1>
            <div class="user-content page-privacy__content">
              <?php echo $content; ?>
            </div>
          </div>
        </div>
        <div class="page-large-line"></div>
    </div>
  <?php endwhile; ?>
  </div>
</main>
<?php get_footer(); ?>
