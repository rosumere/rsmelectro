<?php
add_action('init', 'register_post_types');

function register_post_types()
{

  register_post_type('catalog', [
    'label'  => 'Каталог',
    'labels' => [
      'name'               => 'Каталог',
      'singular_name'      => 'Продукт',
      'add_new'            => 'Добавить продукт',
      'add_new_item'       => 'Добавление продукта',
      'edit_item'          => 'Редактирование продукта',
      'new_item'           => 'Новый продукт',
      'view_item'          => 'Смотреть продукт',
      'search_items'       => 'Искать продукт',
      'not_found'          => 'Не найдено',
      'not_found_in_trash' => 'Не найдено в корзине',
      'parent_item_colon'  => '',
      'menu_name'          => 'Каталог ',
    ],
    'description'            => '',
    'public'                 => true,
    // 'publicly_queryable'  => null, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    // 'show_ui'             => null, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => true, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => true, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => null,
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    'hierarchical'        => false,
    'supports'            => ['title', 'editor', 'custom-fields', 'page-attributes', 'thumbnail'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'taxonomies'          => [],
    'has_archive'         => true,
    'rewrite'             => true,
    'query_var'           => true,
  ]);

  register_post_type('jobs', [
    'label'  => 'Вакансии',
    'labels' => [
      'name'               => 'Вакансии',
      'singular_name'      => 'Вакансия',
      'add_new'            => 'Добавить вакансию',
      'add_new_item'       => 'Добавление вакансии',
      'edit_item'          => 'Редактирование вакансии',
      'new_item'           => 'Новая вакансия',
      'view_item'          => 'Смотреть вакансию',
      'search_items'       => 'Искать вакансию',
      'not_found'          => 'Не найдено',
      'not_found_in_trash' => 'Не найдено в корзине',
      'parent_item_colon'  => '',
      'menu_name'          => 'Вакансии ',
    ],
    'description'            => '',
    'public'                 => false,
    // 'publicly_queryable'  => null, // зависит от public
    // 'exclude_from_search' => null, // зависит от public
    'show_ui'             => true, // зависит от public
    // 'show_in_nav_menus'   => null, // зависит от public
    'show_in_menu'           => true, // показывать ли в меню админки
    // 'show_in_admin_bar'   => null, // зависит от show_in_menu
    'show_in_rest'        => true, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => null,
    //'capability_type'   => 'post',
    //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
    //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
    'hierarchical'        => false,
    'supports'            => ['title', 'custom-fields'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'taxonomies'          => [],
    'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true,
  ]);
}
