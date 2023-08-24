<?php get_header(); ?>

<div class="inner">
  <div class="error-page">
    <h1 class="error-page__title">Ошибка 404: Страница не найдена</h1>
    <p class="error-page__text">К сожалению, страница, которую вы ищете, не существует или была перемещена.</p>
    <a class="error-page__link" href="<?php echo home_url(); ?>">Вернуться на главную страницу</a>
  </div>
</div>

<?php get_footer(); ?>
