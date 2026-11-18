<?php
$section = $args['section'] ?? (get_field('for_you') ?: []);
if (!theme_section_show($section)) {
	return;
}

$items = $section['items'] ?? [];
if (empty($items)) {
	$items = [
		['title' => 'Внимание к личности', 'text' => 'психологический подход, рефлексия и осознанность'],
		['title' => 'Создание семьи', 'text' => 'династический фундамент и долгосрочное наследие'],
		['title' => 'Ценностный подбор', 'text' => 'среда равных по масштабу, этике и жизненным смыслам'],
		['title' => 'Селективное сообщество', 'text' => 'люди с общими ценностями в едином контексте'],
	];
}
?>

<section class="for-you p-indent">
	<div class="container">
		<div class="for-you__layout">
			<div class="for-you__under-title under-title"><?= esc_html(theme_text($section['under_title'] ?? '', 'Это для вас')) ?></div>
			<div class="for-you__main">
				<h2 class="for-you__title title"><?= nl2br(esc_html(theme_text($section['title'] ?? '', "На чём построен проект\n«Давай вместе»"))) ?></h2>
				<div class="for-you__grid">
					<?php foreach ($items as $item) : ?>
						<div class="for-you__item">
							<h3 class="for-you__item-title"><?= esc_html($item['title'] ?? '') ?></h3>
							<p class="for-you__item-text"><?= esc_html($item['text'] ?? '') ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="for-you__media">
				<?php theme_image($section['image'] ?? null, '', 'large', 'image5.webp'); ?>
			</div>
		</div>
	</div>
</section>
