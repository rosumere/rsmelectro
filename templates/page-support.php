<?php

/**
 * Template Name: Страница поддержка
 */
get_header();

?>

<main class="main page-hero page-support">
  <?php while (have_posts()) : the_post(); ?>
    <div class="page-hero__cover section-dark" style="background-image: url('<?php echo esc_url(get_field('page_hero_img')); ?>');">
      <div class="page-hero__cover-bgr"></div>
      <div class="container">
        <div class="page-hero__head">
          <div class="breadcrumbs">
            <?php
            if (function_exists('yoast_breadcrumb')) {
              yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
            }
            ?>
          </div>
          <h1 class="page-hero__title"><?php the_title(); ?></h1>
        </div>
        <div class="section-line"></div>
      </div>
    </div>
    <div class="page-hero__wrapper section-light">
      <div class="container">
        <div class="page-hero__inner">
          <div class="page-hero__sidebar">

          </div>
          <div class="page-hero__content">

          </div>
          <div class="section-line"></div>
        </div>
      </div>
    </div>

    <?php
    $params = [
      'section-type' => 'section-light',
      'section-line' => '<div class="section-line"></div>'
    ];
    get_template_part('template-parts/contact-section', null, $params); ?>
  <?php endwhile; ?>




</main>




<?php get_footer(); ?>
