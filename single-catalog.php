<?php

get_header();

?>

<main class="main page page--product page-product">

  <?php while (have_posts()) : the_post(); ?>
    <div class="container">
      <div class="product-main">
        <div class="breadcrumbs">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
          }
          ?>
        </div>
        <div class="product-main__inner">
          <div class="product-main__cover">
            <?php
            $image_id = get_field('product_image');
            if ($image_id) {
              echo wp_get_attachment_image($image_id, 'full', false, array('class' => 'product-main__cover-img'));
            }
            ?>
          </div>
          <div class="product-main__head">
            <div class="product-main__parameters">
              <?php echo get_field('product_rated_voltage') . ' В ' . get_field('product_rated_power') . ' Ач'; ?>
            </div>
            <h1 class="page__title product-main__title">
              <?php the_title(); ?>
            </h1>

          </div>
          <div class="product-main__char">
            <ul class="product-main__char-list">
              <?php if (get_field('product_rated_voltage')): ?>
                <li class="product-main__char-item">
                  <div class="product-main__char-label">Номинальное напряжение, В</div>
                  <div class="product-main__char-value"><?php the_field('product_rated_voltage'); ?></div>
                </li>
              <?php endif; ?>
              <?php if (get_field('product_rated_power')): ?>
                <li class="product-main__char-item">
                  <div class="product-main__char-label">Номинальная ёмкость, A∙ч (20ч р.р. до 10,8 В)</div>
                  <div class="product-main__char-value"><?php the_field('product_rated_power'); ?></div>
                </li>
              <?php endif; ?>
              <?php if (get_field('product_internal_resistance')): ?>
                <li class="product-main__char-item">
                  <div class="product-main__char-label">Внутреннее сопротивление
                    полностью заряженной батареи (25°C)</div>
                  <div class="product-main__char-value"><?php the_field('product_internal_resistance'); ?></div>
                </li>
              <?php endif; ?>
              <?php if (get_field('product_maximum_discharge_current')): ?>
                <li class="product-main__char-item">
                  <div class="product-main__char-label">Максимальный разрядный ток (25°C)</div>
                  <div class="product-main__char-value"><?php the_field('product_maximum_discharge_current'); ?></div>
                </li>
              <?php endif; ?>
            </ul>
            <button class="btn product-main__char-cta" data-form="true">Оставить заявку</button>
          </div>
        </div>
        <div class="product-parameters">
          <?php if (have_rows('product_application_areas')): ?>
            <section class="application-area">
              <h2 class="application-area__title">Сферы применения</h2>
              <ul class="application-area__list">
                <?php while (have_rows('product_application_areas')): the_row();
                  $item = get_sub_field('product_application_areas_item');
                ?>
                  <li class="application-area__item">
                    <?php echo $item; ?>
                  </li>
                <?php endwhile; ?>
              </ul>
            </section>
          <?php endif; ?>
          <?php if (have_rows('product_features_repeater')): ?>
            <section class="product-features">
              <h2 class="product-features__title">Особенности</h2>
              <ul class="product-features__list">
                <?php while (have_rows('product_features_repeater')): the_row();
                  $item = get_sub_field('product_features_repeater_item');
                ?>
                  <li class="product-features__item">
                    <?php echo $item; ?>
                  </li>
                <?php endwhile; ?>
              </ul>
            </section>
          <?php endif; ?>


        </div>
      </div>


    </div>

  <?php endwhile; ?>


</main>

<?php
get_footer();
