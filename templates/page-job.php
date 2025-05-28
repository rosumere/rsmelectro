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
    <div class="page-hero__wrapper resume-section section-light">
      <div class="container">

        <div class="page-hero__inner">
          <div class="page-hero__sidebar">
            <div class="resume-section__content">
              <button class="btn resume-section__btn" data-resume="true">Отправить резюме</button>
              <div class="resume-section__descr">
                Так же вы можете прислать свое резюме на почту <a href="mailto:<?php the_field('contacts_mail', 'option'); ?>" class="link"><?php the_field('contacts_mail', 'option'); ?></a>
              </div>
            </div>
          </div>
          <div class="page-hero__content resume-section__head">
            <h2 class="page__subtitle page__subtitle--noml">
              Оставьте своё резюме
            </h2>
          </div>
        </div>
        <div class="section-line"></div>
      </div>
    </div>
    <section class="page-hero__wrapper section-light">
      <div class="container">
        <div class="page-job__inner">

          <?php
          $args = array(
            'posts_per_page' => -1,
            'post_type' => 'jobs',
          );

          $query = new WP_Query($args); ?>

          <?php if ($query->have_posts()) : ?>
            <h2 class="page__subtitle">Открытые вакансии</h2>
            <div class="page-job__slider-nav">
              <button class="page-job__nav button page-job__nav--prev">
                <svg aria-hidden="true">
                  <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.3#arrow-left'; ?>"></use>
                </svg>
              </button>
              <button class="page-job__nav button page-job__nav--next">
                <svg aria-hidden="true">
                  <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.3#arrow-right'; ?>"></use>
                </svg>
              </button>
            </div>
            <div class="swiper page-job__slider">

              <ul class="swiper-wrapper page-job__list">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                  <li class="swiper-slide page-job__item job-card">
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
                      <div class="job-card__accordeon job-accordeon">
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
                      <div class="job-card__cta">
                        <button class="btn " data-job-form="true">Отправить резюме</button>
                      </div>
                    </div>
                  </li>
                <?php endwhile; ?>
              </ul>
              <?php wp_reset_postdata(); ?>

            </div>
          <?php else : ?>
            <p><?php esc_html_e('Нет постов по вашим критериям.'); ?></p>
          <?php endif; ?>


        </div>
        <div class="section-line"></div>
      </div>
    </section>
    <?php
    $params = [
      'section-type' => 'section-light',
      'section-line' => '<div class="section-line"></div>'
    ];
    get_template_part('template-parts/contact-section', null, $params); ?>
  <?php endwhile; ?>

  <div id="job-form" style="display:none;">
    <div class="resume-form" style="height:auto">
      <?php echo do_shortcode('[contact-form-7 id="080a452" title="job-resume-form"]'); ?>
    </div>
  </div>


</main>




<?php get_footer(); ?>
