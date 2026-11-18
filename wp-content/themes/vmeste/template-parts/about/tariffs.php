<?php
$section = $args['section'] ?? (get_field('tariffs') ?: []);
if (!theme_section_show($section)) {
	return;
}

$cards = $section['cards'] ?? [];
?>

<section class="tariffs p-indent" id="tariffs">
	<div class="container">
		<div class="tariffs__intro">
			<div class="tariffs__label under-title">
				<span class="tariffs__label-desktop"><?= esc_html($section['label_desktop'] ?? '') ?></span>
				<span class="tariffs__label-mobile"><?= esc_html($section['label_mobile'] ?? '') ?></span>
			</div>
			<h2 class="tariffs__title title">
				<span class="tariffs__title-desktop"><?= esc_html($section['title_desktop'] ?? '') ?></span>
				<span class="tariffs__title-mobile"><?= nl2br(esc_html($section['title_mobile'] ?? '')) ?></span>
			</h2>
		</div>
		<div class="tariffs__grid">
			<?php foreach ($cards as $card) :
				$popular = !empty($card['is_popular']);
				$classes = 'tariffs__card' . ($popular ? ' active tariffs__card--popular' : '');
				?>
				<article class="<?= esc_attr($classes) ?>">
					<div class="tariffs__photo">
						<?php theme_image($card['photo'] ?? null, '', 'large'); ?>
						<?php if (!empty($card['badge'])) : ?>
							<span class="tariffs__badge"><?= esc_html($card['badge']) ?></span>
						<?php endif; ?>
					</div>
					<div class="tariffs__body">
						<h3 class="tariffs__name"><?= esc_html($card['name'] ?? '') ?></h3>
						<p class="tariffs__desc"><?= esc_html($card['description'] ?? '') ?></p>
						<?php if (!empty($card['included_label'])) : ?>
							<p class="tariffs__included"><?= esc_html($card['included_label']) ?></p>
						<?php endif; ?>
						<?php if (!empty($card['list'])) : ?>
							<ul class="tariffs__list">
								<?php foreach ($card['list'] as $li) : ?>
									<li><?= esc_html($li['text'] ?? '') ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<div class="tariffs__offer">
							<div class="tariffs__price"><?= esc_html($card['price'] ?? '') ?></div>
							<div class="tariffs__period"><?= esc_html($card['period'] ?? '') ?></div>
							<?php if (!empty($card['button_text'])) : ?>
								<button class="btn btn--primary tariffs__btn" type="button" data-modal="order-modal">
									<?= esc_html($card['button_text']) ?>
								</button>
							<?php endif; ?>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
