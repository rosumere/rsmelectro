<?php

remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');

add_action('init', 'rosumere_disable_emoji', 1);
function rosumere_disable_emoji()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  add_filter('tiny_mce_plugins', 'rosumere_disable_tinymce_emoji');
}


// Disable emoji on TinyMCE
function rosumere_disable_tinymce_emoji($plugins)
{
  return array_diff($plugins, array('wpemoji'));
}

add_action('wp_print_styles', 'rosumere_deregister_styles_and_scripts', 100);
function rosumere_deregister_styles_and_scripts()
{
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
}


add_action('init', 'remove_global_styles_and_svg_filters');
function remove_global_styles_and_svg_filters()
{
  remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
  remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
}
