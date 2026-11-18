<?php
$section = $args['section'] ?? (get_field('formats') ?: []);
if (!theme_section_show($section)) {
	return;
}

$cards = $section['cards'] ?? [];
if (empty($cards)) {
	$cards = [
		[
			'is_agency' => 0,
			'image' => null,
			'background' => null,
			'title' => 'Селективная среда',
			'text' => 'Сообщество, в котором синергия ценностей становится основой глубоких связей',
			'list' => [
				['text' => 'живые клубные встречи в культурном контексте'],
				['text' => 'подбор качественного окружения'],
				['text' => 'герметичное и модерируемое пространство'],
				['text' => 'единомыслие и взаимопонимание'],
			],
			'button' => ['text' => 'Стать частью сообщества'],
			'_fallback_image' => 'image2.webp',
		],
		[
			'is_agency' => 1,
			'image' => null,
			'background' => null,
			'title' => 'Брачное агентство',
			'text' => 'Сопровождение на всех этапах к осознанному построению семьи',
			'list' => [
				['text' => 'точность в подборе партнёра'],
				['text' => 'стратегическое создание семейного наследия'],
				['text' => 'ценностный отбор и верификация'],
				['text' => 'конфиденциальность и взаимное уважение'],
			],
			'button' => ['text' => 'Записаться на встречу'],
			'_fallback_image' => 'image3.webp',
			'_fallback_bg' => 'image4.webp',
		],
	];
}
?>

<section class="formats pt-indent" id="brachnoe-agentstvo">
	<div class="container">
		<div class="formats__header">
			<div class="formats__under-title under-title"><?= esc_html(theme_text($section['under_title'] ?? '', 'Форматы')) ?></div>
			<h2 class="formats__title title"><?= esc_html(theme_text($section['title'] ?? '', 'Экосистема осмысленных отношений')) ?></h2>
			<div class="formats__description f18-20"><?= esc_html(theme_text($section['description'] ?? '', 'Единый контекст — два уровня погружения')) ?></div>
		</div>

		<div class="formats__grid">
			<?php foreach ($cards as $card) :
				$is_agency = !empty($card['is_agency']);
				$classes = 'formats__card' . ($is_agency ? ' formats__card--agency' : '');
				?>
				<article class="<?= esc_attr($classes) ?>">
					<?php if ($is_agency) : ?>
						<div class="formats__card-bg" style="<?= theme_bg_style($card['background'] ?? null, $card['_fallback_bg'] ?? 'image4.webp') ?>"></div>
					<?php endif; ?>
					<div class="formats__media">
						<?php theme_image($card['image'] ?? null, '', 'large', $card['_fallback_image'] ?? 'image2.webp'); ?>
					</div>
					<div class="formats__body">
						<h3 class="formats__card-title"><?= esc_html($card['title'] ?? '') ?></h3>
						<p class="formats__card-text"><?= esc_html($card['text'] ?? '') ?></p>
						<?php if (!empty($card['list'])) : ?>
							<ul class="formats__list">
								<?php foreach ($card['list'] as $li) : ?>
									<li><?= esc_html($li['text'] ?? '') ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<?php
						$btn = $card['button'] ?? null;
						theme_button($btn, 'btn btn--primary formats__btn', [], empty($btn['url']) ? 'button' : 'a');
						?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
