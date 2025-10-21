<?php

/**
 * Template Name: Документы
 */
get_header();

?>

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
        <div class="page-hero__inner tabs" data-tabs-container data-tabs-default="passport">
          <div class="page-hero__sidebar page-docs__sidebar">
            <div class="tabs__buttons">
              <button class="tabs__btn" data-tab="catalog">Каталоги</button>
              <button class="tabs__btn" data-tab="passport">Паспорта</button>
              <button class="tabs__btn" data-tab="manual">Инструкция по эксплуатации</button>
              <button class="tabs__btn" data-tab="declaration">Декларация соответствия</button>
              <button class="tabs__btn" data-tab="guarantee">Гарантийные условия</button>
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
              <?php
              $args = [
                'post_type'      => 'catalog',
                'posts_per_page' => -1,
                'meta_key'       => 'product_rated_power', // Указываем мета-поле для сортировки
                'orderby'       => 'meta_value_num',      // Сортируем как числовое значение
                'order'         => 'ASC',                // Сортировка по убыванию (от большего к меньшему)
                'meta_query'    => [                      // Опционально: только если поле существует
                  [
                    'key'     => 'product_rated_power',
                    'compare' => 'EXISTS',
                  ]
                ]
              ];

              $query = new WP_Query($args); ?>

              <?php if ($query->have_posts()) : ?>
                <ul class="page-passports__list tabs__passports-list">

                  <?php while ($query->have_posts()) : $query->the_post();
                    $image = get_field('product_image');
                    $voltage = get_field('product_rated_voltage');
                    $power = get_field('product_rated_power');
                    $passport_link = get_field('product_passport');
                  ?>
                    <li class="page-catalog__item catalog-card passport-card">
                      <a href="<?php echo $passport_link; ?>" class="catalog-card__link">
                        <div class="catalog-card__cover">
                          <?php
                          if ($image) {
                            echo wp_get_attachment_image($image, 'full', false, array('class' => 'catalog-card__image'));
                          }
                          ?>
                        </div>
                        <div class="catalog-card__content passport-card__content">
                          <svg aria-hidden="true" class="passport-card__icon">
                            <use href=" <?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.3#icon-pdf'; ?>"></use>
                          </svg>
                          <div class="passport-card__info">
                            <h2 class="catalog-card__title passport-card__title">
                              <?php the_title(); ?>
                            </h2>
                            <div class="catalog-card__property">
                              <?php echo $voltage . ' В ' . $power . ' Ач'; ?>
                            </div>
                          </div>

                        </div>
                      </a>
                    </li>
                  <?php endwhile; ?>

                  <?php wp_reset_postdata(); ?>

                </ul>
              <?php endif; ?>
            </div>

            <div class="tabs__content" data-tab="manual">
              <?php if (get_field('docs_manual_title') && get_field('docs_manual_file')): ?>
                <ul class="tabs__content-list tabs__content-list--fullwidth">
                  <li class="tabs__content-item">
                    <a href="<?php the_field('docs_manual_file'); ?>" download class="link tabs__link">
                      <svg aria-hidden="true">

                        <use href=" <?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.3#icon-pdf'; ?>"></use>
                      </svg>
                      <?php the_field('docs_manual_title'); ?>
                    </a>
                  </li>
                </ul>
              <?php endif; ?>
              <?php if (get_field('docs_manual_redact')): ?>
                <div class="tabs__editor-content wp-editor-content" inert>
                  <?php the_field('docs_manual_redact'); ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="tabs__content" data-tab="declaration">
              <?php if (get_field('docs_declaration_title') && get_field('docs_declaration_file')): ?>
                <ul class="tabs__content-list tabs__content-list--fullwidth">
                  <li class="tabs__content-item">
                    <a href="<?php the_field('docs_declaration_file'); ?>" download class="link tabs__link">
                      <svg aria-hidden="true">
                        <use href=" <?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.3#icon-pdf'; ?>"></use>
                      </svg>
                      <?php the_field('docs_declaration_title'); ?>
                    </a>
                  </li>
                </ul>
              <?php endif; ?>
            </div>

            <div class="tabs__content" data-tab="guarantee">
              <?php if (get_field('docs_manual_title') && get_field('docs_manual_file')): ?>
                <ul class="tabs__content-list tabs__content-list--fullwidth">
                  <li class="tabs__content-item">
                    <a href="<?php the_field('docs_guarantee_file'); ?>" download class="link tabs__link">
                      <svg aria-hidden="true">

                        <use href=" <?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.3#icon-pdf'; ?>"></use>
                      </svg>
                      <?php the_field('docs_guarantee_title'); ?>
                    </a>
                  </li>
                </ul>
              <?php endif; ?>
              <?php if (get_field('docs_guarantee_redact')): ?>
                <div class="tabs__editor-content wp-editor-content" inert>
                  <?php the_field('docs_guarantee_redact'); ?>
                </div>
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
