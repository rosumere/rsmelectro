<?php

/**
 * Template Name: О компании
 */
get_header();

?>

<main class="main page-about page-hero">
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
    <div class="page-hero__wrapper ">
      <?php if (have_rows('about_list_repeater')): ?>
        <section class="about-info">
          <h2 class="visually-hidden">Информация о компании</h2>
          <ul class="about-info__list">
            <?php
            $i = 0;
            while (have_rows('about_list_repeater')): the_row();
              $icon = get_sub_field('about_list_icon');
              $title = get_sub_field('about_list_title');
              $descr = get_sub_field('about_list_descr');
              $is_active = $i === 1 ? 'about-info__item--active' : '';
            ?>
              <li class="about-info__item <?php echo $is_active; ?>" data-item="<?php echo $i; ?>">
                <div class="container">
                  <div class="about-info__item-inner">
                    <div class="about-info__head" data-toggle="<?php echo $i; ?>">
                      <div class="about-info__head-container">
                        <img src="<?php echo $icon; ?>" alt="<?php echo 'Иконка - ' . $title; ?>">
                        <h3 class="page-hero__subtitle about-info__title"><?php echo $title; ?></h3>
                      </div>

                    </div>
                    <div class="about-info__content">
                      <?php echo $descr; ?>
                    </div>
                  </div>
                </div>
              </li>
            <?php
              $i++;
            endwhile; ?>
          </ul>
        </section>
      <?php endif; ?>

      <section class="about-appeal section-light">
        <div class="container">

          <div class="about-appeal__inner">
            <h2 class="page-hero__subtitle about-appeal__title"><?php the_field('about_appeal_title'); ?></h2>
            <div class="about-appeal__sidebar">
              <div class="about-appeal__cover">
                <?php
                $image_id = get_field('about_appeal_img');
                if ($image_id) {
                  echo wp_get_attachment_image($image_id, 'full', false, array('class' => 'about-appeal__cover-img', 'alt' => 'Фотография руководителя компании'));
                }
                ?>
              </div>
              <div class="about-appeal__position">
                <?php the_field('about_appeal_img_descr'); ?>
              </div>
            </div>
            <div class="about-appeal__content">
              <?php the_field('about_appeal_descr'); ?>
            </div>
          </div>
          <div class="section-line"></div>
        </div>
      </section>
    <?php endwhile; ?>
    <?php get_template_part('template-parts/contacts'); ?>
</main>




<?php get_footer(); ?>
