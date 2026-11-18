<?php
$section = $args['section'] ?? (get_field('for_whom') ?: []);
if (!theme_section_show($section)) {
	return;
}
?>

<section class="for-whom p-indent" style="<?= theme_bg_style($section['background'] ?? null, 'image.webp') ?>">
	<div class="for-whom__container container">
		<div class="for-whom__content">
			<div class="for-whom__under-title under-title"><?= esc_html(theme_text($section['under_title'] ?? '', 'Кому подойдёт')) ?></div>
			<h2 class="for-whom__title title"><?= esc_html(theme_text($section['title'] ?? '', 'Для того, кто исключает случайность')) ?></h2>
			<div class="for-whom__description"><?= $section['description'] ?? 'Контекст для создания семьи в атмосфере безусловного принятия и доверия. <strong>Мы берем на себя фильтрацию среды, чтобы вы могли быть собой среди равных.</strong>' ?></div>
		</div>
	</div>
</section>
