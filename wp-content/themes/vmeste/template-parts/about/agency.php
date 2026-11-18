<?php
$section = $args['section'] ?? (get_field('agency') ?: []);
if (!theme_section_show($section)) {
	return;
}

$poster = theme_img_url($section['poster'] ?? null);
$video_url = '';
if (!empty($section['video']['url'])) {
	$video_url = $section['video']['url'];
} elseif (!empty($section['video']) && is_string($section['video'])) {
	$video_url = $section['video'];
}

$title = trim($section['title'] ?? '');
$title_parts = $title !== '' ? preg_split('/\s+/u', $title, 2) : [];
?>

<section class="agency p-indent">
	<div class="container">
		<div class="agency__intro">
			<p class="agency__label"><?= esc_html($section['label'] ?? '') ?></p>
			<h2 class="agency__title"><?php if (count($title_parts) === 2) : ?><?= esc_html($title_parts[0]) ?><span class="agency__title-break"> </span><?= esc_html($title_parts[1]) ?><?php else : ?><?= esc_html($title) ?><?php endif; ?></h2>
			<p class="agency__subtitle"><?= esc_html($section['subtitle'] ?? '') ?></p>
			<div class="agency__cols">
				<p><?= esc_html($section['col_1'] ?? '') ?></p>
				<p><?= esc_html($section['col_2'] ?? '') ?></p>
			</div>
		</div>
	</div>
	<div class="agency__stage">
		<button class="agency__video" type="button" data-video="<?= esc_url($video_url) ?>" data-poster="<?= esc_url($poster) ?>" aria-label="Смотреть видео">
			<?php theme_image($section['poster'] ?? null, 'agency__poster', 'large'); ?>
			<img class="agency__play" src="<?= esc_url(theme_asset('img/svg/play.svg')) ?>" alt="">
		</button>
		<div class="agency__aside">
			<p class="agency__aside-lead"><?= esc_html($section['aside_lead'] ?? '') ?></p>
			<p class="agency__aside-text"><?= esc_html($section['aside_text'] ?? '') ?></p>
		</div>
	</div>
</section>
