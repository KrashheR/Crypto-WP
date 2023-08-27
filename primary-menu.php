<?php
$post_id = get_the_ID();
$categories = get_the_category($post_id);

foreach ($categories as $category) {
    $category_class = '';

    if (is_category($category->term_id) || in_category($category->term_id)) {
        $category_class = 'current-menu-item';
    }
    echo '<li class="' . $category_class . '"><a href="' . esc_url(home_url('/')) . '">' . $category->name . '</a></li>';
}
?>

