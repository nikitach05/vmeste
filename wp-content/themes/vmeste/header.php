<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<?php wp_head(); ?>

	<?php $version = '1'; ?>
	<link rel="stylesheet" href="<?= esc_url(PATH_DIST) ?>styles/main.css?v=<?= esc_attr($version) ?>">
	<link rel="stylesheet" href="<?= esc_url(PATH_DIST) ?>styles/main2.css?v=<?= esc_attr($version) ?>">
	<script type="module" src="<?= esc_url(PATH_DIST) ?>scripts/vendor.js?v=<?= esc_attr($version) ?>"></script>
	<script type="module" src="<?= esc_url(PATH_DIST) ?>scripts/main.js?v=<?= esc_attr($version) ?>"></script>
	<script src="<?= esc_url(PATH_ASSETS) ?>custom.js?v=<?= esc_attr($version) ?>"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$header = get_field('header', 'option') ?: [];
$menu_toggle = theme_text($header['menu_toggle_text'] ?? '', 'Меню');
$headerMenu = (new StructureMenu('headerMenu'))->getItemsStructureMenu();
?>

<header class="header">
	<div class="container">
		<div class="header__content">
			<ul class="header__menu menu">
				<?php foreach ($headerMenu as $item) : ?>
					<li class="menu__item<?= !empty($item->sub_item_menu) ? ' menu__item--has-children' : '' ?>">
						<a class="menu__link" href="<?= esc_url(theme_menu_href($item->url)) ?>"><?= esc_html($item->title) ?></a>
					</li>
				<?php endforeach; ?>
			</ul>

			<button class="header__menu-toggle menu-toggle" type="button"><?= esc_html($menu_toggle) ?></button>
		</div>
	</div>

	<div class="header__mobile-menu mobile-menu">
		<button class="mobile-menu__close" type="button" aria-label="Закрыть">
			<svg>
				<use href="<?= esc_url(theme_asset('img/svg-sprite/sprite.svg')) ?>#close"></use>
			</svg>
		</button>

		<ul class="mobile-menu__list">
			<?php foreach ($headerMenu as $item) : ?>
				<li class="mobile-menu__list-item">
					<a class="mobile-menu__list-link" href="<?= esc_url(theme_menu_href($item->url)) ?>"><?= esc_html($item->title) ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</header>
