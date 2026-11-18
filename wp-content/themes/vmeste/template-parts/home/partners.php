<?php
$section = $args['section'] ?? (get_field('partners') ?: []);
if (!theme_section_show($section)) {
	return;
}

$items = $section['items'] ?? [];
?>

<section class="partners p-indent" id="rezidenty">
	<div class="container">
		<div class="partners__header">
			<div class="partners__under-title under-title"><?= esc_html($section['under_title'] ?? '') ?></div>
			<h2 class="partners__title"><?= nl2br(esc_html($section['title'] ?? '')) ?></h2>
		</div>

		<div class="partners__tabs">
			<?php foreach ($items as $i => $item) :
				$tab_id = 'partner-' . ($i + 1);
				?>
				<button class="partners__tab<?= $i === 0 ? ' active' : '' ?>" type="button" data-tab="<?= esc_attr($tab_id) ?>">
					<?php theme_image($item['avatar'] ?? null, 'partners__avatar', 'thumbnail'); ?>
					<span class="partners__name"><?= nl2br(esc_html($item['tab_name'] ?? '')) ?></span>
					<span class="partners__role"><?= esc_html($item['tab_role'] ?? '') ?></span>
				</button>
			<?php endforeach; ?>
		</div>

		<?php foreach ($items as $i => $item) :
			$tab_id = 'partner-' . ($i + 1);
			$more = $item['more'] ?? [];
			?>
			<article class="partners__person<?= $i === 0 ? ' active' : '' ?>" data-block="<?= esc_attr($tab_id) ?>">
				<div class="partners__photo">
					<?php theme_image($item['photo'] ?? null, '', 'large'); ?>
				</div>
				<div class="partners__info">
					<h3 class="partners__person-name"><?= esc_html($item['name'] ?? '') ?></h3>
					<?php if (!empty($item['tags'])) : ?>
						<div class="partners__tags">
							<?php foreach ($item['tags'] as $tag) : ?>
								<span class="partners__tag"><?= esc_html($tag['text'] ?? '') ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<p class="partners__text"><?= esc_html($item['text'] ?? '') ?></p>
					<?php if (!empty($item['lead'])) : ?>
						<p class="partners__lead"><?= esc_html($item['lead']) ?></p>
					<?php endif; ?>
					<?php if (!empty($item['list'])) : ?>
						<ul class="partners__list">
							<?php foreach ($item['list'] as $li) : ?>
								<li><?= esc_html($li['text'] ?? '') ?></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
					<?php if (!empty($more['url'])) : ?>
						<?php theme_button($more, 'partners__more'); ?>
					<?php endif; ?>
				</div>
			</article>
		<?php endforeach; ?>

		<?php if (!empty($section['join_text'])) : ?>
			<button class="btn btn--primary partners__join" type="button" data-modal="order-modal">
				<?= esc_html($section['join_text']) ?>
			</button>
		<?php endif; ?>
	</div>
</section>
