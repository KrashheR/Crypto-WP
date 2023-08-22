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
                <a href="<?php the_permalink(); ?>">
                  <li class="search-results__item">
                      <h2 class="search-results__item-title">
                          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                      </h2>
                      <div class="search-results__item-content">
                          <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                      </div>
                  </li>
                </a>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p class="search-results__no-results">Ничего не найдено.</p>
    <?php endif; ?>
  </section>
</div>


<?php get_footer(); ?>
