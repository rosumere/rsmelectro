<?php
if (!defined('ABSPATH')) exit;

if (have_posts()) :
  while (have_posts()) : the_post();
    get_template_part('template-parts/post-card');
  endwhile;
else :
  echo '<p>Записей не найдено.</p>';
endif;
