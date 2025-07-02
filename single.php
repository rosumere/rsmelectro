<?php

get_header();

?>

<main class="main page single">
  <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
    <div class="container">
      <?php
      if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
      }
      ?>
    </div>
  </div>
  <div class="container">
    <?php while (have_posts()) : the_post(); ?>

      <div class="single__article">
        <h1 class="single__title"><?php the_title(); ?></h1>

        <div class="user-content">
          <?php
          the_content();

          /*
          the_post_navigation(
            array(
              'prev_text' => '<span class="nav-subtitle">' . 'Предыдущая запись: ' . '</span> <span class="nav-title">%title</span>',
              'next_text' => '<span class="nav-subtitle">' . 'Следующая запись: ' . '</span> <span class="nav-title">%title</span>',
            )
          );
          */
          ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</main>

<?php
get_footer();
