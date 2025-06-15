<?php
// Define version
if (!defined('_VER')) {
  define('_VER', '0.111111139');
}

// Add theme support
add_action('after_setup_theme', 'rsmtheme_setup');

function rsmtheme_setup()
{
  add_theme_support('menus');
  add_theme_support('title-tag');
  register_nav_menus(
    [
      'header_menu' => 'Меню в шапке',
      'footer_production' => 'Продукция в футере',
      'footer_menu' => 'Меню в футере общее',
    ]
  );

  add_theme_support('html5', [
    'comment-list',
    'comment-form',
    'search-form',
    'gallery',
    'caption',
    'script',
    'style',
  ]);
}

// Add theme styles and scripts
add_action('wp_enqueue_scripts', 'rsmtheme_scripts');
function rsmtheme_scripts()
{
  wp_enqueue_style('swiper', get_stylesheet_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '11.2.8');
  wp_enqueue_style('glightbox', get_stylesheet_directory_uri() . '/assets/css/glightbox.min.css', array(), '3.3.1');
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/css/style.min.css', array(), _VER);

  wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '11.2.8', true);

  wp_enqueue_script('glightbox', get_template_directory_uri() . '/assets/js/glightbox.min.js', array(), '3.3.1', true);
  wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.min.js', array(), _VER, true);
}

require_once(get_template_directory() . '/inc/register-taxonomy.php');
require_once(get_template_directory() . '/inc/register-post-type.php');
require_once(get_template_directory() . '/inc/class-rsmelectro-header-nav.php');

require_once(get_template_directory() . '/inc/remove-trash.php');

/**
 * ACF Options page
 */

if (function_exists('acf_add_options_page')) {
  acf_add_options_page([
    'page_title'    => 'Основные настройки темы',
    'menu_title'    => 'Настройки темы',
    'menu_slug'     => 'theme-general-settings',
    'capability'    => 'edit_posts',
    'redirect'      => false,
    'position' => 1,
  ]);
}

/**
 * Remove p and br tags on contact form 7
 */

add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Расположить админ-панель внизу
 */

/*
 * Отключение стандартных CSS в HTML-коде
 */
function my_filter_head()
{
  remove_action('wp_head', '_admin_bar_bump_cb');
}

add_action('get_header', 'my_filter_head');

/*
 * CSS для прилепления админки к нижнему краю страницы
 */
function true_move_admin_bar()
{
  if (is_admin_bar_showing()) { // проверяем, показывается ли админ-бар
    echo '
        <style type="text/css">
        html{margin-bottom:32px !important}
        * html body{margin-bottom:32px !important}
        #wpadminbar{top:auto !important;bottom:0}
        #wpadminbar .menupop .ab-sub-wrapper{bottom:32px;-moz-box-shadow:2px -2px 5px rgba(0,0,0,.2);-webkit-box-shadow:2px -2px 5px rgba(0,0,0,.2);box-shadow:2px -2px 5px rgba(0,0,0,.2)}
        @media screen and ( max-width:782px ){
            html{margin-bottom:46px !important}
            * html body{margin-bottom:46px !important}
            #wpadminbar{position:fixed}
            #wpadminbar .menupop .ab-sub-wrapper{bottom:46px}
        }
        </style>
        ';
  }
}

add_action('wp_head', 'true_move_admin_bar');

/**
 * Изменим текст в хлебных крошках Yoast SEO для каталога продукции с "Каталог продукции" на "Каталог"
 */

add_filter('wpseo_breadcrumb_links', 'change_catalog_breadcrumb_label_everywhere', 10, 1);

function change_catalog_breadcrumb_label_everywhere($links)
{
  // Меняем текст на странице архива
  if (is_post_type_archive('catalog')) {
    foreach ($links as $key => $link) {
      if (isset($link['ptarchive']) && $link['ptarchive'] === 'catalog') {
        $links[$key]['text'] = 'Каталог';
      }
    }
  }

  // Меняем текст на странице одиночной записи типа catalog
  if (is_singular('catalog')) {
    foreach ($links as $key => $link) {
      if (isset($link['ptarchive']) && $link['ptarchive'] === 'catalog') {
        $links[$key]['text'] = 'Каталог';
      }
    }
  }

  return $links;
}

