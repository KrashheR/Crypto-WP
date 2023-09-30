<?php
/*
Template Name: search
Template Post Type: post, page, product
*/
?>

<?php get_header(); ?>
<div class="inner">
  <section class="search-results">
      <h1 class="search-results__title">Результаты поиска</h1>

    <?php if (have_posts()) : ?>
        <ul class="search-results__list">
            <?php while (have_posts()) : the_post(); ?>
                <li class="search-results__item">
                    <a class="search-results__link" href="<?php the_permalink(); ?>">
                        <h2 class="search-results__item-title"> <?php the_title(); ?> </h2>
                        <div class="search-results__item-content">
                          <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                        </div>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p class="search-results__no-results">Ничего не найдено.</p>
    <?php endif; ?>
  </section>
</div>


<?php get_footer(); ?>
