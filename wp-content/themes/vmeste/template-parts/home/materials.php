<?php
$section = $args['section'] ?? (get_field('materials') ?: []);
if (!theme_section_show($section)) {
	return;
}

$items = $section['items'] ?? [];
$btn_all = $section['button_all'] ?? [];
?>

<section class="materials p-indent" id="smysly">
	<div class="container">
		<div class="materials__header">
			<div class="materials__under-title under-title"><?= esc_html($section['under_title'] ?? '') ?></div>
			<h2 class="materials__title"><?= esc_html($section['title'] ?? '') ?></h2>
		</div>

		<div class="materials__tabs" role="tablist">
			<button class="materials__tab active" type="button" data-filter="all">Все</button>
			<button class="materials__tab" type="button" data-filter="article">Статьи</button>
			<button class="materials__tab" type="button" data-filter="video">Видео</button>
			<button class="materials__tab" type="button" data-filter="expert">Материалы экспертов</button>
		</div>
	</div>

	<div class="materials__slider-area">
		<div class="container materials__slider-container">
			<div class="swiper materials__slider">
				<div class="swiper-wrapper">
					<?php foreach ($items as $item) :
						$type = $item['type'] ?? 'article';
						$is_video = $type === 'video';
						$expert_attr = !empty($item['is_expert']) ? ' data-expert' : '';
						$poster_url = theme_img_url($item['video_poster'] ?? ($item['image'] ?? null));
						$video_url = '';
						if (!empty($item['video']['url'])) {
							$video_url = $item['video']['url'];
						} elseif (!empty($item['video']) && is_string($item['video'])) {
							$video_url = $item['video'];
						}
						?>
						<div class="swiper-slide" data-type="<?= esc_attr($type) ?>"<?= $expert_attr ?>>
							<article class="materials-card materials-card--<?= esc_attr($is_video ? 'video' : 'article') ?>">
								<div class="materials-card__media">
									<?php theme_image($item['image'] ?? null, '', 'large'); ?>
									<?php if (!empty($item['badge'])) : ?>
										<span class="materials-card__badge"><?= esc_html($item['badge']) ?></span>
									<?php endif; ?>
									<?php if ($is_video) : ?>
										<button class="materials-card__play" type="button" aria-label="Смотреть видео" data-video="<?= esc_url($video_url) ?>" data-poster="<?= esc_url($poster_url) ?>">
											<img src="<?= esc_url(theme_asset('img/svg/play.svg')) ?>" alt="">
										</button>
										<h3 class="materials-card__title"><?= esc_html($item['title'] ?? '') ?></h3>
									<?php endif; ?>
								</div>
								<?php if (!$is_video) : ?>
									<div class="materials-card__body">
										<h3 class="materials-card__title"><?= esc_html($item['title'] ?? '') ?></h3>
										<?php if (!empty($item['text'])) : ?>
											<p class="materials-card__text"><?= esc_html($item['text']) ?></p>
										<?php endif; ?>
										<?php if (!empty($item['author_name'])) : ?>
											<div class="materials-card__author">
												<?php theme_image($item['author_avatar'] ?? null, 'materials-card__avatar', 'thumbnail'); ?>
												<div class="materials-card__author-info">
													<span class="materials-card__author-name"><?= esc_html($item['author_name']) ?></span>
													<span class="materials-card__author-role"><?= esc_html($item['author_role'] ?? '') ?></span>
												</div>
											</div>
										<?php endif; ?>
										<div class="materials-card__meta">
											<span class="materials-card__tag"><?= esc_html($item['tag'] ?? '') ?></span>
											<span class="materials-card__category"><?= esc_html($item['category'] ?? '') ?></span>
										</div>
									</div>
								<?php else : ?>
									<div class="materials-card__meta">
										<span class="materials-card__tag"><?= esc_html($item['tag'] ?? '') ?></span>
										<span class="materials-card__category"><?= esc_html($item['category'] ?? '') ?></span>
									</div>
								<?php endif; ?>
							</article>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="materials__pagination swiper-pagination"></div>

			<?php if (!empty($btn_all['url'])) : ?>
				<?php theme_button($btn_all, 'btn btn--primary materials__all'); ?>
			<?php endif; ?>
		</div>
	</div>
</section>
