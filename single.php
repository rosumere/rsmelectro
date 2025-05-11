<?php

get_header();

?>

<main class="main page single">
  <div class="container">
    <?php while (have_posts()) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" class="article">
        <div class="user-content">
          <h1 class="page__title"><?php the_title(); ?></h1>
          <?php
          the_content();
          the_post_navigation(
            array(
              'prev_text' => '<span class="nav-subtitle">' . 'Предыдущая запись: ' . '</span> <span class="nav-title">%title</span>',
              'next_text' => '<span class="nav-subtitle">' . 'Следующая запись: ' . '</span> <span class="nav-title">%title</span>',
            )
          );
          ?>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</main>

<?php
get_footer();
