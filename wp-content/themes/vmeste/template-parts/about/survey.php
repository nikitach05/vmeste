<?php
$section = $args['section'] ?? (get_field('survey') ?: []);
if (!theme_section_show($section)) {
	return;
}
?>

<section class="survey">
	<div class="survey__card">
		<h2 class="survey__title"><?= nl2br(esc_html(theme_text($section['title'] ?? '', "Пройдите анонимный\nмини-опрос и узнайте,"))) ?></h2>
		<p class="survey__lead"><?= esc_html(theme_text($section['lead'] ?? '', 'кого мы можем предложить лично для вас')) ?></p>
		<p class="survey__text"><?= nl2br(esc_html(theme_text($section['text'] ?? '', "Всего пять шагов и мы подберем вам кандидата.\nВсё анонимно и без спама."))) ?></p>
		<a class="btn btn--primary survey__btn" href="#anketa">
			<?= esc_html(theme_text($section['button_text'] ?? '', 'Пройти опрос')) ?>
		</a>
		<p class="survey__note"><?= esc_html(theme_text($section['note'] ?? '', '*Данные придут на вашу почту')) ?></p>
	</div>
</section>
