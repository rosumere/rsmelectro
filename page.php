<?php

get_header();

$hero = false;
if (get_field('is_show_hero')) {
  $hero = true;
}

?>


<?php if ($hero): ?>
  <main class="main page-hero">
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

            </div>

            <div class="page-hero__content ">
              <div class="user-content">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
          <div class="section-line"></div>
        </div>
      </div>
    <?php endwhile; ?>
    <?php get_template_part('template-parts/contacts'); ?>
  </main>
<?php else: ?>
  <main class="main page-standart section-light">
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

              <div class="user-content">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
          <div class="section-line"></div>
      </div>
    <?php endwhile; ?>
    </div>
  </main>
<?php endif; ?>


<?php get_footer(); ?>
