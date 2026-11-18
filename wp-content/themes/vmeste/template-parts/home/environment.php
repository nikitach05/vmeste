<?php
$section = $args['section'] ?? (get_field('environment') ?: []);
if (!theme_section_show($section)) {
	return;
}

$cards = $section['cards'] ?? [];
?>

<section class="environment p-indent" id="sreda" style="<?= theme_bg_style($section['background'] ?? null) ?>">
	<div class="container environment__container">
		<div class="environment__intro">
			<div class="environment__under-title under-title"><?= esc_html($section['under_title'] ?? '') ?></div>
			<div class="environment__copy">
				<h2 class="environment__title"><?= nl2br(esc_html($section['title'] ?? '')) ?></h2>
				<div class="environment__brand"><?= esc_html($section['brand'] ?? '') ?></div>
			</div>
		</div>
		<div class="environment__cards">
			<?php foreach ($cards as $card) : ?>
				<article class="environment__card">
					<?php theme_image($card['icon'] ?? null, 'environment__card-icon', 'full'); ?>
					<h3 class="environment__card-title"><?= esc_html($card['title'] ?? '') ?></h3>
					<p class="environment__card-text"><?= esc_html($card['text'] ?? '') ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
