<?php
class Rsmelectro_Header_Nav extends Walker_Nav_Menu
{
  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $indent = str_repeat("\t", $depth); // Отступ для вложенных уровней
    $classes = ['header-menu__submenu', 'submenu'];
    $class_names = implode(' ', $classes);

    $output .= "\n$indent<ul class=\"$class_names\">\n";
  }

  function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
  {
    if (empty($data_object)) {
      return; // Если элемент пустой, ничего не делаем
    }

    $item = $data_object;
    $indent = str_repeat("\t", $depth); // Отступ для вложенных элементов

    // Классы для элемента меню
    $classes = ['header-menu__item'];
    if ($depth > 0) {
      $classes[] = 'submenu__item';
    }
    if (in_array('menu-item-has-children', $item->classes)) {
      $classes[] = 'header-menu__item--submenu';
    }
    $class_names = implode(' ', $classes);

    // Генерация HTML для элемента
    $output .= "$indent<li class=\"$class_names\">";

    // Атрибуты ссылки
    $atts = [
      'href' => !empty($item->url) ? esc_url($item->url) : '',
      'class' => $depth === 0 ? 'link header-menu__link' : 'link submenu__link',
    ];

    // Генерация HTML для ссылки
    $attributes = '';
    foreach ($atts as $attr => $value) {
      if (!empty($value)) {
        $attributes .= " $attr=\"$value\"";
      }
    }

    $item_output = $args->before;
    $item_output .= "<a$attributes>";
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }

  function end_el(&$output, $data_object, $depth = 0, $args = null)
  {
    $output .= "</li>\n"; // Закрываем элемент списка
  }

  function end_lvl(&$output, $depth = 0, $args = null)
  {
    $indent = str_repeat("\t", $depth); // Отступ для вложенных уровней
    $output .= "$indent</ul>\n"; // Закрываем уровень
  }
}
