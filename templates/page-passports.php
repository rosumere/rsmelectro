<?php

/**
 * Template name: Страница паспорта
 */

get_header();

?>
<main class="main page-passports section-light">
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
              <ul class="page-passports__list">

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
        </div>
        <div class="section-line section-line--xl"></div>
    </div>
  <?php endwhile; ?>
  </div>
</main>



<?php get_footer(); ?>
