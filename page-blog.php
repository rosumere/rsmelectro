<?php

/**
 * Template name: Страница - Блог
 */

get_header();

?>

<main class="main page-standart page-selection section-light">
  <div class="page-standart__wrapper ">
    <div class="container">
      <?php while (have_posts()) : the_post(); ?>
        <div class="breadcrumbs">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
          }
          ?>
        </div>
        <div class="page-standart__inner tabs" data-tabs-container data-tabs-default="parameters-selection">
          <div class="page-standart__sidebar">
            <h1 class="page-standart__title"><?php the_title(); ?></h1>

            <div class="tabs__buttons">
              <button class="tabs__btn" data-tab="parameters-selection">Подбор по параметрам</button>
              <button class="tabs__btn" data-tab="models-selection">Подбор по модели ИБП</button>
            </div>
          </div>
          <div class="page-standart__content">
            <section class="blog-posts">
              <h1><?php the_title(); ?></h1>

              <?php
              $args = array(
                'post_type' => 'post',
                'posts_per_page' => 10, // Количество записей на странице
                'paged' => get_query_var('paged') ? get_query_var('paged') : 1
              );

              $blog_query = new WP_Query($args);

              if ($blog_query->have_posts()) :
                while ($blog_query->have_posts()) : $blog_query->the_post(); ?>

                  <article>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
                    <p><strong>Рубрика:</strong> <?php the_category(', '); ?></p>
                  </article>

                <?php endwhile; ?>

                <div class="pagination">
                  <?php
                  echo paginate_links(array(
                    'total' => $blog_query->max_num_pages
                  ));
                  ?>
                </div>

              <?php else : ?>
                <p>Записей не найдено.</p>
              <?php endif;

              wp_reset_postdata();
              ?>
            </section>
          </div>
        </div>
        <div class="section-line"></div>
    </div>
  <?php endwhile; ?>
  </div>
</main>



<?php get_footer(); ?>
