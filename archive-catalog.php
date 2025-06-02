<?php get_header(); ?>

<main class="main page page-catalog">

  <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container">
      <?php
      if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
      }
      ?>
    </div>
  </div>

  <div class="page-catalog__content">
    <div class="container">
      <h1 class="page__title">Каталог</h1>

      <!-- Добавляем форму фильтрации -->
      <div class="page-catalog__filters">
        <button class="btn page-catalog__filters-btn">
          <span class="page-catalog__filters-btn-text">Показать фильтры</span>

          <svg aria-hidden="true">
            <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.3#arrow-down'; ?>"></use>
          </svg>
        </button>
        <div class="page-catalog__filters-form">
          <?php echo do_shortcode('[catalog_filter_form]'); ?>
        </div>
      </div>

      <?php if (have_posts()) : ?>
        <!-- Оригинальный список товаров (будет скрываться при фильтрации) -->
        <div id="original-catalog-list">
          <ul class="page-catalog__list">
            <?php while (have_posts()) : the_post(); ?>
              <?php
              $image = get_field('product_image');
              $voltage = get_field('product_rated_voltage');
              $power = get_field('product_rated_power');
              ?>
              <li class="page-catalog__item catalog-card">
                <a href="<?php the_permalink(); ?>" class="catalog-card__link">
                  <div class="catalog-card__cover">
                    <?php
                    if ($image) {
                      echo wp_get_attachment_image($image, 'full', false, array('class' => 'catalog-card__image'));
                    }
                    ?>
                  </div>
                  <div class="catalog-card__content">
                    <h2 class="catalog-card__title">
                      <?php the_title(); ?>
                    </h2>
                    <div class="catalog-card__property">
                      <?php echo $voltage . ' В ' . $power . ' Ач'; ?>
                    </div>
                  </div>
                </a>
                <button class="btn catalog-card__cta" data-form="true" data-title="<?php echo esc_attr(get_the_title()); ?>"
                  data-info="<?php echo esc_attr($voltage . ' В ' . $power . ' Ач'); ?>">Оставить заявку</button>
              </li>
            <?php endwhile; ?>
          </ul>
        </div>
      <?php
      else :
        _e('Извините, записей не найдено.', 'textdomain');
      endif; ?>
    </div>
  </div>

  <?php get_template_part('template-parts/contact-section'); ?>

</main>

<?php get_footer(); ?>
