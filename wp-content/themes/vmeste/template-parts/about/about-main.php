<?php
$section = $args['section'] ?? (get_field('about_main') ?: []);
if (!theme_section_show($section)) {
	return;
}

$cards = $section['cards'] ?? [];
$btn1 = $section['button_primary'] ?? [];
$btn2 = $section['button_secondary'] ?? [];

if (mb_strtolower(trim($btn1['text'] ?? '')) === 'пройти опрос') {
	$btn1['url'] = '#anketa';
}
?>

<section class="about-main" style="<?= theme_bg_style($section['background'] ?? null) ?>">
	<div class="about-main__container container">
		<div class="about-main__content">
			<h2 class="about-main__lead"><?= esc_html($section['lead'] ?? '') ?><span class="about-main__lead-break"></span></h2>
			<h1 class="about-main__title"><span class="about-main__title-text"><?= esc_html($section['title'] ?? '') ?></span></h1>
			<p class="about-main__description"><?= esc_html($section['description'] ?? '') ?></p>
			<div class="about-main__buttons">
				<?php
				theme_button($btn1, 'btn btn--primary', [], empty($btn1['url']) ? 'button' : 'a');
				theme_button($btn2, 'btn btn--trans', [], empty($btn2['url']) ? 'button' : 'a');
				?>
			</div>
		</div>
	</div>
	<div class="about-main__cards">
		<div class="container">
			<div class="about-main__row">
				<?php foreach ($cards as $card) : ?>
					<article class="about-main__card">
						<?php theme_image($card['icon'] ?? null, 'about-main__card-icon', 'full'); ?>
						<p class="about-main__card-text"><?= esc_html($card['text'] ?? '') ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
