<section class="home-hero section-dark" style="background-image: url('<?php echo esc_url(get_field('home_hero_cover')); ?>');">
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
        <a href="#" class="btn home-hero__btn">Подробнее</a>
        <a href="#" class="btn home-hero__btn btn--outline-white">
          <img src="/wp-content/uploads/2025/05/documentation-icon.svg" alt="">
          Документация
        </a>
      </div>

    </div>
    <div class="section-line"></div>
  </div>

</section>
