<?php
$section = $args['section'] ?? (get_field('trust') ?: []);
if (!theme_section_show($section)) {
	return;
}

$items = $section['items'] ?? [];
$total = count($items);
$mid = (int) ceil($total / 2);
$columns = [
	array_slice($items, 0, $mid, true),
	array_slice($items, $mid, null, true),
];

$title = trim($section['title'] ?? '');
$title_lead = $title;
$title_tail = '';
if (preg_match('/^(.*)\s+(\S+)$/u', $title, $title_match)) {
	$title_lead = $title_match[1];
	$title_tail = $title_match[2];
}
?>

<section class="trust p-indent">
	<div class="container">
		<div class="trust__intro">
			<div class="trust__label under-title"><?= esc_html($section['under_title'] ?? '') ?></div>
			<h2 class="trust__title title"><?php if ($title_tail !== '') : ?><?= esc_html($title_lead) ?><span class="trust__title-break"> </span><?= esc_html($title_tail) ?><?php else : ?><?= esc_html($title) ?><?php endif; ?></h2>
		</div>
		<div class="trust__columns">
			<?php foreach ($columns as $col) : ?>
				<div class="trust__col">
					<?php foreach ($col as $index => $item) : ?>
						<article class="trust__item">
							<div class="trust__head">
								<span class="trust__index"><?= esc_html(($index + 1) . '/' . $total) ?></span>
								<h3 class="trust__name"><?= esc_html($item['name'] ?? '') ?></h3>
							</div>
							<p class="trust__text"><?= esc_html($item['text'] ?? '') ?></p>
						</article>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="trust__actions">
			<?php if (!empty($section['submit_text'])) : ?>
				<button class="btn btn--primary trust__submit" type="button" data-modal="order-modal">
					<?= esc_html($section['submit_text']) ?>
				</button>
			<?php endif; ?>
			<?php if (!empty($section['more_desktop']) || !empty($section['more_mobile'])) : ?>
				<button class="btn trust__more" type="button" data-scroll="#tariffs">
					<span class="trust__more-desktop"><?= esc_html($section['more_desktop'] ?? '') ?></span>
					<span class="trust__more-mobile"><?= esc_html($section['more_mobile'] ?? '') ?></span>
				</button>
			<?php endif; ?>
		</div>
	</div>
</section>
