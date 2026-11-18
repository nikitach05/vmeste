<?php
$section = $args['section'] ?? (get_field('audience') ?: []);
if (!theme_section_show($section)) {
	return;
}

$cards = $section['cards'] ?? [];
if (empty($cards)) {
	$cards = [
		['badge' => 'Женщины', 'caption' => 'Первая консультация конфиденциальна и ни к чему вас не обязывает.', 'button_text' => 'Подать заявку на вступление', '_photo' => 'image21.webp'],
		['badge' => 'Мужчины', 'caption' => 'Первая консультация конфиденциальна и ни к чему вас не обязывает.', 'button_text' => 'Подать заявку на вступление', '_photo' => 'image22.webp'],
	];
}
?>

<section class="audience p-indent">
	<div class="container">
		<div class="audience__layout">
			<div class="audience__copy">
				<div class="audience__label under-title"><?= esc_html(theme_text($section['under_title'] ?? '', 'Это для вас')) ?></div>
				<h2 class="audience__title title"><?= nl2br(esc_html(theme_text($section['title'] ?? '', "Для кого наше\nбрачное агентство?"))) ?></h2>
				<p class="audience__text"><?= esc_html(theme_text($section['text_1'] ?? '', 'К нам обращаются мужчины и женщины, которые хотят построить серьёзные отношения и встретить подходящего партнёра.')) ?></p>
				<p class="audience__text audience__text--next"><?= esc_html(theme_text($section['text_2'] ?? '', 'Это состоявшиеся люди с насыщенной жизнью, карьерой и высокими требованиями к отношениям. Они ценят своё время и ищут человека, с которым совпадают ценности, взгляды и планы на будущее.')) ?></p>
				<p class="audience__aside"><?= esc_html(theme_text($section['aside'] ?? '', 'Мы берём поиск на себя — от подбора подходящих кандидатов до знакомства.')) ?></p>
			</div>
			<div class="audience__media">
				<p class="audience__lead"><?= esc_html(theme_text($section['lead'] ?? '', 'Вам остаётся лишь довериться процессу и сделать шаг навстречу, чтобы обрести глубокую связь для семейного наследия.')) ?></p>
				<?php foreach ($cards as $card) : ?>
					<article class="audience__card">
						<div class="audience__photo">
							<?php theme_image($card['photo'] ?? null, '', 'large', $card['_photo'] ?? 'image21.webp'); ?>
							<span class="audience__badge"><?= esc_html($card['badge'] ?? '') ?></span>
						</div>
						<p class="audience__caption"><?= esc_html($card['caption'] ?? '') ?></p>
						<button class="btn btn--primary audience__submit" type="button" data-modal="order-modal">
							<?= esc_html(theme_text($card['button_text'] ?? '', 'Подать заявку на вступление')) ?>
						</button>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
