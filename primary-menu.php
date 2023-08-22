<?php
// Получение ID текущей записи
$post_id = get_the_ID();

// Получение категорий, к которым относится текущая запись
$categories = get_the_category($post_id);

// Перебираем категории и проверяем каждую на соответствие текущей записи
foreach ($categories as $category) {
    $category_class = '';

    // Проверяем, является ли категория родительской или дочерней для текущей записи
    if (is_category($category->term_id) || in_category($category->term_id)) {
        $category_class = 'current-menu-item';
    }

    // Добавляем класс к элементу меню с соответствующей категорией
    echo '<li class="' . $category_class . '"><a href="' . esc_url(home_url('/')) . '">' . $category->name . '</a></li>';
}
?>

