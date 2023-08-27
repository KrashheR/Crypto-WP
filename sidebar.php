<aside class="sidebar sidebar_right">
    <div class="sidebar__navigation">
        <h3 class="sidebar__navigation-header">В этой статье</h3>
        <ul class="sidebar__navigation-list">
            <li class="sidebar__navigation-item">
                <a class="sidebar__navigation-link link" href="#Введение">Введение</a>
            </li>
            <?php
            $content_copy = get_post_field('post_content', get_the_ID());
            $pattern = '/<h([2-6]).*?>(.*?)<\/h\1>/';
            preg_match_all($pattern, $content_copy, $headings, PREG_PATTERN_ORDER);
            if (!empty($headings[0])) {
                foreach ($headings[0] as $index => $heading) {
                    $heading_id = 'heading-' . $index;
                    $heading_text = wp_strip_all_tags($heading);
                    $content_copy = str_replace($heading, sprintf('<h%1$s id="%2$s">%3$s</h%1$s>', $headings[1][$index], $heading_id, $heading_text), $content_copy);
                    echo '<li class="sidebar__navigation-item">';
                    echo '<a class="sidebar__navigation-link link" href="#' . esc_attr($heading_id) . '">' . esc_html($heading_text) . '</a>';
                    echo '</li>';
                }
            }
            ?>
        </ul>
    </div>
</aside>
