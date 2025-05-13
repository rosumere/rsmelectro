<section class="home-about">
  <div class="container">
    <div class="home-about__inner">
      <h2 class="page__subtitle home-about__title"><?php the_field('home_about_title'); ?></h2>
      <?php
      $home_about_img = get_field('home_about_img');
      if ($home_about_img) {
        echo wp_get_attachment_image($home_about_img, 'full', false, array('class' => 'home-about__cover'));
      }
      ?>
      <div class="home-about__descr">
        <?php the_field('home_about_descr'); ?>
      </div>
      <?php if (have_rows('home_about_repeater')): ?>
        <ul class="home-about__list">
          <?php while (have_rows('home_about_repeater')): the_row();
            $item = get_sub_field('home_about_item');
          ?>
            <li class="home-about__item">
              <?php echo $item; ?>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</section>
