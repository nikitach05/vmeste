<?php
define('PATH_THEME', get_template_directory_uri() . '/');
define('PATH_DIST', PATH_THEME . 'vite/dist/');
define('PATH_ASSETS', PATH_THEME . 'assets/');

/** Fallback ID if «Главная» ещё не назначена в Настройки → Чтение */
define('PAGE_HOME_ID', 0);

function theme_home_id(): int {
    $front = (int) get_option('page_on_front');
    if ($front) {
        return $front;
    }

    if (PAGE_HOME_ID) {
        return (int) PAGE_HOME_ID;
    }

    return 0;
}

function theme_about_id(): int {
    $page = get_page_by_path('o-nas');
    if ($page) {
        return (int) $page->ID;
    }

    $pages = get_posts([
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'about.php',
        'fields'         => 'ids',
    ]);

    return !empty($pages) ? (int) $pages[0] : 0;
}
