<?php
get_header();
?>

<main class="main page-standart single-archive section-light">
  <div class="page-standart__wrapper">
    <div class="container">

      <div class="breadcrumbs">
        <?php
        if (function_exists('yoast_breadcrumb')) {
          yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
        }
        ?>
      </div>

      <?php
      // Указываем параметры запроса
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 10,
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1
      );

      $blog_query = new WP_Query($args);

      if ($blog_query->have_posts()) : ?>
        <div class="page-standart__inner">
          <div class="page-standart__sidebar single-archive__sidebar">
            <h1 class="page-standart__title">
              <?php
              if (is_home()) {
                echo 'Блог';
              } else {
                the_archive_title();
              }
              ?>
            </h1>

            <button class="btn single-archive__show-cat">Показать категории</button>
            <div class="single-archive__filter category-filter">
              <?php
              $categories = get_categories();
              foreach ($categories as $category) {
                echo '<button class="category-filter__btn single-archive__filter-btn" data-cat="' . esc_attr($category->term_id) . '">' . esc_html($category->name) . '</button>';
              }
              ?>
            </div>
          </div>

          <div class="page-standart__content single-archive__content">
            <section class="blog-posts">
              <div id="ajax-posts" class="single-archive__list">
                <?php while ($blog_query->have_posts()) : $blog_query->the_post();
                  get_template_part('template-parts/post-card');
                endwhile; ?>
              </div>

              <div class="pagination single-archive__pagination">
                <?php if ($blog_query->max_num_pages > 1): ?>
                  <button id="load-more" class="btn single-archive__pagination-more load-more-btn">Показать ещё</button>
                <?php endif; ?>
              </div>

              <?php wp_reset_postdata(); ?>
            </section>
          </div>
        </div>
      <?php else : ?>
        <p>Записей не найдено.</p>
      <?php endif; ?>
      <div class="section-line"></div>
    </div>
  </div>
</main>

<?php
get_footer();
