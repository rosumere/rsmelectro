<?php
get_header();
?>


<main class="main page page-archive">
  <div class="container">
    <?php
    the_archive_title('<h1 class="page__title">', '</h1>');
    the_archive_description('<div class="page-archive__descr">', '</div>');

    if (have_posts()) {
      echo '<ul class="page__list">';
      while (have_posts()) {
        the_post();
    ?>
        <li class="page__item">
          <article id="post-<?php the_ID(); ?>" class="article">
            <h2 class="page__subtitle"><?php the_title(); ?></h2>
            <a href="<? the_permalink(); ?>" class="link">
              Перейти
            </a>
          </article>
        </li>
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
