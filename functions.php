<?php
// Define version
if (!defined('_VER')) {
  define('_VER', '0.111111131');
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

require_once(get_template_directory() . '/inc/class-rsmelectro-header-nav.php');
require_once(get_template_directory() . '/inc/register-post-type.php');

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


// Регистрируем шорткод формы
add_shortcode('catalog_filter_form', 'render_catalog_filter_form');
function render_catalog_filter_form()
{
  ob_start();
?>
  <form id="catalog-filter-form">
    <select name="voltage" id="voltage">
      <option value="">Напряжение</option>
      <?php foreach (get_unique_acf_values('product_rated_voltage') as $value): ?>
        <option value="<?= esc_attr($value) ?>"><?= esc_html($value) ?></option>
      <?php endforeach; ?>
    </select>

    <select name="power" id="power">
      <option value="">Ёмкость</option>
      <?php foreach (get_unique_acf_values('product_rated_power') as $value): ?>
        <option value="<?= esc_attr($value) ?>"><?= esc_html($value) ?></option>
      <?php endforeach; ?>
    </select>

    <select name="tech" id="tech">
      <option value="">Технология</option>
      <?php foreach (get_unique_acf_values('product_technology') as $value): ?>
        <option value="<?= esc_attr($value) ?>"><?= esc_html($value) ?></option>
      <?php endforeach; ?>
    </select>

    <button type="submit">Подобрать</button>
  </form>

  <div id="catalog-results"></div>
<?php
  return ob_get_clean();
}

// Получение уникальных значений ACF
function get_unique_acf_values($field_name)
{
  global $wpdb;

  $results = $wpdb->get_col($wpdb->prepare("
        SELECT DISTINCT meta_value FROM $wpdb->postmeta
        WHERE meta_key = %s AND meta_value != ''
    ", $field_name));

  return array_filter(array_unique($results));
}

// Регистрируем AJAX обработчик
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
    ];
  }

  if (!empty($_POST['power'])) {
    $args['meta_query'][] = [
      'key' => 'product_rated_power',
      'value' => sanitize_text_field($_POST['power']),
    ];
  }

  if (!empty($_POST['tech'])) {
    $args['meta_query'][] = [
      'key' => 'product_technology',
      'value' => sanitize_text_field($_POST['tech']),
    ];
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      echo '<div class="catalog-item">';
      echo '<h4>' . get_the_title() . '</h4>';
      echo '<p>Напряжение: ' . get_field('product_rated_voltage') . '</p>';
      echo '<p>Ёмкость: ' . get_field('product_rated_power') . '</p>';
      echo '<p>Технология: ' . get_field('product_technology') . '</p>';
      echo '</div>';
    }
  } else {
    echo '<p>Ничего не найдено.</p>';
  }

  wp_die();
}


add_action('wp_enqueue_scripts', 'enqueue_catalog_filter_scripts');
function enqueue_catalog_filter_scripts()
{
  wp_enqueue_script('catalog-filter-js', get_template_directory_uri() . '/assets/js/catalog-filter.js', ['jquery'], null, true);

  // Передаём ajax_url в скрипт
  wp_localize_script('catalog-filter-js', 'catalog_filter_vars', [
    'ajax_url' => admin_url('admin-ajax.php')
  ]);
}
