<aside class="sidebar sidebar_right">
            <div class="sidebar__navigation">
                <h3 class="sidebar__navigation-header">В этой статье</h3>
                <ul class="sidebar__navigation-list">
                    <li class="sidebar__navigation-item">
                        <a class="sidebar__navigation-link link" href="#Введение">Введение</a>
                    </li>
                    <?php
                        $content = get_post_field('post_content', get_the_ID()); // получаем содержимое записи
                        $pattern = '/<h[2-6].*?>(.*?)<\/h[2-6]>/'; // регулярное выражение для поиска заголовков h2-h6
                        preg_match_all($pattern, $content, $headings, PREG_PATTERN_ORDER); // извлекаем все заголовки
                        if (!empty($headings[0])) {
                            foreach ($headings[0] as $index => $heading) {
                                $heading_id = 'heading-' . $index; // генерируем уникальный id для заголовка
                                $heading_text = wp_strip_all_tags($heading); // получаем текст заголовка
                                $content = str_replace($heading, sprintf('<h2 id="%s">%s</h2>', $heading_id, $heading_text), $content); // заменяем заголовок с добавленным id
                                echo '<li class="sidebar__navigation-item">';
                                echo '<a class="sidebar__navigation-link link" href="#' . $heading_id . '">' . $heading_text . '</a>';
                                echo '</li>';
                            }
                        }
                    ?>
                </ul>
            </div>
        </aside>