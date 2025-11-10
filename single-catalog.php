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
              <a class="btn product-main__buy-btn" href="https://electro-batt.spb.ru/agm-akkumulyatory-electro-batt" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 511.343 511.343" fill="currentColor">
                  <path d="M490.334 106.668H90.526l-5.943-66.207c-.972-10.827-10.046-19.123-20.916-19.123H21c-11.598 0-21 9.402-21 21s9.402 21 21 21h23.468C57.293 206.22 24.147-163.077 68.621 332.427c1.714 19.394 12.193 40.439 30.245 54.739C66.319 428.73 96.057 490.005 149 490.005c43.942 0 74.935-43.826 59.866-85.334h114.936c-15.05 41.455 15.876 85.334 59.866 85.334 35.106 0 63.667-28.561 63.667-63.667s-28.561-63.667-63.667-63.667H149.142c-15.952 0-29.853-9.624-35.853-23.646l335.608-19.724a21 21 0 0 0 19.141-15.87l42.67-170.67c3.308-13.234-6.71-26.093-20.374-26.093M149 448.005c-11.946 0-21.666-9.72-21.666-21.667s9.72-21.667 21.666-21.667 21.667 9.72 21.667 21.667-9.72 21.667-21.667 21.667m234.667 0c-11.947 0-21.667-9.72-21.667-21.667s9.72-21.667 21.667-21.667 21.667 9.72 21.667 21.667-9.72 21.667-21.667 21.667m47.366-169.726-323.397 19.005-13.34-148.617h369.142z" />
                </svg>
                Купить в Альфа Электро</a>
              <?php if (get_field('product_buy_link')): ?>
                <a class="btn product-main__buy-btn" href="<?php the_field('product_buy_link'); ?>" target="_blank">
                  <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 511.343 511.343" fill="currentColor">
                    <path d="M490.334 106.668H90.526l-5.943-66.207c-.972-10.827-10.046-19.123-20.916-19.123H21c-11.598 0-21 9.402-21 21s9.402 21 21 21h23.468C57.293 206.22 24.147-163.077 68.621 332.427c1.714 19.394 12.193 40.439 30.245 54.739C66.319 428.73 96.057 490.005 149 490.005c43.942 0 74.935-43.826 59.866-85.334h114.936c-15.05 41.455 15.876 85.334 59.866 85.334 35.106 0 63.667-28.561 63.667-63.667s-28.561-63.667-63.667-63.667H149.142c-15.952 0-29.853-9.624-35.853-23.646l335.608-19.724a21 21 0 0 0 19.141-15.87l42.67-170.67c3.308-13.234-6.71-26.093-20.374-26.093M149 448.005c-11.946 0-21.666-9.72-21.666-21.667s9.72-21.667 21.666-21.667 21.667 9.72 21.667 21.667-9.72 21.667-21.667 21.667m234.667 0c-11.947 0-21.667-9.72-21.667-21.667s9.72-21.667 21.667-21.667 21.667 9.72 21.667 21.667-9.72 21.667-21.667 21.667m47.366-169.726-323.397 19.005-13.34-148.617h369.142z" />
                  </svg>
                  Купить во ВсеИнструменты
                </a>
              <?php endif; ?>
            </div>
            <div class="product-main__char-buttons">
              <button class="btn btn--outline-accent product-main__char-cta" data-form="true" data-title="<?php echo esc_attr(wp_get_document_title()); ?>" data-info="Заявка со страницы товара">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 64 64" fill="currentColor" width="18" height="18">
                  <path d="M27 54a2 2 0 1 0 0-4h-8a2 2 0 1 0 0 4zm11-17a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.867-22A3.867 3.867 0 0 0 35 18.867a2 2 0 0 1-4 0A7.867 7.867 0 0 1 38.867 11H39c4.428 0 8 3.614 8 8.022 0 4.08-3.043 7.484-7 8V29a2 2 0 1 1-4 0v-3.911a2 2 0 0 1 2-2h.956c2.224 0 4.044-1.824 4.044-4.067C43 16.803 41.2 15 39 15z" />
                  <path fill-rule="evenodd" d="M10 2a8 8 0 0 0-8 8v44a8 8 0 0 0 8 8h26a8 8 0 0 0 8-8v-6.545C54.298 45.172 62 35.985 62 25 62 12.297 51.703 2 39 2q-.954 0-1.89.076A8 8 0 0 0 36 2zm29 46q.502 0 1-.021V54a4 4 0 0 1-4 4H10a4 4 0 0 1-4-4V10a4 4 0 0 1 4-4h16.035C19.976 10.142 16 17.107 16 25a22.92 22.92 0 0 0 6 15.492V46a2 2 0 0 0 2.002 2c5-.005 9.998 0 14.998 0m0-42c-10.493 0-19 8.507-19 19 0 5.178 2.068 9.868 5.428 13.297a2 2 0 0 1 .572 1.4v4.302c4.334-.003 8.667.001 13 .001 10.493 0 19-8.507 19-19S49.493 6 39 6" />
                </svg> -->
                <!-- <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 32 32" fill="
                currentColor">
                  <path d="M24.8 0H7.2A3.176 3.176 0 0 0 4 3.143v25.714A3.176 3.176 0 0 0 7.2 32h17.6a3.176 3.176 0 0 0 3.2-3.143V3.143A3.176 3.176 0 0 0 24.8 0M12.254 6.201A3.859 3.859 0 1 1 17.86 10.7a1.82 1.82 0 0 0-.926 1.557v.1a1 1 0 0 1-2 0v-.1a3.82 3.82 0 0 1 1.926-3.29 1.855 1.855 0 0 0 .88-2.06 1.83 1.83 0 0 0-1.355-1.355 1.86 1.86 0 0 0-2.056.871 1.8 1.8 0 0 0-.166.375 1 1 0 0 1-1.91-.597ZM16.93 15.5a.7.7 0 0 1-.02.2 1 1 0 0 1-.05.18l-.09.18a2 2 0 0 1-.13.15 1.01 1.01 0 0 1-.71.29.84.84 0 0 1-.38-.08 1 1 0 0 1-.32-.21 2 2 0 0 1-.13-.15l-.09-.18-.06-.18a2 2 0 0 1-.02-.2 1.02 1.02 0 0 1 .3-.71 1.034 1.034 0 0 1 1.41 0 1 1 0 0 1 .29.71M23 28H9a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2m0-4H9a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2m0-4H9a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2" />
                </svg> -->
                <!-- <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 32 32" fill="currentColor">
                  <path d="M24.8 32H7.2A3.176 3.176 0 0 1 4 28.857V3.143A3.176 3.176 0 0 1 7.2 0h17.6A3.176 3.176 0 0 1 28 3.143v25.714A3.176 3.176 0 0 1 24.8 32M7.2 2A1.174 1.174 0 0 0 6 3.143v25.714A1.174 1.174 0 0 0 7.2 30h17.6a1.174 1.174 0 0 0 1.2-1.143V3.143A1.174 1.174 0 0 0 24.8 2Z" />
                  <path d="M23 20H9a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2m0 4H9a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2m0 4H9a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2m-7.065-14.643a1 1 0 0 1-1-1v-.1a3.82 3.82 0 0 1 1.926-3.29 1.855 1.855 0 0 0 .879-2.06 1.83 1.83 0 0 0-1.355-1.355 1.86 1.86 0 0 0-2.056.871 1.8 1.8 0 0 0-.166.375 1 1 0 0 1-1.91-.597A3.859 3.859 0 1 1 17.86 10.7a1.82 1.82 0 0 0-.926 1.557v.1a1 1 0 0 1-1 1ZM15.93 16.5a.84.84 0 0 1-.38-.08 1 1 0 0 1-.32-.21 2 2 0 0 1-.13-.15l-.09-.18-.06-.18a2 2 0 0 1-.02-.2 1.02 1.02 0 0 1 .3-.71 1.034 1.034 0 0 1 1.41 0 1 1 0 0 1 .29.71.7.7 0 0 1-.02.2 1 1 0 0 1-.05.18l-.09.18a2 2 0 0 1-.13.15 1.01 1.01 0 0 1-.71.29" />
                </svg> -->
                Оставить заявку
              </button>
              <?php if (get_field('product_passport')): ?>
                <a download href="<?php the_field('product_passport'); ?>" class="product-main__char-passport btn btn--outline-accent">
                  <!-- <svg aria-hidden="true">
                    <use href="<?php echo get_template_directory_uri() . '/assets/media/sprite.svg?ver=1.2#icon-doc'; ?>"></use>
                  </svg> -->
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" viewBox="0 0 512 512" fill="currentColor">
                    <path d="M446.605 124.392 326.608 4.395A15.02 15.02 0 0 0 316 0H106C81.187 0 61 20.187 61 45v422c0 24.813 20.187 45 45 45h300c24.813 0 45-20.187 45-45V135c0-4.09-1.717-7.931-4.395-10.608M331 51.213 399.787 120H346c-8.271 0-15-6.729-15-15zM406 482H106c-8.271 0-15-6.729-15-15V45c0-8.271 6.729-15 15-15h195v75c0 24.813 20.187 45 45 45h75v317c0 8.271-6.729 15-15 15" />
                    <path d="M346 212H166c-8.284 0-15 6.716-15 15s6.716 15 15 15h180c8.284 0 15-6.716 15-15s-6.716-15-15-15m0 60H166c-8.284 0-15 6.716-15 15s6.716 15 15 15h180c8.284 0 15-6.716 15-15s-6.716-15-15-15m0 60H166c-8.284 0-15 6.716-15 15s6.716 15 15 15h180c8.284 0 15-6.716 15-15s-6.716-15-15-15m-60 60H166c-8.284 0-15 6.716-15 15s6.716 15 15 15h120c8.284 0 15-6.716 15-15s-6.716-15-15-15" />
                  </svg> -->
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
