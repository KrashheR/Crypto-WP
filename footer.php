<footer class="footer">
        <div class="inner">
            <nav class="navigation navigation_footer">
                <a href="index.html" class="navigation__logo-link navigation__logo-link_footer">
                    <img class="footer__logo logo" src="<?php bloginfo('template_url'); ?>/assets/images/logo.svg" alt="Логотип">
                </a>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu',
                    'container' => 'ul',
                    'menu_class' => 'navigation__list',
                    'menu_id' => '',
                    'fallback_cb' => false
                ));
                ?>
            </nav>
            <div class="footer__flex-container">
                <div class="footer__contacts">
                    <p class="footer__description">Crypto - журнал о криптовалютах и их анализе.</p>
                    <a class="footer__email" href="mailto:nikita.kucherencko.ya@yandex.ru">Email: nikita.kucherencko.ya@yandex.ru</a>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer() ?>

</body>
</html>