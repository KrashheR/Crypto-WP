<?php
/*
Template Name: home
*/
?>

<?php get_header();?>

    <main class="main">
        <div class="inner">
            <div class="main__grid">
                <div class="row row_big">
                    <?php display_latest_posts(3, 0, 6); ?>
                </div>
                <div class="row row_small">
                    <?php display_latest_posts(4, 0, 7); ?>
                </div>
                <div class="row row_big">
                    <?php display_latest_posts(3, 3, 6); ?>
                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>

