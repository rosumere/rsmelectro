<?php get_header(); ?>


<main class="main page page-404">
  <div class="container">
    <h1 class="page__title page-404__title">Ой, 404 ошибка - страница не найдена... </h1>
    <div class="page-404__descr">
      <p>Что-то пошло не так. Запрашиваемся страница не существует.</p>
      <p>Возможно, она устарела, или была удалена.</p>
    </div>
    <a href="<?php echo home_url(); ?>" class="btn page-404__btn">Вернуться на главную</a>
  </div>
</main>

<?php
get_footer();
