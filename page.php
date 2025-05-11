<?php

get_header();

?>

<main class="main page">
  <div class="container">
    <?php while (have_posts()) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" class="article">
        <div class="user-content">
          <h1 class="page__title"><?php the_title(); ?></h1>
          <?php
          the_content();
          ?>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</main>

<?php
get_footer();
