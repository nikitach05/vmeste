<?php
$section = $args['section'] ?? (get_field('founder') ?: []);
if (!theme_section_show($section)) {
	return;
}
?>

<section class="founder p-indent">
	<div class="container">
		<div class="founder__layout">
			<div class="founder__main">
				<h2 class="founder__title">
					<span><?= esc_html(theme_text($section['title_1'] ?? '', 'Основатель')) ?></span>
					<span><?= esc_html(theme_text($section['title_2'] ?? '', 'проекта')) ?></span>
				</h2>
				<div class="founder__photo">
					<?php theme_image($section['photo'] ?? null, '', 'large', 'image6.webp'); ?>
				</div>
				<div class="founder__intro">
					<h3 class="founder__name"><?= esc_html(theme_text($section['name'] ?? '', 'Елена Барвина')) ?></h3>
					<p class="founder__role"><?= esc_html(theme_text($section['role'] ?? '', 'Ваш медиатор в среде осознанных отношений')) ?></p>
					<p class="founder__text"><?= esc_html(theme_text($section['intro'] ?? '', 'Восемь лет я организовывала свадебные торжества — безупречные декорации для начала пути. Но за красивым кадром я часто видела хрупкость союзов. Это побудило меня сменить фокус: вместо организации событий я стала помогать людям в создании семейного наследия.')) ?></p>
				</div>
				<p class="founder__aside"><?= esc_html(theme_text($section['aside'] ?? '', 'Я замужем уже 14 лет и могу сказать, что созидательный союз — это настоящая «командная игра». Когда дом становится крепостью взаимной поддержки, вы обретаете фундамент для династии и укрепления себя в этом мире.')) ?></p>
			</div>
			<div class="founder__side">
				<div class="founder__portrait">
					<div class="founder__badge"><?= esc_html(theme_text($section['badge'] ?? '', 'Давайте создадим ваше сильное будущее вместе!')) ?></div>
					<?php theme_image($section['portrait'] ?? null, '', 'large', 'image7.webp'); ?>
				</div>
				<div class="founder__notes">
					<p class="founder__text"><?= esc_html(theme_text($section['note_1'] ?? '', '«Давай вместе» — это ответ инфошуму, жизненному хаосу и дефициту искренности. В этом проекте я ваш куратор, преобразующий искреннее желание найти своего человека в выверенный план действий.')) ?></p>
					<p class="founder__text"><?= esc_html(theme_text($section['note_2'] ?? '', 'Моя миссия — исключить случайность и создать «чистый контекст», где вы встречаете только резонирующих по масштабу и ценностям людей.')) ?></p>
				</div>
				<div class="founder__family">
					<?php theme_image($section['family'] ?? null, '', 'large', 'image8.webp'); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="marquee-text">
		<div class="marquee-text__item"><?= esc_html(theme_text($section['marquee_1'] ?? '', 'ЗАКРЫТЫЙ КЛУБ И БРАЧНОЕ АГЕНТСТВО')) ?></div>
		<div class="marquee-text__item"><?= esc_html(theme_text($section['marquee_2'] ?? '', 'ДАВАЙ ВМЕСТЕ ДАВАЙ ВМЕСТЕ')) ?></div>
	</div>
</section>
