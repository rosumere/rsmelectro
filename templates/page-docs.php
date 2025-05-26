<?php

/**
 * Template Name: Документы
 */
get_header();

?>
<style>
  .page-hero__content {
    position: relative;
    min-height: 200px;
    /* или подстрой под контент */
  }
</style>
<main class="main page-docs page-hero">
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
        <div class="page-hero__inner tabs">
          <div class="page-hero__sidebar page-docs__sidebar">
            <div class="tabs__buttons">
              <button class="tabs__btn" data-tab="catalog">Каталоги</button>
              <button class="tabs__btn" data-tab="passport">Паспорта</button>
            </div>

          </div>

          <div class="page-hero__content page-docs__content">
            <div class="tabs__content" data-tab="catalog">
              <?php if (have_rows('docs_catalog_repeater')) : ?>
                <ul class="tabs__content-list">
                  <?php while (have_rows('docs_catalog_repeater')) : the_row();
                    $title = get_sub_field('docs_catalog_title');
                    $link = get_sub_field('docs_catalog_file');
                  ?>
                    <li class="tabs__content-item">
                      <a href="<?php echo $link; ?>" download class="link tabs__link">
                        <svg aria-hidden="true">
                          <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.2#icon-pdf'; ?>"></use>
                        </svg>
                        <?php echo $title; ?>
                      </a>
                    </li>
                  <?php endwhile; ?>
                </ul>
              <?php endif; ?>
            </div>

            <div class="tabs__content" data-tab="passport" class="active">
              <?php if (have_rows('docs_passport_repeater')) : ?>
                <ul class="tabs__content-list">
                  <?php while (have_rows('docs_passport_repeater')) : the_row();
                    $title = get_sub_field('docs_passport_title');
                    $link = get_sub_field('docs_passport_file');
                  ?>
                    <li class="tabs__content-item">
                      <a href="<?php echo $link; ?>" download class="link tabs__link">
                        <svg aria-hidden="true">
                          <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.2#icon-pdf'; ?>"></use>
                        </svg>
                        <?php echo $title; ?>
                      </a>
                    </li>
                  <?php endwhile; ?>
                </ul>
              <?php endif; ?>
            </div>


          </div>
        </div>

        <div class="section-line"></div>
      </div>
    </div>

  <?php endwhile; ?>
  <?php get_template_part('template-parts/contacts'); ?>
</main>




<?php get_footer(); ?>
