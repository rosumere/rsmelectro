<?php

/**
 * Template name: Страница вопрос-ответ
 */

get_header();

?>
<main class="main page-faq section-light">
  <div class="page-standart__wrapper">
    <div class="container">
      <?php while (have_posts()) : the_post(); ?>
        <div class="breadcrumbs">
          <?php
          if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p class="breadcrumbs__row" id="breadcrumbs-row">', '</p>');
          }
          ?>
        </div>
        <div class="page-standart__inner page-faq__inner">
          <div class="page-standart__sidebar">
            <h1 class="page-standart__title"><?php the_title(); ?></h1>
          </div>
          <div class="page-standart__content page-faq__content">
            <?php if (have_rows('faq_repeater')): ?>
              <div class="job-accordeon faq-accordeon">
                <div class="job-accordeon__inner user-content">
                  <?php while (have_rows('faq_repeater')): the_row();
                    $question = get_sub_field('faq_question');
                    $answer = get_sub_field('faq_answer');
                  ?>
                    <div class="job-accordeon__item faq-accordeon__item">
                      <button class="job-accordeon__btn"><?php echo $question; ?></button>
                      <div class="job-accordeon__content faq-accordeon__content">
                        <?php echo $answer; ?>
                      </div>
                    </div>
                  <?php endwhile; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="section-line section-line--xl"></div>
    </div>
  <?php endwhile; ?>
  </div>
</main>



<?php get_footer(); ?>
