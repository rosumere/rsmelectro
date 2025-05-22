<section class="home-products section-light">
  <div class="container">
    <div class="home-products__wrapper">
      <h2 class="home-products__title page__subtitle">
        <?php if (get_field('home_products_title')) {
          the_field('home_products_title');
        } else {
          echo 'Наша продукция';
        } ?>
      </h2>
      <div class="home-products__inner">
        <h3 class="home-products__subtitle"><?php the_field('home_products_info_title'); ?></h3>
        <div class="home-products__info-descr">
          <?php the_field('home_products_info_descr'); ?>
          <a href="#" class="link home-products__link">В каталог
            <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.8333 5.83337L15 10L10.8333 14.1667M5 5.83337L9.16667 10L5 14.1667" stroke="currentColor" stroke-width="1.5" stroke-linecap="square" />
            </svg>
          </a>
        </div>
        <div class="home-products__cover">
          <?php
          $image_id = get_field('home_products_img');
          if ($image_id) {
            echo wp_get_attachment_image($image_id, 'full', false, array('class' => 'home-products__cover-img'));
          }
          ?>
        </div>
        <div class="home-products__additional">
          <div class="home-products__additional-title">
            <?php the_field('home_products_additional_subtitle'); ?>
          </div>
          <div class="home-products__additional-descr">
            <?php the_field('home_products_additional_descr'); ?>
          </div>
        </div>
      </div>
      <div class="section-line"></div>
    </div>
  </div>
</section>
