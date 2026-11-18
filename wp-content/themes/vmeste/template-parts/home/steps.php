<?php
/**
 * Shared steps section — reads from the home page ACF group.
 */
$home_id = theme_home_id();
$section = $args['section'] ?? ($home_id ? get_field('steps', $home_id) : null) ?: [];
$extra_class = $args['class'] ?? 'pt-indent';

if (!theme_section_show($section)) {
	return;
}

$items = $section['items'] ?? [];
$total = count($items);
$button_text = $section['button_text'] ?? '';
?>

<section class="steps <?= esc_attr($extra_class) ?>">
	<div class="container">
		<div class="steps__header">
			<div class="steps__under-title under-title"><?= esc_html($section['under_title'] ?? '') ?></div>
			<h2 class="steps__title">
				<span><?= esc_html($section['title_1'] ?? '') ?></span>
				<span><?= esc_html($section['title_2'] ?? '') ?></span>
			</h2>
		</div>
		<div class="steps__layout">
			<div class="steps__list">
				<?php foreach ($items as $i => $item) : ?>
					<article class="steps__item<?= $i === 0 ? ' steps__item--active' : '' ?>">
						<div class="steps__num"><?= esc_html(($i + 1) . '/' . $total) ?></div>
						<h3 class="steps__name"><?= esc_html($item['name'] ?? '') ?></h3>
						<p class="steps__text"><?= esc_html($item['text'] ?? '') ?></p>
					</article>
				<?php endforeach; ?>
				<?php if ($button_text !== '') : ?>
					<button class="btn btn--primary steps__apply" type="button" data-modal="order-modal"><?= esc_html($button_text) ?></button>
				<?php endif; ?>
			</div>
			<div class="steps__panel">
				<div class="steps__panel-bg" style="<?= theme_bg_style($section['panel_background'] ?? null) ?>"></div>
				<div class="steps__panel-body">
					<div class="steps__panel-media">
						<?php foreach ($items as $i => $item) : ?>
							<?php theme_image($item['image'] ?? null, $i === 0 ? 'is-active' : '', 'large'); ?>
						<?php endforeach; ?>
					</div>
					<div class="steps__panel-title"><?= esc_html($items[0]['name'] ?? '') ?></div>
					<?php if ($button_text !== '') : ?>
						<button class="btn btn--primary" type="button" data-modal="order-modal"><?= esc_html($button_text) ?></button>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
