<?php

/**
 * Template Name: Страница вакансии
 */
get_header();

?>

<main class="main page-hero page-job">
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
        <div class="page-job__inner">
          <?php
          $args = array(
            'posts_per_page' => -1,
            'post_type' => 'jobs',
          );

          $query = new WP_Query($args); ?>

          <?php if ($query->have_posts()) : ?>
            <ul class="page-job__list">
              <?php while ($query->have_posts()) : $query->the_post(); ?>
                <li class="page-job__item job-card">
                  <a href="#job-popup-<?php the_ID(); ?>" class="job-card__link glightbox-job" data-gallery="gallery-<?php the_ID(); ?>">
                    <h3 class="job-card__title"><?php the_title(); ?></h3>
                    <span class="job-card__more">
                      Подробнее
                      <svg aria-hidden="true">
                        <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.2#arrow-right-double'; ?>"></use>
                      </svg>
                    </span>
                  </a>
                  <div id="job-popup-<?php the_ID(); ?>" class="job-card__content glightbox-content" style="display: none;" data-gallery="gallery-<?php the_ID(); ?>">
                    <div class="job-card__content-title"><?php the_title(); ?></div>
                    <div class=" job-accordeon">
                      <div class="job-accordeon__inner user-content">
                        <?php if (get_field('job_general')): ?>
                          <div class="job-accordeon__item">
                            <button class="job-accordeon__btn">Основной функционал</button>
                            <div class="job-accordeon__content">
                              <?php the_field('job_general'); ?>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if (get_field('job_requirements')): ?>
                          <div class="job-accordeon__item">
                            <button class="job-accordeon__btn">Наши ожидания</button>
                            <div class="job-accordeon__content">
                              <?php the_field('job_requirements'); ?>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if (get_field('job_offer')): ?>
                          <div class="job-accordeon__item">
                            <button class="job-accordeon__btn">Мы предлагаем</button>
                            <div class="job-accordeon__content">
                              <?php the_field('job_offer'); ?>
                            </div>
                          </div>
                        <?php endif; ?>
                        <?php if (get_field('job_opportunities')): ?>
                          <div class="job-accordeon__item">
                            <button class="job-accordeon__btn">Возможности</button>
                            <div class="job-accordeon__content">
                              <?php the_field('job_opportunities'); ?>
                            </div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <button class="btn" data-job-form="true">Отправить резюме</button>
                  </div>
                </li>
              <?php endwhile; ?>

            </ul>
            <?php wp_reset_postdata(); ?>

          <?php else : ?>
            <p><?php esc_html_e('Нет постов по вашим критериям.'); ?></p>
          <?php endif; ?>


        </div>
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

  <a href="#job-form" class="glightbox open-job-form">Открыть форму (скрыто)</a>

  <div id="job-form" class="glightbox" style="display: none;">
    <div class="popup-form">
      <h2>Форма отклика</h2>
      <p>Здесь будет форма...</p>
    </div>
  </div>


</main>




<?php get_footer(); ?>
