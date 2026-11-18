<?php
/**
 * Generates ACF Local JSON for vmeste theme.
 * Run: php tools/generate-acf.php
 */

$outDir = dirname(__DIR__) . '/acf-json';

function tab(string $key, string $label): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => '',
        'type' => 'tab',
        'placement' => 'top',
        'endpoint' => 0,
    ];
}

function show_field(string $key, int $default = 1): array {
    return [
        'key' => $key,
        'label' => 'Показать блок',
        'name' => 'show',
        'type' => 'true_false',
        'default_value' => $default,
        'ui' => 1,
        'ui_on_text' => '',
        'ui_off_text' => '',
    ];
}

function text_field(string $key, string $name, string $label, string $default = '', string $width = ''): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'text',
        'default_value' => $default,
        'wrapper' => ['width' => $width, 'class' => '', 'id' => ''],
    ];
}

function textarea_field(string $key, string $name, string $label, string $default = '', int $rows = 3): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'textarea',
        'default_value' => $default,
        'rows' => $rows,
        'new_lines' => 'br',
    ];
}

function wysiwyg_field(string $key, string $name, string $label, string $default = ''): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'wysiwyg',
        'default_value' => $default,
        'tabs' => 'all',
        'toolbar' => 'basic',
        'media_upload' => 0,
        'delay' => 0,
    ];
}

function image_field(string $key, string $name, string $label, string $width = ''): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'image',
        'return_format' => 'id',
        'preview_size' => 'medium',
        'library' => 'all',
        'mime_types' => 'jpg,jpeg,png,webp,svg',
        'wrapper' => ['width' => $width, 'class' => '', 'id' => ''],
    ];
}

function file_field(string $key, string $name, string $label): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'file',
        'return_format' => 'array',
        'library' => 'all',
        'mime_types' => 'mp4,webm,mov',
    ];
}

function url_field(string $key, string $name, string $label, string $default = '', string $width = ''): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'url',
        'default_value' => $default,
        'wrapper' => ['width' => $width, 'class' => '', 'id' => ''],
    ];
}

function select_field(string $key, string $name, string $label, array $choices, string $default = '', string $width = ''): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'select',
        'choices' => $choices,
        'default_value' => $default,
        'return_format' => 'value',
        'wrapper' => ['width' => $width, 'class' => '', 'id' => ''],
    ];
}

function true_false_field(string $key, string $name, string $label, int $default = 0, string $width = ''): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'true_false',
        'default_value' => $default,
        'ui' => 1,
        'wrapper' => ['width' => $width, 'class' => '', 'id' => ''],
    ];
}

function button_group(string $key, string $name, string $label, string $textDefault = '', string $urlDefault = ''): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'group',
        'layout' => 'block',
        'sub_fields' => [
            text_field($key . '_text', 'text', 'Текст', $textDefault, '50'),
            url_field($key . '_url', 'url', 'Ссылка', $urlDefault, '50'),
        ],
    ];
}

function link_item_fields(string $prefix): array {
    return [
        text_field($prefix . '_text', 'text', 'Текст', '', '50'),
        text_field($prefix . '_url', 'url', 'Ссылка', '', '50'),
    ];
}

function repeater(string $key, string $name, string $label, array $sub, string $button = 'Добавить', string $layout = 'block'): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'repeater',
        'layout' => $layout,
        'button_label' => $button,
        'sub_fields' => $sub,
    ];
}

function group(string $key, string $name, string $label, array $sub): array {
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'group',
        'layout' => 'block',
        'sub_fields' => $sub,
    ];
}

