<?php 
/* 
Template Name: blog
Template Post Type: post, page, product
*/
?>

<?php get_header();?>

<main class="main">
    <div class="inner">     
        <?php get_sidebar(); ?>       
        <article class="post-content">
            <h1 class="post-content__title" id="Введение"><?php the_title()?></h1>
            <figure class="post-content__figure">
                <?php the_post_thumbnail(
                    array(380, 250),
                    array(
                        'class' => "post-content__image",
                    )
                ); ?>
            </figure>
            
            <?php
                $content = get_the_content();

                $pattern = '/<h[2-6].*?>(.*?)<\/h[2-6]>/';
                preg_match_all($pattern, $content, $headings, PREG_PATTERN_ORDER);

                if (!empty($headings[0])) {

                    foreach ($headings[0] as $index => $heading) {
                        $heading_id = 'heading-' . $index; 
                        $heading_text = wp_strip_all_tags($heading); 
                        $content = str_replace($heading, sprintf('<h2 id="%s">%s</h2>', $heading_id, $heading_text), $content); 
                    }

                }
                echo apply_filters('the_content', $content);
            ?>

        </article>
        <section class="additional-posts">
            <h2>Читайте также:</h2>
            <div class="row row_small">
                <?php display_latest_posts(4, 0, 6); ?>
            </div>
        </section>
    </div>
</main>
   


<?php get_footer(); ?>