<section class="home-hero section-dark">

  <?php
  $image_id_lg = get_field('home_hero_cover');
  $image_id_sm = get_field('home_hero_cover_sm');

  // Готовим srcset через функции WP (дают шанс плагину подменить на webp)
  $srcset_sm = $image_id_sm ? wp_get_attachment_image_srcset($image_id_sm, 'full') : '';
  $srcset_lg = $image_id_lg ? wp_get_attachment_image_srcset($image_id_lg, 'full') : '';
  ?>

  <?php if ($image_id_lg || $image_id_sm): ?>
    <picture>
      <?php if ($srcset_sm): ?>
        <source
          media="(max-width: 767.98px)"
          srcset="<?php echo esc_attr($srcset_sm); ?>">
      <?php endif; ?>
      <?php
      if ($image_id_lg) {
        echo wp_get_attachment_image($image_id_lg, 'full', false, [
          'class'   => 'home-hero__cover',
          'loading' => 'lazy',
        ]);
      } elseif ($image_id_sm) {
        // На всякий случай, если большого нет — используем мобильное как фолбэк
        echo wp_get_attachment_image($image_id_sm, 'full', false, [
          'class'   => 'home-hero__cover',
          'loading' => 'lazy',
        ]);
      }
      ?>
    </picture>
  <?php endif; ?>
  <div class="home-hero__bgr"></div>
  <div class="container">
    <div class="home-hero__content">
      <?php if (get_field('home_title')): ?>
        <h1 class="home-hero__title page__title"><?php the_field('home_title'); ?></h1>
      <?php endif; ?>
      <?php if (get_field('home_subtitle')): ?>
        <div class="home-hero__subtitle"><?php the_field('home_subtitle'); ?></div>
      <?php endif; ?>
      <div class="home-hero__buttons">
        <a href="/catalog" class="btn home-hero__btn">Подробнее</a>
        <a href="/dokumentacziya" class="btn home-hero__btn btn--outline-white">
          <img aria-hidden="true" src="/wp-content/uploads/2025/05/documentation-icon.svg" alt="Иконка документации">
          Документация
        </a>
      </div>
    </div>
    <div class="section-line"></div>
  </div>
</section>
