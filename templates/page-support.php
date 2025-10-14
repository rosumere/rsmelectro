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


        <?php
        $parent_page = get_page_by_path('page-support');
        $parent_id = get_the_ID();
        $args = [
          'post_type'      => 'page',
          'posts_per_page' => -1, // вывести все
          'post_parent'    => $parent_id, // ID родительской страницы
          'order'          => 'ASC', // сортировка
          'orderby'        => 'menu_order' // по порядку в меню (или 'title', 'date')
        ];

        $query = new WP_Query($args); ?>

        <?php if ($query->have_posts()) : ?>
          <ul class="page-support__list">
            <li class="page-support__item">
              <a href="/dokumentacziya" class="page-support__link">

                <img class="page-support__cover" src="https://electro-batt.ru/wp-content/uploads/2025/05/pasporta-icon.svg" alt="Иконка - документация">

                <div class="page-support__link-head">
                  <h2>Документация</h2>
                  <div class="page-support__link-descr">
                    В этом разделе представлены технические паспорта и прочая документация на нашу продукцию
                  </div>
                </div>
                <span class="page-support__link-more">Подробнее
                  <svg aria-hidden="true">
                    <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.2#arrow-right-double'; ?>"></use>
                  </svg>
                </span>
              </a>
            </li>

            <?php while ($query->have_posts()) : $query->the_post(); ?>
              <li class="page-support__item">
                <a href="<?php the_permalink(); ?>" class="page-support__link">
                  <?php if (get_field('service_inner_icon')): ?>
                    <img class="page-support__cover" src="<?php the_field('service_inner_icon'); ?>" alt="<?php echo 'Иконка - ' . get_the_title(); ?>">
                  <?php endif; ?>
                  <div class="page-support__link-head">
                    <h2><?php the_title(); ?></h2>
                    <?php if (get_field('service_inner_descr')): ?>
                      <div class="page-support__link-descr">
                        <?php the_field('service_inner_descr'); ?>
                      </div>
                    <?php endif; ?>
                  </div>
                  <span class="page-support__link-more">Подробнее
                    <svg aria-hidden="true">
                      <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.2#arrow-right-double'; ?>"></use>
                    </svg>
                  </span>
                </a>
              </li>
            <?php endwhile; ?>

            <?php wp_reset_postdata(); ?>

          </ul>
        <?php endif; ?>
        <div class="section-line"></div>

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
