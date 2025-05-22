<?php if (have_rows('home_values_repeater')): ?>
  <section class="home-values section-dark">
    <div class="container">
      <div class="home-values__wrapper">
        <div class="home-values__inner">
          <h2 class="page__subtitle home-values__title"><?php the_field('home_values_title'); ?></h2>
          <ul class="home-values__list">
            <?php while (have_rows('home_values_repeater')): the_row();
              $image = get_sub_field('home_values_image');
              $title = get_sub_field('home_values_subtitle');
              $descr = get_sub_field('home_values_descr');
            ?>
              <li class="home-values__item">
                <img src="<?php echo $image; ?>" alt="<?php echo 'Изображение ценности компании - ' . $title; ?>" class="home-values__item-img">
                <div class="home-values__item-content">
                  <h3 class="home-values__item-title"><?php echo $title; ?></h3>
                  <div class="home-values__item-descr">
                    <?php echo $descr; ?>
                  </div>
                </div>
              </li>
            <?php endwhile; ?>
          </ul>
        </div>
      </div>
      <div class="section-line"></div>
    </div>
  </section>
<?php endif; ?>
