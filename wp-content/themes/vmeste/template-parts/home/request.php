<?php
$section = $args['section'] ?? (get_field('request') ?: []);
if (!theme_section_show($section)) {
	return;
}

$offer = $section['offer_label'] ?? 'Я подтверждаю, что ознакомлен (а) с <a href="#">офертой</a>';
$privacy = $section['privacy_label'] ?? 'Я подтверждаю, что ознакомлен (а) с <a href="#">политикой в отношении обработки персональных данных</a> и даю своё согласие на обработку персональных данных';
$ads = $section['ads_label'] ?? 'Я ознакомлен (а) с <a href="#">политикой рекламной рассылки</a> и даю своё согласие на рекламную рассылку';
?>

<section class="request p-indent" id="contacts">
	<div class="container">
		<div class="request__header">
			<h2 class="request__title"><?= nl2br(esc_html(theme_text($section['title'] ?? '', "Давайте вместе сделаем шаг\nк осмысленным отношениям"))) ?></h2>
			<p class="request__text"><?= esc_html(theme_text($section['text'] ?? '', 'Оставьте заявку, чтобы открыть доступ к среде созвучных людей.')) ?></p>
		</div>
		<form class="request__form">
			<input class="request__input input required" type="text" name="name" placeholder="Ваше имя" autocomplete="name">
			<div class="request__phone">
				<img class="request__flag" src="<?= esc_url(theme_asset('img/svg/ru.svg')) ?>" alt="">
				<input class="request__input input required" type="tel" name="phone" placeholder="+7 999 999 99 99" autocomplete="tel">
			</div>
			<input class="request__input input required" type="email" name="email" placeholder="Электронная почта" autocomplete="email">
			<div class="request__checks">
				<div class="field checkbox-field">
					<div class="checkbox-field__box">
						<input type="checkbox" class="checkbox-field__input required" name="offer">
					</div>
					<div class="checkbox-field__label"><?= $offer ?></div>
				</div>
				<div class="field checkbox-field">
					<div class="checkbox-field__box">
						<input type="checkbox" class="checkbox-field__input required" name="privacy">
					</div>
					<div class="checkbox-field__label"><?= $privacy ?></div>
				</div>
				<div class="field checkbox-field">
					<div class="checkbox-field__box">
						<input type="checkbox" class="checkbox-field__input required" name="ads">
					</div>
					<div class="checkbox-field__label"><?= $ads ?></div>
				</div>
			</div>
			<button class="btn btn--primary request__submit send-form" type="button">
				<?= esc_html(theme_text($section['submit_text'] ?? '', 'Отправить заявку')) ?>
			</button>
		</form>
	</div>
</section>