<?php

get_header();

?>

<main class="main page page--product page-product section-light">

  <?php while (have_posts()) : the_post(); ?>
    <div class="container">
      <div class="product-main">
        <div class="breadcrumbs">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div class="breadcrumbs__row" id="breadcrumbs-row">', '</div>');
          }
          ?>
        </div>
        <div class="product-main__inner">
          <div class="product-main__cover">
            <?php
            $image_id = get_field('product_image'); // Получаем ID изображения
            $image_url = wp_get_attachment_image_url($image_id, 'full');

            if ($image_id && $image_url):
            ?>
              <a href="<?php echo $image_url; ?>" class="link glightbox" data-gallery="product-main">
                <?php echo wp_get_attachment_image($image_id, 'full', false, array(
                  'class' => 'product-main__cover-img',
                  'alt' => 'Главное изображение товара',
                )); ?>
              </a>
            <?php endif; ?>
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

            <div class="product-main__char-descr">
              <div class="product-main__char-descr-column">
                <?php the_field('product_head_descr_left'); ?>
              </div>
              <div class="product-main__char-descr-column">
                <?php the_field('product_head_descr_right'); ?>
              </div>

            </div>


            <div class="product-main__char-buttons">
              <button class="btn product-main__char-cta" data-form="true" data-title="<?php echo esc_attr(wp_get_document_title()); ?>" data-info="Заявка со страницы товара">Оставить заявку</button>
              <?php if (get_field('product_buy_link')): ?>
                <a class="btn product-main__buy-btn" href="<?php the_field('product_buy_link'); ?>" target="_blank">Купить во ВсеИнструменты</a>
              <?php endif; ?>
              <?php if (get_field('product_passport')): ?>
                <a download href="<?php the_field('product_passport'); ?>" class="product-main__char-passport btn btn--outline-accent">
                  <svg aria-hidden="true">
                    <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.2#icon-doc'; ?>"></use>
                  </svg>
                  Скачать паспорт
                </a>
              <?php endif; ?>
            </div>

          </div>
        </div>
        <div class="product-parameters">
          <div class="product-parameters__col product-parameters__col--sm">
            <?php if (have_rows('product_application_areas')): ?>
              <section class="application-area">
                <h2 class="application-area__title page-product__subtitle">Сферы применения</h2>
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
                <h2 class="product-features__title page-product__subtitle">Особенности</h2>
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
            <?php if (get_field('product_passport')): ?>
              <a download href="<?php the_field('product_passport'); ?>" class="product-parameters__passport btn btn--outline-accent">
                <svg aria-hidden="true">
                  <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.2#icon-doc'; ?>"></use>
                </svg>
                Открыть паспорт</a>
            <?php endif; ?>
            <div class="product-charts">

              <?php
              $image_live_on_depth = get_field('live_on_depth_disharge_img');
              $image_url = wp_get_attachment_image_url($image_live_on_depth, 'full');

              if ($image_live_on_depth && $image_url):
              ?>
                <div class="product-charts__title">Зависимость срока службы от глубины разряда:</div>
                <a href="<?php echo $image_url; ?>" class="link glightbox" data-gallery="product-tables">
                  <?php echo wp_get_attachment_image($image_live_on_depth, 'full', false, array(
                    'class' => 'product-charts__img',
                    'alt' => 'Изображение зависимости срока службы от глубины зарзряда',
                  )); ?>
                </a>
              <?php endif;

              $charge_char = get_field('charging_characteristics_img');
              $image_url = wp_get_attachment_image_url($charge_char, 'full');
              if ($charge_char && $image_url):
              ?>
                <div class="product-charts__title">Зарядные характеристики:</div>
                <a href="<?php echo $image_url; ?>" class="link glightbox" data-gallery="product-tables">
                  <?php echo wp_get_attachment_image($charge_char, 'full', false, array(
                    'class' => 'product-charts__img',
                    'alt' => 'Изображение зарядных характеристик',
                  )); ?>
                </a>
              <?php endif;

              $discharge_char = get_field('discharging_characteristics_img');
              $image_url = wp_get_attachment_image_url($discharge_char, 'full');
              if ($discharge_char && $image_url):
              ?>
                <div class="product-charts__title">Разрядные характеристики:</div>
                <a href="<?php echo $image_url; ?>" class="link glightbox" data-gallery="product-tables">
                  <?php echo wp_get_attachment_image($discharge_char, 'full', false, array(
                    'class' => 'product-charts__img',
                    'alt' => 'Изображение разрядных характеристик',
                  )); ?>
                </a>

              <?php endif; ?>


            </div>
          </div>
          <div class="product-parameters__col product-parameters__col--lg">
            <section class="main-chars">
              <h2 class="page-product__subtitle main-chars__title">Основные характеристики</h2>
              <ul class="main-chars__list">
                <?php if (get_field('')): ?>
                  <li class="main-chars__item">
                    <div class="main-chars__item-label">

                    </div>
                    <div class="main-chars__item-value">

                    </div>
                  </li>
                <?php endif; ?>
                <?php if (get_field('product_rated_voltage')): ?>
                  <li class="main-chars__item">
                    <div class="main-chars__item-label">
                      Номинальное напряжение, В
                    </div>
                    <div class="main-chars__item-value">
                      <?php the_field('product_rated_voltage'); ?>
                    </div>
                  </li>
                <?php endif; ?>
                <?php if (get_field('product_rated_power')): ?>
                  <li class="main-chars__item">
                    <div class="main-chars__item-label">
                      Номинальная ёмкость, A∙ч (20ч р.р. до 10,8 В)
                    </div>
                    <div class="main-chars__item-value">
                      <?php the_field('product_rated_power'); ?>
                    </div>
                  </li>
                <?php endif; ?>
                <?php if (get_field('product_internal_resistance')): ?>
                  <li class="main-chars__item">
                    <div class="main-chars__item-label">
                      Внутреннее сопротивление полностью заряженной батареи (25°C)
                    </div>
                    <div class="main-chars__item-value">
                      <?php the_field('product_internal_resistance'); ?>
                    </div>
                  </li>
                <?php endif; ?>
                <?php if (get_field('product_maximum_discharge_current')): ?>
                  <li class="main-chars__item">
                    <div class="main-chars__item-label">
                      Максимальный разрядный ток (25°C)
                    </div>
                    <div class="main-chars__item-value">
                      <?php the_field('product_maximum_discharge_current'); ?>
                    </div>
                  </li>
                <?php endif; ?>
              </ul>
              <?php if (get_field('product_charge_constant_voltage_cycle') || get_field('product_charge_constant_voltage_buffer')): ?>
                <div class="main-chars__charge">
                  <h3 class="main-chars__charge-title">
                    Заряд (при постоянном напряжении, 25°C):
                  </h3>
                  <ul class="main-chars__charge-list">
                    <?php if (get_field('product_charge_constant_voltage_cycle')): ?>
                      <li class="main-chars__charge-item">

                        <div class="main-chars__charge-label">
                          Цикл:
                        </div>
                        <div class="main-chars__charge-value">
                          <?php the_field('product_charge_constant_voltage_cycle'); ?>
                        </div>
                      </li>
                    <?php endif; ?>
                    <?php if (get_field('product_charge_constant_voltage_buffer')): ?>
                      <li class="main-chars__charge-item">

                        <div class="main-chars__charge-label">
                          Буфер:
                        </div>
                        <div class="main-chars__charge-value">
                          <?php the_field('product_charge_constant_voltage_buffer'); ?>
                        </div>
                      </li>
                    <?php endif; ?>
                  </ul>
                </div>
              <?php endif; ?>
              <h3 class="main-chars__subtitle">Саморазряд (25°C):</h3>
              <ul class="main-chars__list">
                <li class="main-chars__item">
                  <div class="main-chars__label">
                    Ёмкость после 3 месяцев хранения
                  </div>
                  <div class="main-chars__value">
                    <?php the_field('product_capacity_3_month'); ?>
                  </div>
                </li>
                <li class="main-chars__item">
                  <div class="main-chars__label">
                    После 6 месяцев хранения
                  </div>
                  <div class="main-chars__value">
                    <?php the_field('product_capacity_6_month'); ?>
                  </div>
                </li>
                <li class="main-chars__item">
                  <div class="main-chars__label">
                    После 12 месяцев хранения
                  </div>
                  <div class="main-chars__value">
                    <?php the_field('product_capacity_12_month'); ?>
                  </div>
                </li>
              </ul>
              <h3 class="main-chars__subtitle">Влияние температуры на емкость (20-часовой разряд):</h3>
              <ul class="main-chars__list">
                <li class="main-chars__item">
                  <div class="main-chars__label">
                    40 °C
                  </div>
                  <div class="main-chars__value">
                    <?php the_field('product_temp_per_capacity_40'); ?>
                  </div>
                </li>
                <li class="main-chars__item">
                  <div class="main-chars__label">
                    25 °C
                  </div>
                  <div class="main-chars__value">
                    <?php the_field('product_temp_per_capacity_25'); ?>
                  </div>
                </li>
                <li class="main-chars__item">
                  <div class="main-chars__label">
                    0 °C
                  </div>
                  <div class="main-chars__value">
                    <?php the_field('product_temp_per_capacity_0'); ?>
                  </div>
                </li>
                <li class="main-chars__item">
                  <div class="main-chars__label">
                    -15 °C
                  </div>
                  <div class="main-chars__value">
                    <?php the_field('product_temp_per_capacity_minus_15'); ?>
                  </div>
                </li>
              </ul>

            </section>
            <section class="product-sizes">

              <div class="product-sizes__inner">
                <div class="product-sizes__content">
                  <h2 class="page-product__subtitle product-sizes__title">Конструкция, размеры</h2>
                  <ul class="product-sizes__list product-table">

                    <li class="product-table__item">
                      <div class="product-table__label">
                        Общая высота, мм
                      </div>
                      <div class="product-table__value">
                        <?php the_field('product_overall_height'); ?>
                      </div>
                    </li>
                    <li class="product-table__item">
                      <div class="product-table__label">
                        Высота, мм
                      </div>
                      <div class="product-table__value">
                        <?php the_field('product_height'); ?>
                      </div>
                    </li>
                    <li class="product-table__item">
                      <div class="product-table__label">
                        Длина, мм
                      </div>
                      <div class="product-table__value">
                        <?php the_field('product_length'); ?>
                      </div>
                    </li>
                    <li class="product-table__item">
                      <div class="product-table__label">
                        Ширина, мм
                      </div>
                      <div class="product-table__value">
                        <?php the_field('product_width'); ?>
                      </div>
                    </li>
                    <li class="product-table__item">
                      <div class="product-table__label">
                        Вес, кг
                      </div>
                      <div class="product-table__value">
                        <?php the_field('product_weight'); ?>
                      </div>
                    </li>
                    <li class="product-table__item">
                      <div class="product-table__label">
                        Тип клемм
                      </div>
                      <div class="product-table__value">
                        <?php the_field('product_type_terminal'); ?>
                      </div>
                    </li>
                  </ul>
                </div>

                <div class="product-sizes__cover">
                  <?php
                  $image_id = get_field('product_sizes_img'); // Получаем ID изображения
                  $image_url = wp_get_attachment_image_url($image_id, 'full');

                  if ($image_id && $image_url):
                  ?>
                    <a href="<?php echo $image_url; ?>" class="link glightbox" data-gallery="product-sizes">
                      <?php echo wp_get_attachment_image($image_id, 'full', false, array(
                        'class' => 'product-sizes__img',
                        'alt' => 'Конструкция и размеры - изображение',
                      )); ?>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </section>
            <?php
            $image_disharge_current = get_field('direct_current_discharge_img'); // Получаем ID изображения
            $image_url = wp_get_attachment_image_url($image_disharge_current, 'full');

            if ($image_disharge_current && $image_url): ?>
              <section class="discharge-current">
                <h2 class="page-product__subtitle">РАЗРЯД ПОСТОЯННЫМ ТОКОМ (A, 25°C):</h2>
                <a href="<?php echo $image_url; ?>" class="link glightbox" data-gallery="product-d-current">
                  <?php echo wp_get_attachment_image($image_disharge_current, 'full', false, array(
                    'class' => 'discharge-current__img',
                    'alt' => 'Изображение с характеристиками разряда постоянным током',
                  )); ?>
                </a>
              </section>
            <?php endif;

            $image_disharge_power = get_field('direct_power_discharge_img'); // Получаем ID изображения
            $image_url = wp_get_attachment_image_url($image_disharge_power, 'full');

            if ($image_disharge_power && $image_url): ?>
              <section class="discharge-power">
                <h2 class="page-product__subtitle">РАЗРЯД ПОСТОЯННОЙ МОЩНОСТЬЮ (ВТ, 25°C):</h2>
                <a href="<?php echo $image_url; ?>" class="link glightbox" data-gallery="product-d-power">
                  <?php echo wp_get_attachment_image($image_disharge_power, 'full', false, array(
                    'class' => 'discharge-power__img',
                    'alt' => 'Изображение с характеристиками разряда постоянной мощностью',
                  )); ?>
                </a>
              </section>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="section-line"></div>
    </div>

  <?php endwhile; ?>


</main>

<?php
get_footer();
