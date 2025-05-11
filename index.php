<?php
get_header();
?>

<main class="main page">
  <div class="container">
    <?php
    if (have_posts()) : ?>
      <ul class="page__list">
        <?php while (have_posts()) : the_post(); ?>
          <li class="page__item">
            <article id="post-<?php the_ID(); ?>" class="article">
              <h2 class="page__title"><?php the_title(); ?></h2>
              <?php the_content(); ?>
              <a href="<?php the_permalink(); ?>">Перейти</a>
            </article>
          </li>
        <?php
        endwhile;
      else : echo '<h1>Записей не найдено</h1>';
        ?>
      </ul>
    <?php endif; ?>
  </div>
</main>

<?php
get_footer();
