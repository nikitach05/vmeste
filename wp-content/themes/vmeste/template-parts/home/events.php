<?php
$section = $args['section'] ?? (get_field('events') ?: []);
if (!theme_section_show($section)) {
	return;
}

$items = $section['items'] ?? [];
$btn_all = $section['button_all'] ?? [];
$calendar_svg = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><rect x="2" y="3.5" width="12" height="10.5" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M2 6.5h12M5 2v2.5M11 2v2.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>';
$clock_svg = '<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><circle cx="8" cy="8" r="5.4" stroke="currentColor" stroke-width="1.2"/><path d="M8 5.5V8l2 1.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
?>

<section class="events p-indent" id="sobytiya">
	<div class="container">
		<div class="events__header">
			<div class="events__under-title under-title"><?= esc_html($section['under_title'] ?? '') ?></div>
			<h2 class="events__title"><?= esc_html($section['title'] ?? '') ?></h2>
			<p class="events__description"><?= esc_html($section['description'] ?? '') ?></p>
		</div>

		<div class="events__tabs" role="tablist">
			<button class="events__tab active" type="button" data-filter="all">Все мероприятия</button>
			<button class="events__tab" type="button" data-filter="open">Открытый формат</button>
			<button class="events__tab" type="button" data-filter="closed">Закрытый формат</button>
		</div>
	</div>

	<div class="events__slider-area">
		<div class="container events__slider-container">
			<div class="swiper events__slider">
				<div class="swiper-wrapper">
					<?php foreach ($items as $item) : ?>
						<div class="swiper-slide" data-type="<?= esc_attr($item['type'] ?? 'open') ?>">
							<article class="events-card">
								<div class="events-card__media">
									<?php theme_image($item['image'] ?? null, '', 'large'); ?>
									<?php if (!empty($item['badge'])) : ?>
										<span class="events-card__badge"><?= esc_html($item['badge']) ?></span>
									<?php endif; ?>
								</div>
								<div class="events-card__body">
									<div class="events-card__place"><?= esc_html($item['place'] ?? '') ?><span><?= esc_html($item['city'] ?? '') ?></span></div>
									<h3 class="events-card__title"><?= esc_html($item['title'] ?? '') ?></h3>
									<?php if (!empty($item['author_name'])) : ?>
										<div class="events-card__author">
											<?php theme_image($item['author_avatar'] ?? null, 'events-card__avatar', 'thumbnail'); ?>
											<div class="events-card__author-info">
												<span class="events-card__author-name"><?= esc_html($item['author_name']) ?></span>
												<span class="events-card__author-role"><?= esc_html($item['author_role'] ?? '') ?></span>
											</div>
										</div>
									<?php endif; ?>
									<div class="events-card__meta">
										<span class="events-card__meta-item">
											<?= $calendar_svg ?>
											<?= esc_html($item['datetime'] ?? '') ?>
										</span>
										<span class="events-card__meta-item">
											<?= $clock_svg ?>
											<?= esc_html($item['duration'] ?? '') ?>
										</span>
									</div>
								</div>
							</article>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="events__pagination swiper-pagination"></div>

			<?php if (!empty($btn_all['url'])) : ?>
				<?php theme_button($btn_all, 'btn btn--primary events__all'); ?>
			<?php endif; ?>
		</div>
	</div>
</section>
