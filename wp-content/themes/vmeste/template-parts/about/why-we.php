<?php
$section = $args['section'] ?? (get_field('why_we') ?: []);
if (!theme_section_show($section)) {
	return;
}

$items = $section['items'] ?? [];
if (empty($items)) {
	$items = [
		['caption' => 'К нам обращаются люди, ценящие зрелость, интеллектуальную совместимость и прозрачные намерения', '_photo' => 'image18.webp'],
		['caption' => 'Среди наших кандидатов есть не только предприниматели, но и представители самых различных сфер', '_photo' => 'image19.webp'],
		['caption' => 'В том числе и те, кто ищет «своих» зарубежом', '_photo' => 'image20.webp'],
	];
}
?>

<section class="why-we p-indent">
	<div class="container">
		<div class="why-we__intro">
			<div class="why-we__label under-title"><?= esc_html(theme_text($section['under_title'] ?? '', 'Клиенты агентства')) ?></div>
			<h2 class="why-we__header title">
				<span class="why-we__header-text why-we__header-text--desktop"><?= esc_html(theme_text($section['title_desktop'] ?? '', 'Экосистема осмысленных отношений')) ?></span>
				<span class="why-we__header-text why-we__header-text--mobile"><?= esc_html(theme_text($section['title_mobile'] ?? '', 'Найдите «своего» человека в комфортной среде')) ?></span>
			</h2>
			<p class="why-we__subtitle"><?= esc_html(theme_text($section['subtitle'] ?? '', 'Какие люди в нашей среде')) ?></p>
			<p class="why-we__text"><?= esc_html(theme_text($section['text'] ?? '', 'Мы создали условия для сближения на вашем уровне. В интеллектуальной обстановке, без публики и репутационных рисков.')) ?></p>
		</div>
		<ul class="why-we__list">
			<?php foreach ($items as $item) : ?>
				<li class="why-we__item">
					<?php theme_image($item['photo'] ?? null, 'why-we__photo', 'large', $item['_photo'] ?? 'image18.webp'); ?>
					<p class="why-we__caption"><?= esc_html($item['caption'] ?? '') ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
