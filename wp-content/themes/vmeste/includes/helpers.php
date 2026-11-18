<?php

function theme_asset(string $path = ''): string {
    return PATH_DIST . ltrim($path, '/');
}

function theme_img_url($image = null, string $fallback = '', string $size = 'full'): string {
    if (is_array($image)) {
        $image = $image['ID'] ?? ($image['id'] ?? 0);
    }

    $image_id = (int) $image;
    if ($image_id) {
        $url = wp_get_attachment_image_url($image_id, $size);
        if ($url) {
            return $url;
        }
    }

    return $fallback !== '' ? theme_asset('img/' . ltrim($fallback, '/')) : '';
}

function theme_image($image = null, string $class = '', string $size = 'large', string $fallback = '', string $loading = 'lazy'): void {
    if (is_array($image)) {
        $image = $image['ID'] ?? ($image['id'] ?? 0);
    }

    $image_id = (int) $image;
    if ($image_id) {
        get_image($image_id, $class, $size, $loading);
        return;
    }

    if ($fallback === '') {
        return;
    }

    printf(
        '<img class="%s" src="%s" loading="%s" alt="">',
        esc_attr($class),
        esc_url(theme_asset('img/' . ltrim($fallback, '/'))),
        esc_attr($loading)
    );
}

function theme_bg_style($image = null, string $fallback = ''): string {
    $url = theme_img_url($image, $fallback);
    return $url !== '' ? 'background-image: url(' . esc_url($url) . ');' : '';
}

function theme_text($value, string $default = ''): string {
    $value = is_string($value) ? trim($value) : '';
    return $value !== '' ? $value : $default;
}

function theme_button(?array $button, string $class = 'btn btn--primary', array $attrs = [], string $tag = 'a'): void {
    if (empty($button) || empty($button['text'])) {
        return;
    }

    $text = $button['text'];
    $url = $button['url'] ?? '';
    $attr_html = '';

    foreach ($attrs as $key => $val) {
        if ($val === null || $val === false) {
            continue;
        }
        if ($val === true) {
            $attr_html .= ' ' . esc_attr($key);
            continue;
        }
        $attr_html .= sprintf(' %s="%s"', esc_attr($key), esc_attr((string) $val));
    }

    if ($tag === 'button' || $url === '') {
        printf(
            '<button class="%s" type="button"%s>%s</button>',
            esc_attr($class),
            $attr_html,
            esc_html($text)
        );
        return;
    }

    printf(
        '<a class="%s" href="%s"%s>%s</a>',
        esc_attr($class),
        esc_url($url),
        $attr_html,
        esc_html($text)
    );
}

function theme_phone_href(string $phone): string {
    return 'tel:' . preg_replace('/[^\d+]/', '', $phone);
}

/**
 * Пункты меню-якоря (#sreda): на внутренних страницах становятся /#sreda.
 */
function theme_menu_href(string $url): string {
    $url = trim($url);

    if ($url === '') {
        return '#';
    }

    if (str_starts_with($url, '#') && !is_front_page()) {
        return '/' . $url;
    }

    return $url;
}

function theme_section_show(?array $section): bool {
    // Пустая секция → показываем с fallback-контентом из вёрстки
    if (empty($section)) {
        return true;
    }

    // Явно выключено в ACF
    if (array_key_exists('show', $section) && empty($section['show'])) {
        return false;
    }

    return true;
}