function save_group(string $dir, array $group): void {
    $path = $dir . '/' . $group['key'] . '.json';
    $json = json_encode($group, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    if ($json === false) {
        throw new RuntimeException('JSON encode failed for ' . $group['key']);
    }
    file_put_contents($path, $json . "\n");
    echo "Wrote {$path}\n";
}

// Remove old unrelated group
$old = $outDir . '/group_univer_stom_theme_general.json';
if (file_exists($old)) {
    unlink($old);
    echo "Removed old group_univer_stom_theme_general.json\n";
}

$modified = time();

/* ========== OPTIONS: Theme general ========== */
$general = [
    'key' => 'group_vmeste_theme_general',
    'title' => 'Общие настройки',
    'fields' => [
        tab('field_vm_gen_tab_header', 'Шапка'),
        group('field_vm_gen_header', 'header', 'Шапка', [
            text_field('field_vm_gen_header_menu_toggle', 'menu_toggle_text', 'Текст кнопки меню', 'Меню'),
        ]),

        tab('field_vm_gen_tab_footer', 'Футер'),
        group('field_vm_gen_footer', 'footer', 'Футер', [
            textarea_field('field_vm_gen_footer_note', 'note', 'Примечание сверху', 'Работаем онлайн по всему миру. Офис находится в г. Екатеринбург', 2),
            text_field('field_vm_gen_footer_title', 'title', 'Заголовок', 'ДАВАЙ ВМЕСТЕ'),
            repeater('field_vm_gen_footer_nav_1', 'nav_1', 'Навигация — колонка 1', link_item_fields('field_vm_gen_footer_nav_1_item'), 'Добавить ссылку'),
            repeater('field_vm_gen_footer_nav_2', 'nav_2', 'Навигация — колонка 2', link_item_fields('field_vm_gen_footer_nav_2_item'), 'Добавить ссылку'),
            text_field('field_vm_gen_footer_hours', 'hours', 'Часы работы', 'Пн-Пт с 10:00 до 19:00'),
            textarea_field('field_vm_gen_footer_address', 'address', 'Адрес', '620028, г. Екатеринбург, ул. Верх-Исетский бульвар', 2),
            text_field('field_vm_gen_footer_phone', 'phone', 'Телефон', '+7 (999) 333-29-52'),
            text_field('field_vm_gen_footer_youtube', 'youtube', 'YouTube', '#'),
            text_field('field_vm_gen_footer_max', 'max', 'MAX', '#'),
            text_field('field_vm_gen_footer_telegram', 'telegram', 'Telegram', '#'),
            text_field('field_vm_gen_footer_vk', 'vk', 'ВКонтакте', '#'),
            repeater('field_vm_gen_footer_legal', 'legal', 'Юридические ссылки', [
                text_field('field_vm_gen_footer_legal_text', 'text', 'Текст', '', '50'),
                text_field('field_vm_gen_footer_legal_url', 'url', 'Ссылка', '', '50'),
            ], 'Добавить ссылку'),
            text_field('field_vm_gen_footer_copyright', 'copyright', 'Копирайт', '© 2026 Давай вместе. Все права защищены'),
            text_field('field_vm_gen_footer_dev', 'developer', 'Разработка', 'Разработка сайта PKDESIGN'),
            image_field('field_vm_gen_footer_payments', 'payments', 'Иконки оплаты'),
        ]),

        tab('field_vm_gen_tab_modals', 'Модальные окна'),
        group('field_vm_gen_modals', 'modals', 'Модальные окна', [
            text_field('field_vm_gen_modals_order_title', 'order_title', 'Заявка — заголовок', 'Оставьте заявку и мы расскажем, чем клуб может быть полезен лично для вас'),
            text_field('field_vm_gen_modals_order_submit', 'order_submit', 'Заявка — кнопка', 'Отправить заявку'),
            wysiwyg_field('field_vm_gen_modals_privacy', 'privacy_label', 'Согласие на обработку ПДн', 'Я подтверждаю, что ознакомлен (а) с <a href="#">политикой в отношении обработки персональных данных</a> и даю своё <a href="#">согласие</a> на обработку персональных данных'),
            wysiwyg_field('field_vm_gen_modals_ads', 'ads_label', 'Согласие на рассылку', 'Я ознакомлен (а) с <a href="#">политикой рекламной рассылки</a> и даю своё <a href="#">согласие</a> на рекламную рассылку'),
            text_field('field_vm_gen_modals_success_title', 'success_title', 'Успех — заголовок', 'Спасибо!<br>ваша заявка отправлена'),
            textarea_field('field_vm_gen_modals_success_text', 'success_text', 'Успех — текст', 'Менеджер свяжется с вами в ближайшее время и расскажет все подробности', 2),
        ]),

        tab('field_vm_gen_tab_mail', 'Почта'),
        text_field('field_vm_gen_mail_from', 'mail_from', 'Email отправителя', 'info@example.com'),
        repeater('field_vm_gen_mail_to', 'mail_to', 'Email получателей', [
            text_field('field_vm_gen_mail_to_email', 'email', 'Email'),
        ], 'Добавить email'),
    ],
    'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'theme-general-mail']]],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,
    'modified' => $modified,
];

/* ========== FRONT PAGE ========== */
$front = [
    'key' => 'group_vmeste_front_page',
    'title' => 'Главная',
    'fields' => [
        // MAIN
        tab('field_vm_fp_tab_main', 'Главный экран'),
        group('field_vm_fp_main', 'main', 'Главный экран', [
            show_field('field_vm_fp_main_show'),
            image_field('field_vm_fp_main_bg', 'background', 'Фон'),
            text_field('field_vm_fp_main_under', 'under_title', 'Надзаголовок', 'Интеллектуальная среда &Брачное агентство'),
            text_field('field_vm_fp_main_title', 'title', 'Заголовок', 'ДАВАЙ ВМЕСТЕ'),
            wysiwyg_field('field_vm_fp_main_desc', 'description', 'Описание', '<span>Ценностный фундамент</span> семьи и отношений'),
            repeater('field_vm_fp_main_list', 'list', 'Список', [
                text_field('field_vm_fp_main_list_item', 'text', 'Пункт'),
            ], 'Добавить пункт'),
            button_group('field_vm_fp_main_btn_primary', 'button_primary', 'Кнопка основная', 'Присоединиться'),
            button_group('field_vm_fp_main_btn_secondary', 'button_secondary', 'Кнопка вторичная', 'Погрузиться в контекст'),
            repeater('field_vm_fp_main_clients', 'clients', 'Логотипы клиентов', [
                image_field('field_vm_fp_main_clients_logo', 'logo', 'Логотип'),
            ], 'Добавить логотип', 'table'),
        ]),

        // FOR WHOM
        tab('field_vm_fp_tab_for_whom', 'Кому подойдёт'),
        group('field_vm_fp_for_whom', 'for_whom', 'Кому подойдёт', [
            show_field('field_vm_fp_for_whom_show'),
            image_field('field_vm_fp_for_whom_bg', 'background', 'Фон'),
            text_field('field_vm_fp_for_whom_under', 'under_title', 'Надзаголовок', 'Кому подойдёт'),
            text_field('field_vm_fp_for_whom_title', 'title', 'Заголовок', 'Для того, кто исключает случайность'),
            wysiwyg_field('field_vm_fp_for_whom_desc', 'description', 'Описание', 'Контекст для создания семьи в атмосфере безусловного принятия и доверия. <strong>Мы берем на себя фильтрацию среды, чтобы вы могли быть собой среди равных.</strong>'),
        ]),

        // FORMATS
        tab('field_vm_fp_tab_formats', 'Форматы'),
        group('field_vm_fp_formats', 'formats', 'Форматы', [
            show_field('field_vm_fp_formats_show'),
            text_field('field_vm_fp_formats_under', 'under_title', 'Надзаголовок', 'Форматы'),
            text_field('field_vm_fp_formats_title', 'title', 'Заголовок', 'Экосистема осмысленных отношений'),
            text_field('field_vm_fp_formats_desc', 'description', 'Описание', 'Единый контекст — два уровня погружения'),
            repeater('field_vm_fp_formats_cards', 'cards', 'Карточки', [
                true_false_field('field_vm_fp_formats_cards_agency', 'is_agency', 'Вариант «Брачное агентство»', 0, '30'),
                image_field('field_vm_fp_formats_cards_image', 'image', 'Изображение', '35'),
                image_field('field_vm_fp_formats_cards_bg', 'background', 'Фон карточки', '35'),
                text_field('field_vm_fp_formats_cards_title', 'title', 'Заголовок'),
                textarea_field('field_vm_fp_formats_cards_text', 'text', 'Текст'),
                repeater('field_vm_fp_formats_cards_list', 'list', 'Список', [
                    text_field('field_vm_fp_formats_cards_list_item', 'text', 'Пункт'),
                ], 'Добавить пункт'),
                button_group('field_vm_fp_formats_cards_btn', 'button', 'Кнопка', 'Стать частью сообщества'),
            ], 'Добавить карточку'),
        ]),

        // FOR YOU
        tab('field_vm_fp_tab_for_you', 'Это для вас'),
        group('field_vm_fp_for_you', 'for_you', 'Это для вас', [
            show_field('field_vm_fp_for_you_show'),
            text_field('field_vm_fp_for_you_under', 'under_title', 'Надзаголовок', 'Это для вас'),
            text_field('field_vm_fp_for_you_title', 'title', 'Заголовок', 'На чём построен проект «Давай вместе»'),
            image_field('field_vm_fp_for_you_image', 'image', 'Изображение'),
            repeater('field_vm_fp_for_you_items', 'items', 'Пункты', [
                text_field('field_vm_fp_for_you_items_title', 'title', 'Заголовок', '', '40'),
                textarea_field('field_vm_fp_for_you_items_text', 'text', 'Текст'),
            ], 'Добавить пункт'),
        ]),

        // FOUNDER
        tab('field_vm_fp_tab_founder', 'Основатель'),
        group('field_vm_fp_founder', 'founder', 'Основатель', [
            show_field('field_vm_fp_founder_show'),
            text_field('field_vm_fp_founder_title_1', 'title_1', 'Заголовок — строка 1', 'Основатель'),
            text_field('field_vm_fp_founder_title_2', 'title_2', 'Заголовок — строка 2', 'проекта'),
            image_field('field_vm_fp_founder_photo', 'photo', 'Фото'),
            text_field('field_vm_fp_founder_name', 'name', 'Имя', 'Елена Барвина'),
            text_field('field_vm_fp_founder_role', 'role', 'Роль', 'Ваш медиатор в среде осознанных отношений'),
            textarea_field('field_vm_fp_founder_intro', 'intro', 'Вступление', 'Восемь лет я организовывала свадебные торжества — безупречные декорации для начала пути. Но за красивым кадром я часто видела хрупкость союзов. Это побудило меня сменить фокус: вместо организации событий я стала помогать людям в создании семейного наследия.'),
            textarea_field('field_vm_fp_founder_aside', 'aside', 'Боковой текст', 'Я замужем уже 14 лет и могу сказать, что созидательный союз — это настоящая «командная игра». Когда дом становится крепостью взаимной поддержки, вы обретаете фундамент для династии и укрепления себя в этом мире.'),
            image_field('field_vm_fp_founder_portrait', 'portrait', 'Портрет'),
            text_field('field_vm_fp_founder_badge', 'badge', 'Бейдж', 'Давайте создадим ваше сильное будущее вместе!'),
            textarea_field('field_vm_fp_founder_note_1', 'note_1', 'Заметка 1', '«Давай вместе» — это ответ инфошуму, жизненному хаосу и дефициту искренности. В этом проекте я ваш куратор, преобразующий искреннее желание найти своего человека в выверенный план действий.'),
            textarea_field('field_vm_fp_founder_note_2', 'note_2', 'Заметка 2', 'Моя миссия — исключить случайность и создать «чистый контекст», где вы встречаете только резонирующих по масштабу и ценностям людей.'),
            image_field('field_vm_fp_founder_family', 'family', 'Фото семьи'),
            text_field('field_vm_fp_founder_marquee_1', 'marquee_1', 'Бегущая строка 1', 'ЗАКРЫТЫЙ КЛУБ И БРАЧНОЕ АГЕНТСТВО'),
            text_field('field_vm_fp_founder_marquee_2', 'marquee_2', 'Бегущая строка 2', 'ДАВАЙ ВМЕСТЕ ДАВАЙ ВМЕСТЕ'),
        ]),

        // STEPS (shared with about)
        tab('field_vm_fp_tab_steps', 'Этапы'),
        group('field_vm_fp_steps', 'steps', 'Этапы', [
            show_field('field_vm_fp_steps_show'),
            text_field('field_vm_fp_steps_under', 'under_title', 'Надзаголовок', 'Этапы'),
            text_field('field_vm_fp_steps_title_1', 'title_1', 'Заголовок — строка 1', 'Вступление'),
            text_field('field_vm_fp_steps_title_2', 'title_2', 'Заголовок — строка 2', 'в клуб'),
            image_field('field_vm_fp_steps_panel_bg', 'panel_background', 'Фон панели'),
            text_field('field_vm_fp_steps_btn', 'button_text', 'Текст кнопки', 'Подать заявку'),
            repeater('field_vm_fp_steps_items', 'items', 'Шаги', [
                text_field('field_vm_fp_steps_items_name', 'name', 'Название'),
                textarea_field('field_vm_fp_steps_items_text', 'text', 'Текст'),
                image_field('field_vm_fp_steps_items_image', 'image', 'Изображение панели'),
            ], 'Добавить шаг'),
        ]),

        // MATERIALS
        tab('field_vm_fp_tab_materials', 'Материалы'),
        group('field_vm_fp_materials', 'materials', 'Материалы', [
            show_field('field_vm_fp_materials_show'),
            text_field('field_vm_fp_materials_under', 'under_title', 'Надзаголовок', 'Мы делимся ценным опытом о культуре осознанных отношений'),
            text_field('field_vm_fp_materials_title', 'title', 'Заголовок', 'Материалы'),
            button_group('field_vm_fp_materials_all', 'button_all', 'Кнопка «Все материалы»', 'Посмотреть все материалы', '#'),
            repeater('field_vm_fp_materials_items', 'items', 'Материалы', [
                select_field('field_vm_fp_materials_items_type', 'type', 'Тип', [
                    'article' => 'Статья',
                    'video' => 'Видео',
                ], 'article', '33'),
                true_false_field('field_vm_fp_materials_items_expert', 'is_expert', 'Материал эксперта', 0, '33'),
                text_field('field_vm_fp_materials_items_badge', 'badge', 'Бейдж', '', '33'),
                image_field('field_vm_fp_materials_items_image', 'image', 'Обложка'),
                text_field('field_vm_fp_materials_items_title', 'title', 'Заголовок'),
                textarea_field('field_vm_fp_materials_items_text', 'text', 'Текст (для статей)'),
                image_field('field_vm_fp_materials_items_avatar', 'author_avatar', 'Аватар автора', '33'),
                text_field('field_vm_fp_materials_items_author', 'author_name', 'Имя автора', '', '33'),
                text_field('field_vm_fp_materials_items_role', 'author_role', 'Роль автора', '', '33'),
                text_field('field_vm_fp_materials_items_tag', 'tag', 'Тег', '#Статья', '50'),
                text_field('field_vm_fp_materials_items_category', 'category', 'Категория', 'Брачное агентство/отношения', '50'),
                file_field('field_vm_fp_materials_items_video', 'video', 'Видеофайл'),
                image_field('field_vm_fp_materials_items_poster', 'video_poster', 'Постер видео'),
            ], 'Добавить материал'),
        ]),

        // ENVIRONMENT
        tab('field_vm_fp_tab_environment', 'Среда'),
        group('field_vm_fp_environment', 'environment', 'Среда', [
            show_field('field_vm_fp_environment_show'),
            image_field('field_vm_fp_environment_bg', 'background', 'Фон'),
            text_field('field_vm_fp_environment_under', 'under_title', 'Надзаголовок', 'Среда'),
            text_field('field_vm_fp_environment_title', 'title', 'Заголовок', 'Герметичная и модерируемая среда'),
            text_field('field_vm_fp_environment_brand', 'brand', 'Бренд', 'ДАВАЙ ВМЕСТЕ'),
            repeater('field_vm_fp_environment_cards', 'cards', 'Карточки', [
                image_field('field_vm_fp_environment_cards_icon', 'icon', 'Иконка', '30'),
                text_field('field_vm_fp_environment_cards_title', 'title', 'Заголовок', '', '70'),
                textarea_field('field_vm_fp_environment_cards_text', 'text', 'Текст'),
            ], 'Добавить карточку'),
        ]),

        // EVENTS
        tab('field_vm_fp_tab_events', 'Афиша'),
        group('field_vm_fp_events', 'events', 'Афиша событий', [
            show_field('field_vm_fp_events_show'),
            text_field('field_vm_fp_events_under', 'under_title', 'Надзаголовок', 'Жизнь среды'),
            text_field('field_vm_fp_events_title', 'title', 'Заголовок', 'Афиша событий'),
            textarea_field('field_vm_fp_events_desc', 'description', 'Описание', 'Здесь мы создаём и обогащаем интеллектуальную среду', 2),
            button_group('field_vm_fp_events_all', 'button_all', 'Кнопка «Все мероприятия»', 'Смотреть все мероприятия', '#'),
            repeater('field_vm_fp_events_items', 'items', 'События', [
                select_field('field_vm_fp_events_items_type', 'type', 'Формат', [
                    'open' => 'Открытый',
                    'closed' => 'Закрытый',
                ], 'open', '33'),
                text_field('field_vm_fp_events_items_badge', 'badge', 'Бейдж', '', '33'),
                text_field('field_vm_fp_events_items_place', 'place', 'Формат проведения', 'Онлайн', '33'),
                text_field('field_vm_fp_events_items_city', 'city', 'Город', 'г. Екатеринбург', '33'),
                image_field('field_vm_fp_events_items_image', 'image', 'Обложка'),
                text_field('field_vm_fp_events_items_title', 'title', 'Название'),
                image_field('field_vm_fp_events_items_avatar', 'author_avatar', 'Аватар', '33'),
                text_field('field_vm_fp_events_items_author', 'author_name', 'Имя', '', '33'),
                text_field('field_vm_fp_events_items_role', 'author_role', 'Роль', '', '33'),
                text_field('field_vm_fp_events_items_datetime', 'datetime', 'Дата и время', '15 февраля в 11:00', '50'),
                text_field('field_vm_fp_events_items_duration', 'duration', 'Длительность', '2 часа', '50'),
            ], 'Добавить событие'),
        ]),

        // PARTNERS
        tab('field_vm_fp_tab_partners', 'Партнёры'),
        group('field_vm_fp_partners', 'partners', 'Партнёры', [
            show_field('field_vm_fp_partners_show'),
            text_field('field_vm_fp_partners_under', 'under_title', 'Надзаголовок', 'Партнеры'),
            text_field('field_vm_fp_partners_title', 'title', 'Заголовок', 'Союзники и резиденты экосистемы'),
            text_field('field_vm_fp_partners_join', 'join_text', 'Текст кнопки', 'Стать участником'),
            repeater('field_vm_fp_partners_items', 'items', 'Партнёры', [
                image_field('field_vm_fp_partners_items_avatar', 'avatar', 'Аватар в табе', '33'),
                text_field('field_vm_fp_partners_items_tab_name', 'tab_name', 'Имя в табе', '', '33'),
                text_field('field_vm_fp_partners_items_tab_role', 'tab_role', 'Роль в табе', '', '33'),
                image_field('field_vm_fp_partners_items_photo', 'photo', 'Фото'),
                text_field('field_vm_fp_partners_items_name', 'name', 'Имя'),
                repeater('field_vm_fp_partners_items_tags', 'tags', 'Теги', [
                    text_field('field_vm_fp_partners_items_tags_item', 'text', 'Тег'),
                ], 'Добавить тег', 'table'),
                textarea_field('field_vm_fp_partners_items_text', 'text', 'Описание'),
                text_field('field_vm_fp_partners_items_lead', 'lead', 'Подзаголовок списка', 'Беру на себя:'),
                repeater('field_vm_fp_partners_items_list', 'list', 'Список', [
                    text_field('field_vm_fp_partners_items_list_item', 'text', 'Пункт'),
                ], 'Добавить пункт'),
                button_group('field_vm_fp_partners_items_more', 'more', 'Ссылка «Узнать больше»', 'Узнать больше о партнере', '#'),
            ], 'Добавить партнёра'),
        ]),

        // REQUEST
        tab('field_vm_fp_tab_request', 'Заявка'),
        group('field_vm_fp_request', 'request', 'Форма заявки', [
            show_field('field_vm_fp_request_show'),
            text_field('field_vm_fp_request_title', 'title', 'Заголовок', 'Давайте вместе сделаем шаг к осмысленным отношениям'),
            textarea_field('field_vm_fp_request_text', 'text', 'Текст', 'Оставьте заявку, чтобы открыть доступ к среде созвучных людей.', 2),
            text_field('field_vm_fp_request_submit', 'submit_text', 'Текст кнопки', 'Отправить заявку'),
            wysiwyg_field('field_vm_fp_request_offer', 'offer_label', 'Согласие с офертой', 'Я подтверждаю, что ознакомлен (а) с <a href="#">офертой</a>'),
            wysiwyg_field('field_vm_fp_request_privacy', 'privacy_label', 'Согласие на ПДн', 'Я подтверждаю, что ознакомлен (а) с <a href="#">политикой в отношении обработки персональных данных</a> и даю своё согласие на обработку персональных данных'),
            wysiwyg_field('field_vm_fp_request_ads', 'ads_label', 'Согласие на рассылку', 'Я ознакомлен (а) с <a href="#">политикой рекламной рассылки</a> и даю своё согласие на рекламную рассылку'),
        ]),
    ],
    'location' => [[['param' => 'page_type', 'operator' => '==', 'value' => 'front_page']]],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,
    'modified' => $modified,
];

/* ========== ABOUT PAGE ========== */
$about = [
    'key' => 'group_vmeste_about_page',
    'title' => 'О нас',
    'fields' => [
        tab('field_vm_ab_tab_main', 'Главный экран'),
        group('field_vm_ab_main', 'about_main', 'Главный экран', [
            show_field('field_vm_ab_main_show'),
            image_field('field_vm_ab_main_bg', 'background', 'Фон'),
            text_field('field_vm_ab_main_lead', 'lead', 'Лид', 'Ценностный фундамент семьи и отношений'),
            text_field('field_vm_ab_main_title', 'title', 'Заголовок', 'ДАВАЙ ВМЕСТЕ'),
            textarea_field('field_vm_ab_main_desc', 'description', 'Описание', 'Узнайте какие люди в нашем брачном агентстве подходят именно вам', 2),
            button_group('field_vm_ab_main_btn_1', 'button_primary', 'Кнопка основная', 'Пройти опрос'),
            button_group('field_vm_ab_main_btn_2', 'button_secondary', 'Кнопка вторичная', 'Создать анкету'),
            repeater('field_vm_ab_main_cards', 'cards', 'Карточки', [
                image_field('field_vm_ab_main_cards_icon', 'icon', 'Иконка', '30'),
                textarea_field('field_vm_ab_main_cards_text', 'text', 'Текст'),
            ], 'Добавить карточку'),
        ]),

        tab('field_vm_ab_tab_why', 'Клиенты агентства'),
        group('field_vm_ab_why', 'why_we', 'Клиенты агентства', [
            show_field('field_vm_ab_why_show'),
            text_field('field_vm_ab_why_label', 'under_title', 'Надзаголовок', 'Клиенты агентства'),
            text_field('field_vm_ab_why_title_d', 'title_desktop', 'Заголовок (десктоп)', 'Экосистема осмысленных отношений'),
            text_field('field_vm_ab_why_title_m', 'title_mobile', 'Заголовок (мобильный)', 'Найдите «своего» человека в комфортной среде'),
            text_field('field_vm_ab_why_subtitle', 'subtitle', 'Подзаголовок', 'Какие люди в нашей среде'),
            textarea_field('field_vm_ab_why_text', 'text', 'Текст', 'Мы создали условия для сближения на вашем уровне. В интеллектуальной обстановке, без публики и репутационных рисков.'),
            repeater('field_vm_ab_why_items', 'items', 'Пункты', [
                image_field('field_vm_ab_why_items_photo', 'photo', 'Фото'),
                textarea_field('field_vm_ab_why_items_caption', 'caption', 'Подпись'),
            ], 'Добавить пункт'),
        ]),

        tab('field_vm_ab_tab_audience', 'Для кого'),
        group('field_vm_ab_audience', 'audience', 'Для кого', [
            show_field('field_vm_ab_audience_show'),
            text_field('field_vm_ab_audience_label', 'under_title', 'Надзаголовок', 'Это для вас'),
            text_field('field_vm_ab_audience_title', 'title', 'Заголовок', 'Для кого наше брачное агентство?'),
            textarea_field('field_vm_ab_audience_text_1', 'text_1', 'Текст 1', 'К нам обращаются мужчины и женщины, которые хотят построить серьёзные отношения и встретить подходящего партнёра.'),
            textarea_field('field_vm_ab_audience_text_2', 'text_2', 'Текст 2', 'Это состоявшиеся люди с насыщенной жизнью, карьерой и высокими требованиями к отношениям. Они ценят своё время и ищут человека, с которым совпадают ценности, взгляды и планы на будущее.'),
            textarea_field('field_vm_ab_audience_aside', 'aside', 'Акцент', 'Мы берём поиск на себя — от подбора подходящих кандидатов до знакомства.'),
            textarea_field('field_vm_ab_audience_lead', 'lead', 'Лид у фото', 'Вам остаётся лишь довериться процессу и сделать шаг навстречу, чтобы обрести глубокую связь для семейного наследия.'),
            repeater('field_vm_ab_audience_cards', 'cards', 'Карточки', [
                image_field('field_vm_ab_audience_cards_photo', 'photo', 'Фото'),
                text_field('field_vm_ab_audience_cards_badge', 'badge', 'Бейдж', 'Женщины'),
                textarea_field('field_vm_ab_audience_cards_caption', 'caption', 'Подпись', 'Первая консультация конфиденциальна и ни к чему вас не обязывает.'),
                text_field('field_vm_ab_audience_cards_btn', 'button_text', 'Текст кнопки', 'Подать заявку на вступление'),
            ], 'Добавить карточку'),
        ]),

        tab('field_vm_ab_tab_trust', 'Почему доверяют'),
        group('field_vm_ab_trust', 'trust', 'Почему доверяют', [
            show_field('field_vm_ab_trust_show'),
            text_field('field_vm_ab_trust_label', 'under_title', 'Надзаголовок', 'Агентство «Давай вместе»'),
            text_field('field_vm_ab_trust_title', 'title', 'Заголовок', 'Почему нам доверяют?'),
            text_field('field_vm_ab_trust_submit', 'submit_text', 'Кнопка заявки', 'Создать заявку'),
            text_field('field_vm_ab_trust_more_d', 'more_desktop', 'Кнопка тарифов (десктоп)', 'Посмотреть тарифы услуг'),
            text_field('field_vm_ab_trust_more_m', 'more_mobile', 'Кнопка тарифов (мобильный)', 'Посмотреть пакеты услуг'),
            repeater('field_vm_ab_trust_items', 'items', 'Пункты', [
                text_field('field_vm_ab_trust_items_name', 'name', 'Заголовок'),
                textarea_field('field_vm_ab_trust_items_text', 'text', 'Текст'),
            ], 'Добавить пункт'),
        ]),

        tab('field_vm_ab_tab_tariffs', 'Тарифы'),
        group('field_vm_ab_tariffs', 'tariffs', 'Тарифы', [
            show_field('field_vm_ab_tariffs_show'),
            text_field('field_vm_ab_tariffs_label_d', 'label_desktop', 'Надзаголовок (десктоп)', 'Тарифы услуг'),
            text_field('field_vm_ab_tariffs_label_m', 'label_mobile', 'Надзаголовок (мобильный)', 'Пакеты услуг'),
            text_field('field_vm_ab_tariffs_title_d', 'title_desktop', 'Заголовок (десктоп)', 'Тарифные предложения «Давай вместе»'),
            text_field('field_vm_ab_tariffs_title_m', 'title_mobile', 'Заголовок (мобильный)', 'Пакетные предложения «Давай вместе»'),
            repeater('field_vm_ab_tariffs_cards', 'cards', 'Тарифы', [
                true_false_field('field_vm_ab_tariffs_cards_popular', 'is_popular', 'Популярный', 0, '30'),
                text_field('field_vm_ab_tariffs_cards_badge', 'badge', 'Бейдж', '', '70'),
                image_field('field_vm_ab_tariffs_cards_photo', 'photo', 'Фото'),
                text_field('field_vm_ab_tariffs_cards_name', 'name', 'Название'),
                textarea_field('field_vm_ab_tariffs_cards_desc', 'description', 'Описание'),
                text_field('field_vm_ab_tariffs_cards_included', 'included_label', 'Заголовок списка', 'Что включено'),
                repeater('field_vm_ab_tariffs_cards_list', 'list', 'Список', [
                    text_field('field_vm_ab_tariffs_cards_list_item', 'text', 'Пункт'),
                ], 'Добавить пункт'),
                text_field('field_vm_ab_tariffs_cards_price', 'price', 'Цена', '', '50'),
                text_field('field_vm_ab_tariffs_cards_period', 'period', 'Срок', '', '50'),
                text_field('field_vm_ab_tariffs_cards_btn', 'button_text', 'Текст кнопки', 'Выбрать тариф'),
            ], 'Добавить тариф'),
        ]),

        tab('field_vm_ab_tab_agency', 'Брачное агентство'),
        group('field_vm_ab_agency', 'agency', 'Брачное агентство', [
            show_field('field_vm_ab_agency_show'),
            text_field('field_vm_ab_agency_label', 'label', 'Надзаголовок', 'Брачное агентство'),
            text_field('field_vm_ab_agency_title', 'title', 'Заголовок', 'ДАВАЙ ВМЕСТЕ'),
            text_field('field_vm_ab_agency_subtitle', 'subtitle', 'Подзаголовок', 'Это уверенный шаг к обретению своего человека'),
            textarea_field('field_vm_ab_agency_col_1', 'col_1', 'Колонка 1', 'В основе нашей методики лежат глубокое понимание психологии отношений и искреннее желание способствовать созданию счастливых пар и семей.'),
            textarea_field('field_vm_ab_agency_col_2', 'col_2', 'Колонка 2', 'Мы создали продуманную систему, в которой каждый эксперт играет важную роль для построения эффективного и безопасного сценария.'),
            image_field('field_vm_ab_agency_poster', 'poster', 'Постер видео'),
            file_field('field_vm_ab_agency_video', 'video', 'Видеофайл'),
            textarea_field('field_vm_ab_agency_aside_lead', 'aside_lead', 'Акцент', 'Вы приходите за осмысленными и глубокими отношениями,'),
            textarea_field('field_vm_ab_agency_aside_text', 'aside_text', 'Текст справа', 'а мы — предоставляем общество единомышленников и сильную команду психологов и кураторов, которые будут сопровождать и поддерживать вас на всех этапах'),
        ]),

        tab('field_vm_ab_tab_survey', 'Опрос'),
        group('field_vm_ab_survey', 'survey', 'Опрос', [
            show_field('field_vm_ab_survey_show'),
            text_field('field_vm_ab_survey_title', 'title', 'Заголовок', 'Пройдите анонимный мини-опрос и узнайте,'),
            text_field('field_vm_ab_survey_lead', 'lead', 'Лид', 'кого мы можем предложить лично для вас'),
            textarea_field('field_vm_ab_survey_text', 'text', 'Текст', 'Всего пять шагов и мы подберем вам кандидата. Всё анонимно и без спама.', 2),
            text_field('field_vm_ab_survey_btn', 'button_text', 'Текст кнопки', 'Пройти опрос'),
            text_field('field_vm_ab_survey_note', 'note', 'Примечание', '*Данные придут на вашу почту'),
        ]),

        tab('field_vm_ab_tab_anketa', 'Анкета'),
        group('field_vm_ab_anketa', 'anketa', 'Анкета', [
            show_field('field_vm_ab_anketa_show'),
            text_field('field_vm_ab_anketa_title', 'title', 'Заголовок', 'Анкета для подбора кандидата'),
            text_field('field_vm_ab_anketa_submit', 'submit_text', 'Текст кнопки', 'Отправить анкету'),
            wysiwyg_field('field_vm_ab_anketa_offer', 'offer_label', 'Согласие с офертой', 'Я подтверждаю, что ознакомлен (а) с <a href="#">офертой</a>'),
            wysiwyg_field('field_vm_ab_anketa_privacy', 'privacy_label', 'Согласие на ПДн', 'Я подтверждаю, что ознакомлен (а) с <a href="#">политикой в отношении обработки персональных данных</a> и даю своё согласие на обработку персональных данных'),
            wysiwyg_field('field_vm_ab_anketa_ads', 'ads_label', 'Согласие на рассылку', 'Я ознакомлен (а) с <a href="#">политикой рекламной рассылки</a> и даю на нее своё согласие'),
            text_field('field_vm_ab_anketa_help_title', 'help_title', 'Помощь — заголовок', 'Нет времени заполнять анкету?'),
            text_field('field_vm_ab_anketa_help_text', 'help_text', 'Помощь — текст', 'Напишите нам в телеграм и мы ответим вам'),
            text_field('field_vm_ab_anketa_telegram', 'telegram', 'Telegram', '#'),
            text_field('field_vm_ab_anketa_max', 'max', 'MAX', '#'),
            text_field('field_vm_ab_anketa_vk', 'vk', 'ВКонтакте', '#'),
        ]),
    ],
    'location' => [[['param' => 'page_template', 'operator' => '==', 'value' => 'about.php']]],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,
    'modified' => $modified,
];

save_group($outDir, $general);
save_group($outDir, $front);
save_group($outDir, $about);

echo "Done.\n";
