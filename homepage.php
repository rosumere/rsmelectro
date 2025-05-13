<?php

/**
 * Template Name: Homepage
 */
get_header();

?>
<main class="main page page-home">
  <?php
  get_template_part('template-parts/home-hero');
  get_template_part('template-parts/home-products');
  get_template_part('template-parts/home-values');
  get_template_part('template-parts/home-about');
  get_template_part('template-parts/home-dealers');
  ?>
</main>

<?php
get_footer();
