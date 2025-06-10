<?php
function register_battery_taxonomy_brand_series()
{
  register_taxonomy('ups_hierarchy', 'catalog', [
    'label' => 'ИБП (Марка и Серия)',
    'hierarchical' => true,
    'public' => false,
    'show_admin_column' => true,
    'show_ui' => true,
    'show_in_rest' => true,
    'rest_base' => 'ups_hierarchy',
    'rewrite' => ['slug' => 'ups'],
  ]);

  register_taxonomy('ups_set', 'catalog', [
    'label' => 'Комплект батарей производителя',
    'hierarchical' => false,
    'public' => false,
    'show_ui' => true,
    'show_in_rest' => true,
    'rest_base' => 'ups_hierarchy',
    'show_admin_column' => true,
  ]);
}

add_action('init', 'register_battery_taxonomy_brand_series');
