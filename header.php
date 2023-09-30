<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="<?php  bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="На этом сайте вы можете найти самую актуальную информацию о криптовалютном рынке." />
    <meta name="keywords" content="Криптовалюта, Биткоин, Эфириум, BTC, ETH, торговля криптовалютой, прогноз криптовалюты"/>
    <?php wp_head(); ?>
</head>
<body class="page <?php
    if ( is_front_page() ){
        echo 'page_home';
    }?>">
    <header class="header">
        <div class="inner">
            <nav class="navigation">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="navigation__logo-link">
                    <img class="navigation__logo-image logo" src="<?php bloginfo('template_url'); ?>/assets/images/logo.svg" alt="Перейти на главную">
                </a>
                <button class="navigation__hamburger" type="button">&#9776;</button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'container' => 'ul',
                    'menu_class' => 'navigation__list',
                    'menu_id' => '',
                    'fallback_cb' => false
                ));
                ?>

                <img class="navigation__mobile-logo logo" src="<?php bloginfo('template_url'); ?>/assets/images/logo.svg" alt="Crypto">
                <div class="search-field">
                    <button class="search-field__button search-field__button_mobile" type="button" aria-label="Открыть строку поиска"></button>
                    <form class="search-field__form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                        <input class="search-field__input-text" placeholder="Поиск..." type="search" name="s" >
                        <button class="search-field__button" type="submit" title="Поиск" aria-label="Начать поиск по сайту"></button>
                    </form>
                </div>
            </nav>
        </div>
        <?php if ( is_page_template( 'blog.php') || is_page_template( 'categories.php' ) ) : ?>
            <div class="header__progress-bar">
                <div class="header__progress-handle"></div>
            </div>
        <?php endif; ?>
    </header>
