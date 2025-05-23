<?php

/**
 * Template Name: Страница с большим первым экраном
 */
get_header();
?>
<main class="main page-large">
  <?php while (have_posts()) : the_post(); ?>
    <div class="page-large__hero hero">
      <div class="container">
        <div class="hero__inner">
          <h1 class="page__title"><?php the_title(); ?></h1>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</main>
<?php get_footer(); ?>
