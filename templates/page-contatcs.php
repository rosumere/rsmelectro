<?php

/**
 * Template Name: Страница контакты
 */
get_header();

?>

<main class="main page-hero page-contacts">
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
        <div class="page-hero__inner">
          <div class="page-hero__sidebar">
            <div class="contacts">
              <div class="contacts__content">
                <ul class="contacts__list contacts__list--page">
                  <?php if (get_field('contacts_phone_link', 'option')): ?>
                    <li class="contacts__item contacts__item--phone">
                      <div class="contacts__label">Телефон</div>
                      <a href="tel:<?php the_field('contacts_phone_link', 'option'); ?>" class="link contacts__value">
                        <?php the_field('contacts_phone_human', 'option'); ?>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (get_field('contacts_mail', 'option')): ?>
                    <li class="contacts__item contacts__item--mail">
                      <div class="contacts__label">Почта</div>
                      <a href="mailto:<?php the_field('contacts_mail', 'option'); ?>" class="link contacts__value">
                        <?php the_field('contacts_mail', 'option'); ?>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (get_field('contacts_adress', 'option')): ?>
                    <li class="contacts__item contacts__item--adress">
                      <div class="contacts__label">Адрес</div>
                      <div class="contacts__value"><?php the_field('contacts_adress', 'option'); ?></div>
                    </li>
                  <?php endif; ?>
                  <?php if (get_field('contacts_name', 'option')): ?>
                    <li class="contacts__item contacts__item--name">
                      <div class="contacts__label">Наименование</div>
                      <div class="contacts__value"><?php the_field('contacts_name', 'option'); ?></div>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </div>

          </div>
          <div class="page-hero__content">
            <div class="page-contacts__map">
              <script type="text/javascript" charset="utf-8" async src="https://<?php the_field('contacts_map_link', 'option'); ?>"></script>
            </div>




          </div>
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

</main>




<?php get_footer(); ?>
