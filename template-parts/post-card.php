<article class="single-archive__item single-card">
  <span class="single-card__category"><?php the_category(', '); ?></span>
  <a href="<?php the_permalink(); ?>" class="single-card__link">
    <div class="single-card__cover">
      <?php if (has_post_thumbnail()) :
        the_post_thumbnail('full');
      else : ?>
        <img src="<?php echo get_template_directory_uri() . '/assets/media/no-image.png'; ?>" alt="Изображение записи">
      <?php endif; ?>
    </div>
    <h2 class="single-card__title"><?php the_title(); ?></h2>
    <span class="single-card__date"><?php echo get_the_date('d-m-Y'); ?></span>
  </a>
</article>
