<?php get_header(); ?>

<main class="main page page-catalog">
  <div class="container">
    <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
      <?php
      if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
      }
      ?>
    </div>
    <?php
    if (have_posts()) : ?>
      <ul class="articles__list">
        <?php while (have_posts()) : the_post(); ?>
          <li class="articles__item article">
            <a href="<?php the_permalink(); ?>" class="article__link">
              <h2 class="article__title">
                <?php the_title(); ?>
              </h2>
            </a>

          </li>
        <?php endwhile; ?>
      </ul>
    <?php
    else :
      _e('Извините, записей не найдено.', 'textdomain');
    endif; ?>
  </div>
</main>

<?php get_footer(); ?>
