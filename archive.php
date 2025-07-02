<?php
get_header();
?>


<main class="main page archive">
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
    <?php
    the_archive_title('<h1 class="archive__title">', '</h1>');
    the_archive_description('<div class="parchive__descr">', '</div>');

    if (have_posts()) {
      echo '<div class="archive__list">';
      while (have_posts()) {
        the_post();
    ?>
        <?php get_template_part('template-parts/post-card'); ?>
    <?php
      }
      echo '</ul>';
    } else {
      echo '<p>Записей не найдено</p>';
    }
    ?>
  </div>
</main>

<?php
get_footer();
