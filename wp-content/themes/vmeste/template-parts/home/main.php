<?php
$section = $args['section'] ?? (get_field('main') ?: []);
if (!theme_section_show($section)) {
	return;
}

$list = $section['list'] ?? [];
if (empty($list)) {
	$list = [
		['text' => 'Формируем окружение под ваши ценности'],
		['text' => 'Организуем интересные события и интеллектуальный досуг'],
		['text' => 'Создаём условия для искреннего общения'],
		['text' => 'Помогаем найти близких по духу людей'],
	];
}

$clients = $section['clients'] ?? [];
$client_fallbacks = ['clients/logo1.svg', 'logo2.png', 'logo3.png', 'clients/logo4.svg', 'clients/logo5.svg', 'clients/logo6.svg', 'clients/logo7.svg', 'logo8.png', 'clients/logo9.svg', 'clients/logo10.svg', 'clients/logo9.svg', 'clients/logo1.svg', 'logo2.png'];
?>

<main class="main" style="<?= theme_bg_style($section['background'] ?? null, 'image.webp') ?>">
	<div class="main__container container">
		<div class="main__content">
			<div class="main__under-title"><?= esc_html(theme_text($section['under_title'] ?? '', 'Интеллектуальная среда &Брачное агентство')) ?></div>
			<h1 class="main__title"><span class="main__title-text"><?= esc_html(theme_text($section['title'] ?? '', 'ДАВАЙ ВМЕСТЕ')) ?></span></h1>
			<div class="main__description"><?= $section['description'] ?? '<span>Ценностный фундамент</span> семьи и отношений' ?></div>
			<ul class="main__list">
				<?php foreach ($list as $item) : ?>
					<li class="main__list-item"><?= esc_html($item['text'] ?? '') ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="main__buttons">
				<?php
				$btn1 = $section['button_primary'] ?? ['text' => 'Присоединиться'];
				$btn2 = $section['button_secondary'] ?? ['text' => 'Погрузиться в контекст'];
				theme_button($btn1, 'btn btn--primary', ['data-modal' => 'order-modal'], empty($btn1['url']) ? 'button' : 'a');
				theme_button($btn2, 'btn btn--trans', [], empty($btn2['url']) ? 'button' : 'a');
				?>
			</div>
		</div>

		<div class="main__clients">
			<?php if (!empty($clients)) : ?>
				<?php foreach ($clients as $client) : ?>
					<div class="main__clients-item">
						<?php theme_image($client['logo'] ?? null, 'main__clients-img', 'full'); ?>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<?php foreach ($client_fallbacks as $logo) : ?>
					<div class="main__clients-item">
						<img class="main__clients-img" src="<?= esc_url(theme_asset('img/' . $logo)) ?>" loading="lazy" alt="">
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</main>
