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
  <?php
  if (have_posts()) : ?>
    <div class="page-catalog__content">
      <div class="container">
        <h1 class="page__title">Каталог</h1>
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
              <button class="btn catalog-card__cta" data-form="true">Оставить заявку</button>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>
    <section class="page-contact">
      <div class="container">
        <div class="page-contact__inner">
          <div class="page-contact__head">
            <h2 class="page__subtitle page-contact__title">Форма обратной связи</h2>
            <div class="page-contact__info">
              Оставьте заявку и наш сотрудник свяжется с Вами в ближайшее время
            </div>
          </div>
          <div class="page-contact__form">
            <?php echo do_shortcode('[contact-form-7 id="67fc3c1" title="form-page"]'); ?>
          </div>
        </div>
      </div>
    </section>
  <?php
  else :
    _e('Извините, записей не найдено.', 'textdomain');
  endif; ?>

</main>

<?php get_footer(); ?>
