<?php
$footer = get_field('footer', 'option') ?: [];
$modals = get_field('modals', 'option') ?: [];

$note = theme_text($footer['note'] ?? '', 'Работаем онлайн по всему миру. Офис находится в г. Екатеринбург');
$title = theme_text($footer['title'] ?? '', 'ДАВАЙ ВМЕСТЕ');
$hours = theme_text($footer['hours'] ?? '', 'Пн-Пт с 10:00 до 19:00');
$address = theme_text($footer['address'] ?? '', '620028, г. Екатеринбург, ул. Верх-Исетский бульвар');
$phone = theme_text($footer['phone'] ?? '', '+7 (999) 333-29-52');
$copyright = theme_text($footer['copyright'] ?? '', '© 2026 Давай вместе. Все права защищены');
$developer = theme_text($footer['developer'] ?? '', 'Разработка сайта PKDESIGN');

$nav_1 = is_array($footer['nav_1'] ?? null) ? $footer['nav_1'] : [];
$nav_2 = is_array($footer['nav_2'] ?? null) ? $footer['nav_2'] : [];
$legal = is_array($footer['legal'] ?? null) ? $footer['legal'] : [];

$socials = [
	['url' => $footer['youtube'] ?? '#', 'icon' => 'youtube.svg', 'label' => 'YouTube'],
	['url' => $footer['max'] ?? '#', 'icon' => 'max.svg', 'label' => 'MAX'],
	['url' => $footer['telegram'] ?? '#', 'icon' => 'telegram.svg', 'label' => 'Telegram'],
	['url' => $footer['vk'] ?? '#', 'icon' => 'vk.svg', 'label' => 'ВКонтакте'],
];
?>

<?php get_template_part('template-parts/shared/modals', null, ['modals' => $modals]); ?>

<footer class="footer">
	<div class="container">
		<p class="footer__note"><?= esc_html($note) ?></p>
		<h2 class="footer__title"><span class="footer__title-text"><?= esc_html($title) ?></span></h2>
	</div>

	<div class="container">
		<div class="footer__main">
			<div class="footer__navs">
				<nav class="footer__nav">
					<?php foreach ($nav_1 as $link) : ?>
						<a class="footer__link" href="<?= esc_url(theme_menu_href($link['url'] ?? '')) ?>">
							<?= esc_html($link['text'] ?? '') ?>
						</a>
					<?php endforeach; ?>
				</nav>
				<nav class="footer__nav">
					<?php foreach ($nav_2 as $link) : ?>
						<a class="footer__link" href="<?= esc_url(theme_menu_href($link['url'] ?? '')) ?>">
							<?= esc_html($link['text'] ?? '') ?>
						</a>
					<?php endforeach; ?>
				</nav>
			</div>

			<div class="footer__contacts">
				<p class="footer__hours"><?= esc_html($hours) ?></p>
				<p class="footer__address"><?= esc_html($address) ?></p>
				<div class="footer__actions">
					<?php foreach ($socials as $social) : ?>
						<a class="footer__social" href="<?= esc_url($social['url']) ?>" aria-label="<?= esc_attr($social['label']) ?>">
							<img src="<?= esc_url(theme_asset('img/svg/' . $social['icon'])) ?>" alt="">
						</a>
					<?php endforeach; ?>
					<a class="footer__call" href="<?= esc_attr(theme_phone_href($phone)) ?>">
						<img src="<?= esc_url(theme_asset('img/svg/call.svg')) ?>" alt="">
						<span><?= esc_html($phone) ?></span>
					</a>
				</div>
			</div>

			<nav class="footer__legal">
				<?php foreach ($legal as $link) : ?>
					<a class="footer__link" href="<?= esc_url($link['url'] ?? '#') ?>">
						<?= esc_html($link['text'] ?? '') ?>
					</a>
				<?php endforeach; ?>
			</nav>
		</div>

		<div class="footer__bottom">
			<p class="footer__copy"><?= esc_html($copyright) ?></p>
			<p class="footer__dev"><?= esc_html($developer) ?></p>
			<?php
			if (!empty($footer['payments'])) {
				theme_image($footer['payments'], 'footer__payments', 'full');
			} else {
				printf(
					'<img class="footer__payments" src="%s" alt="Mastercard, Visa, МИР, СБП">',
					esc_url(theme_asset('img/svg/payments.svg'))
				);
			}
			?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
