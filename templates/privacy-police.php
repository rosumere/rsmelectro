<?php

/**
 * Template Name: Политика конфиденциальности
 */
get_header();
?>
<main class="main page-privacy">
  <div class="container">
    <?php while (have_posts()) : the_post(); ?>
      <div class="page-privacy__inner">
        <div class="breadcrumbs">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
          }
          ?>
        </div>
        <h1 class="page__title"><?php the_title(); ?></h1>

        <?php
        // Сначала загружаем весь контент в переменную
        $content = apply_filters('the_content', get_the_content());

        // Затем генерируем TOC
        $toc = do_shortcode('[ez-toc]');
        ?>

        <div class="page-privacy__table-content">
          <?php echo $toc; ?>
        </div>

        <div class="user-content page-privacy__content">
          <?php echo $content; ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</main>
<?php get_footer(); ?>