/**
 * Изменим выдачу на archive-catalog.php - отсортируем товары по кастомну полю product_rated_power от большего к меньшему
 */

function sort_catalog_by_power($query)
{
  if (!is_admin() && $query->is_main_query() && is_post_type_archive('catalog')) {
    $query->set('meta_key', 'product_rated_power');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
  }
}
add_action('pre_get_posts', 'sort_catalog_by_power');

/**
 * Форма подбора АКБ
 */

function get_unique_acf_values($field_name)
{
  global $wpdb;

  $results = $wpdb->get_col($wpdb->prepare("
    SELECT DISTINCT meta_value FROM $wpdb->postmeta
    WHERE meta_key = %s AND meta_value != ''
  ", $field_name));

  return array_filter(array_unique($results));
}

// Получение уникальных значений ACF Repeater-поля
function get_unique_repeater_values($post_type, $repeater_field, $sub_field)
{
  $unique_values = [];

  $posts = get_posts([
    'post_type'      => $post_type,
    'posts_per_page' => -1,
    'post_status'    => 'publish',
  ]);

  foreach ($posts as $post) {
    if (have_rows($repeater_field, $post->ID)) {
      while (have_rows($repeater_field, $post->ID)) {
        the_row();
        $value = get_sub_field($sub_field);
        if (!empty($value)) {
          $unique_values[] = $value;
        }
      }
    }
  }

  return array_unique($unique_values);
}


// Регистрируем шорткод формы
add_shortcode('catalog_filter_form', 'render_catalog_filter_form');
function render_catalog_filter_form()
{
  ob_start();
?>
  <section class="selection">
    <h2 class="selection__title">Заполните условия выбора</h2>

    <form id="catalog-filter-form" class="selection__form">
      <div class="selection__item-wrapper">
        <select name="voltage" id="voltage">
          <option value="">Напряжение</option>
          <?php foreach (get_unique_acf_values('product_rated_voltage') as $value): ?>
            <option value="<?= esc_attr($value) ?>"><?= esc_html($value) . ' В'; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="selection__item-wrapper">
        <select name="power" id="power">
          <option value="">Ёмкость</option>
          <?php foreach (get_unique_acf_values('product_rated_power') as $value): ?>
            <option value="<?= esc_attr($value) ?>"><?= esc_html($value) . ' Ач'; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="selection__item-wrapper">
        <select name="service-life" id="service-life">
          <option value="">Срок службы</option>
          <?php foreach (get_unique_acf_values('product_service_life') as $value): ?>
            <option value="<?= esc_attr($value) ?>"><?= esc_html($value) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="selection__item-wrapper selection__item-wrapper--fullwidth">
        <label for="application_area">Сферы применения:</label>
        <select name="application_area[]" id="application_area" multiple size="6">
          <?php
          $areas = get_unique_repeater_values('catalog', 'product_application_areas', 'product_application_areas_item');
          foreach ($areas as $value):
            $escaped_value = esc_attr($value);
          ?>
            <option value="<?= $escaped_value ?>"><?= esc_html($value) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <button class="btn selection__btn-submit" type="submit">Подобрать</button>
      <button type="button" id="reset-filters" style="display: none;">Сбросить параметры</button>

    </form>
  </section>

  <div id="catalog-results"></div>
  <?php
  return ob_get_clean();
}

// Ajax обработка фильтра
add_action('wp_ajax_filter_catalog', 'handle_catalog_filter');
add_action('wp_ajax_nopriv_filter_catalog', 'handle_catalog_filter');

function handle_catalog_filter()
{
  $args = [
    'post_type' => 'catalog',
    'posts_per_page' => -1,
    'meta_query' => ['relation' => 'AND'],
  ];

  if (!empty($_POST['voltage'])) {
    $args['meta_query'][] = [
      'key' => 'product_rated_voltage',
      'value' => sanitize_text_field($_POST['voltage']),
      'compare' => '=',
    ];
  }

  if (!empty($_POST['power'])) {
    $args['meta_query'][] = [
      'key' => 'product_rated_power',
      'value' => sanitize_text_field($_POST['power']),
      'compare' => '=',
    ];
  }

  if (!empty($_POST['service-life'])) {
    $args['meta_query'][] = [
      'key' => 'product_service_life',
      'value' => sanitize_text_field($_POST['service-life']),
      'compare' => '=',
    ];
  }

  // Исправленная фильтрация по repeater-полю application_area
  if (!empty($_POST['application_area'])) {
    // Если пришел массив, используем его, если строка - преобразуем в массив
    $application_areas = is_array($_POST['application_area']) ? $_POST['application_area'] : [$_POST['application_area']];

    // Получаем все посты, которые содержат хотя бы одну из выбранных областей применения
    global $wpdb;
    $area_conditions = [];

    foreach ($application_areas as $area) {
      $area_conditions[] = $wpdb->prepare("meta_value = %s", sanitize_text_field($area));
    }

    if (!empty($area_conditions)) {
      $area_condition_string = implode(' OR ', $area_conditions);

      $post_ids = $wpdb->get_col("
        SELECT DISTINCT post_id
        FROM {$wpdb->postmeta}
        WHERE meta_key LIKE 'product_application_areas_%_product_application_areas_item'
        AND ({$area_condition_string})
      ");

      if (!empty($post_ids)) {
        $args['post__in'] = $post_ids;
      } else {
        // Если не найдено ни одного поста, возвращаем пустой результат
        $args['post__in'] = [0];
      }
    }
  }

  $query = new WP_Query($args);
  $posts = $query->posts;

  if (!empty($posts)) : ?>
    <ul class="page-catalog__list">
      <?php global $post; ?>
      <?php foreach ($posts as $post) : setup_postdata($post); ?>
        <li class="page-catalog__item catalog-card">
          <a href="<?php the_permalink(); ?>" class="catalog-card__link">
            <div class="catalog-card__cover">
              <?php
              $image = get_field('product_image');
              if ($image) {
                echo wp_get_attachment_image($image, 'full', false, ['class' => 'catalog-card__image']);
              }
              ?>
            </div>
            <div class="catalog-card__content">
              <h2 class="catalog-card__title"><?php the_title(); ?></h2>
              <div class="catalog-card__property">
                <?= get_field('product_rated_voltage') . ' В ' . get_field('product_rated_power') . ' Ач'; ?>
              </div>
            </div>
          </a>
          <button class="btn catalog-card__cta" data-form="true" data-title="<?php echo esc_attr(get_the_title()); ?>"
            data-info="<?php echo esc_attr($voltage . ' В ' . $power . ' Ач'); ?>">Оставить заявку</button>
        </li>
      <?php endforeach; ?>
      <?php wp_reset_postdata(); ?>
    </ul>
  <?php else : ?>
    <p>Ничего не найдено.</p>
  <?php endif;

  wp_die();
}


add_action('wp_enqueue_scripts', 'enqueue_catalog_filter_scripts');
function enqueue_catalog_filter_scripts()
{
  wp_enqueue_script('catalog-filter-js', get_template_directory_uri() . '/assets/js/catalog-filter.js', ['jquery'], null, true);
  wp_localize_script('catalog-filter-js', 'catalog_filter_vars', [
    'ajax_url' => admin_url('admin-ajax.php'),
  ]);
}


add_action('wp_ajax_get_filter_options', 'handle_get_filter_options');
add_action('wp_ajax_nopriv_get_filter_options', 'handle_get_filter_options');

function handle_get_filter_options()
{
  // Начинаем с базового запроса
  $base_args = [
    'post_type' => 'catalog',
    'posts_per_page' => -1,
    'meta_query' => ['relation' => 'AND'],
  ];

  // Добавляем фильтры для получения пересечения результатов
  if (!empty($_POST['voltage'])) {
    $base_args['meta_query'][] = [
      'key' => 'product_rated_voltage',
      'value' => sanitize_text_field($_POST['voltage']),
      'compare' => '=',
    ];
  }

  if (!empty($_POST['power'])) {
    $base_args['meta_query'][] = [
      'key' => 'product_rated_power',
      'value' => sanitize_text_field($_POST['power']),
      'compare' => '=',
    ];
  }

  if (!empty($_POST['service-life'])) {
    $base_args['meta_query'][] = [
      'key' => 'product_service_life',
      'value' => sanitize_text_field($_POST['service-life']),
      'compare' => '=',
    ];
  }

  // Фильтрация по repeater-полю "Область применения"
  if (!empty($_POST['application_area'])) {
    $application_areas = is_array($_POST['application_area']) ? $_POST['application_area'] : [$_POST['application_area']];

    global $wpdb;
    $area_conditions = [];

    foreach ($application_areas as $area) {
      $area_conditions[] = $wpdb->prepare("meta_value = %s", sanitize_text_field($area));
    }

    if (!empty($area_conditions)) {
      $area_condition_string = implode(' OR ', $area_conditions);

      $post_ids = $wpdb->get_col("
        SELECT DISTINCT post_id
        FROM {$wpdb->postmeta}
        WHERE meta_key LIKE 'product_application_areas_%_product_application_areas_item'
        AND ({$area_condition_string})
      ");

      if (!empty($post_ids)) {
        $base_args['post__in'] = array_map('intval', $post_ids);
      } else {
        // Если не найдено ни одного поста, возвращаем пустые массивы
        wp_send_json([
          'voltage' => [],
          'power'   => [],
          'life'    => [],
          'areas'   => [],
        ]);
        return;
      }
    }
  }

  // Выполняем запрос
  $query = new WP_Query($base_args);
  $posts = $query->posts;

  // Сбор уникальных значений по фильтруемым полям
  $voltage = [];
  $power = [];
  $life = [];
  $areas = [];

  foreach ($posts as $post) {
    $voltage[] = get_field('product_rated_voltage', $post->ID);
    $power[]   = get_field('product_rated_power', $post->ID);
    $life[]    = get_field('product_service_life', $post->ID);

    if (have_rows('product_application_areas', $post->ID)) {
      while (have_rows('product_application_areas', $post->ID)) {
        the_row();
        $item = get_sub_field('product_application_areas_item');
        if (!empty($item)) {
          $areas[] = $item;
        }
      }
    }
  }

  // Отправляем JSON
  wp_send_json([
    'voltage' => array_values(array_unique(array_filter($voltage))),
    'power'   => array_values(array_unique(array_filter($power))),
    'life'    => array_values(array_unique(array_filter($life))),
    'areas'   => array_values(array_unique(array_filter($areas))),
  ]);
}

/**
 * Форма подбора АКБ по ИБП
 */

// ШОРТКОД ДЛЯ ФОРМЫ ФИЛЬТРА
function ups_filter_shortcode()
{
  ob_start();
  ?>

  <section class="selection">
    <h2 class="selection__title">Заполните условия выбора</h2>
    <div id="ups-filter">
      <form id="upsFilterForm" class="selection__form">
        <div class="selection__item-wrapper">
          <select name="brand" id="brandSelect">
            <option value="">Марка</option>
          </select>
        </div>

        <div class="selection__item-wrapper">
          <select name="series" id="seriesSelect">
            <option value="">Серия</option>
          </select>
        </div>

        <div class="selection__item-wrapper">
          <select name="ups_set" id="upsSetSelect">
            <option value="">Комплект батарей производ...</option>
          </select>
        </div>

        <button class="btn" type="submit">Подобрать</button>
      </form>
      <div id="filterResults"></div>
    </div>
  </section>
  <?php
  return ob_get_clean();
}
add_shortcode('ups_filter_form', 'ups_filter_shortcode');


// === AJAX: ЗАГРУЗКА МАРОК UPS ===
add_action('wp_ajax_load_ups_brands', 'load_ups_brands');
add_action('wp_ajax_nopriv_load_ups_brands', 'load_ups_brands');
function load_ups_brands()
{
  $brands = get_terms([
    'taxonomy' => 'ups_hierarchy',
    'hide_empty' => false,
    'parent' => 0
  ]);

  $result = [];
  foreach ($brands as $term) {
    $result[] = ['id' => $term->term_id, 'name' => $term->name];
  }

  wp_send_json($result);
}


// === AJAX: ЗАГРУЗКА СЕРИЙ ПО МАРКЕ ===
add_action('wp_ajax_load_ups_series', 'load_ups_series');
add_action('wp_ajax_nopriv_load_ups_series', 'load_ups_series');
function load_ups_series()
{
  $brand_id = intval($_POST['brand_id']);
  $series = get_terms([
    'taxonomy' => 'ups_hierarchy',
    'hide_empty' => false,
    'parent' => $brand_id
  ]);

  $result = [];
  foreach ($series as $term) {
    $result[] = ['id' => $term->term_id, 'name' => $term->name];
  }

  wp_send_json($result);
}


// === AJAX: ЗАГРУЗКА UPS_SET ПО СЕРИИ ===
add_action('wp_ajax_load_sets_by_series', 'load_sets_by_series');
add_action('wp_ajax_nopriv_load_sets_by_series', 'load_sets_by_series');
function load_sets_by_series()
{
  $series_id = intval($_POST['series_id']);

  $posts = get_posts([
    'post_type' => 'catalog',
    'posts_per_page' => -1,
    'tax_query' => [[
      'taxonomy' => 'ups_hierarchy',
      'field' => 'term_id',
      'terms' => $series_id,
    ]]
  ]);

  $set_ids = [];
  foreach ($posts as $post) {
    $terms = wp_get_post_terms($post->ID, 'ups_set');
    foreach ($terms as $term) {
      $set_ids[$term->term_id] = $term->name;
    }
  }

  $result = [];
  foreach ($set_ids as $id => $name) {
    $result[] = ['id' => $id, 'name' => $name];
  }

  wp_send_json($result);
}


// === AJAX: ФИЛЬТРАЦИЯ ТОВАРОВ ===
add_action('wp_ajax_filter_ups_catalog', 'filter_ups_catalog');
add_action('wp_ajax_nopriv_filter_ups_catalog', 'filter_ups_catalog');
function filter_ups_catalog()
{
  $tax_query = ['relation' => 'AND'];

  if (!empty($_POST['brand'])) {
    $tax_query[] = [
      'taxonomy' => 'ups_hierarchy',
      'field' => 'term_id',
      'terms' => intval($_POST['brand']),
      'include_children' => true,
    ];
  }

  if (!empty($_POST['series'])) {
    $tax_query[] = [
      'taxonomy' => 'ups_hierarchy',
      'field' => 'term_id',
      'terms' => intval($_POST['series']),
    ];
  }

  if (!empty($_POST['ups_set'])) {
    $tax_query[] = [
      'taxonomy' => 'ups_set',
      'field' => 'term_id',
      'terms' => intval($_POST['ups_set']),
    ];
  }

  $query = new WP_Query([
    'post_type' => 'catalog',
    'posts_per_page' => -1,
    'tax_query' => $tax_query,
  ]);

  $query = new WP_Query([
    'post_type' => 'catalog',
    'posts_per_page' => -1,
    'tax_query' => $tax_query,
  ]);
  $posts = $query->posts;

  if (!empty($posts)) : ?>
    <ul class="page-catalog__list">
      <?php global $post; ?>
      <?php foreach ($posts as $post) : setup_postdata($post); ?>
        <li class="page-catalog__item catalog-card">
          <a href="<?php the_permalink(); ?>" class="catalog-card__link">
            <div class="catalog-card__cover">
              <?php
              $image = get_field('product_image');
              if ($image) {
                echo wp_get_attachment_image($image, 'full', false, ['class' => 'catalog-card__image']);
              }
              ?>
            </div>
            <div class="catalog-card__content">
              <h2 class="catalog-card__title"><?php the_title(); ?></h2>
              <div class="catalog-card__property">
                <?= get_field('product_rated_voltage') . ' В ' . get_field('product_rated_power') . ' Ач'; ?>
              </div>
            </div>
          </a>
          <button class="btn catalog-card__cta" data-form="true" data-title="<?php echo esc_attr(get_the_title()); ?>"
            data-info="<?php echo esc_attr($voltage . ' В ' . $power . ' Ач'); ?>">Оставить заявку</button>
        </li>
      <?php endforeach; ?>
      <?php wp_reset_postdata(); ?>
    </ul>
  <?php else : ?>
    <div class="selection__empty">По вашему запросу ничего не найдено.</div>
<?php endif;

  wp_die();
}

// Подключаем JS и локализацию
function ups_enqueue_filter_scripts()
{
  wp_enqueue_script('ups-filter-script', get_template_directory_uri() . '/assets/js/ups-filter.js', ['jquery'], null, true);
  wp_localize_script('ups-filter-script', 'ups_ajax', [
    'ajax_url' => admin_url('admin-ajax.php'),
  ]);
}
add_action('wp_enqueue_scripts', 'ups_enqueue_filter_scripts');
