<?php
$section = $args['section'] ?? (get_field('anketa') ?: []);
if (!theme_section_show($section)) {
	return;
}

$offer = $section['offer_label'] ?? 'Я подтверждаю, что ознакомлен (а) с <a href="#">офертой</a>';
$privacy = $section['privacy_label'] ?? 'Я подтверждаю, что ознакомлен (а) с <a href="#">политикой в отношении обработки персональных данных</a> и даю своё согласие на обработку персональных данных';
$ads = $section['ads_label'] ?? 'Я ознакомлен (а) с <a href="#">политикой рекламной рассылки</a> и даю на нее своё согласие';

$telegram = theme_text($section['telegram'] ?? '', '#');
$max = theme_text($section['max'] ?? '', '#');
$vk = theme_text($section['vk'] ?? '', '#');
?>

<section class="anketa p-indent" id="anketa">
	<div class="container">
		<h2 class="anketa__title">Анкета для подбора<span class="anketa__title-break"> </span><span class="anketa__title-tail">кандидата</span></h2>
		<form class="anketa__form">
			<div class="anketa__grid">
				<div class="anketa__col">
					<label class="anketa__field">
						<span class="anketa__label">ФИО</span>
						<input class="anketa__input required" type="text" name="name" placeholder="Иванова Анна Ивановна" autocomplete="name">
					</label>
					<label class="anketa__field">
						<span class="anketa__label">Дата рождения</span>
						<input class="anketa__input required" type="text" name="birthdate" placeholder="21 января 1983" autocomplete="bday">
					</label>
					<fieldset class="anketa__field">
						<legend class="anketa__label">Пол</legend>
						<div class="anketa__options">
							<label class="radio-field">
								<span class="radio-field__box active">
									<input class="radio-field__input" type="radio" name="gender" value="female" checked>
								</span>
								<span class="radio-field__label">Женщина</span>
							</label>
							<label class="radio-field">
								<span class="radio-field__box">
									<input class="radio-field__input" type="radio" name="gender" value="male">
								</span>
								<span class="radio-field__label">Мужчина</span>
							</label>
						</div>
					</fieldset>
					<div class="anketa__field">
						<span class="anketa__label">Номер телефона</span>
						<div class="anketa__phone">
							<img class="anketa__flag" src="<?= esc_url(theme_asset('img/svg/ru.svg')) ?>" alt="">
							<input class="anketa__input required" type="tel" name="phone" placeholder="+7 999 999 99 99" autocomplete="tel">
						</div>
					</div>
					<label class="anketa__field">
						<span class="anketa__label">Адрес электронной почты</span>
						<input class="anketa__input required" type="email" name="email" placeholder="loveyou@love.ru" autocomplete="email">
					</label>
					<label class="anketa__field">
						<span class="anketa__label">Текущий город проживания и фактическое место проживания</span>
						<input class="anketa__input required" type="text" name="city" placeholder="Город и адрес" autocomplete="address-level2">
					</label>
					<div class="anketa__field">
						<label class="anketa__file">
							<input class="anketa__file-input" type="file" name="file" accept="image/*,video/*">
							<img src="<?= esc_url(theme_asset('img/svg/attachment.svg')) ?>" alt="">
							<span class="anketa__file-name">Загрузить файл (фото, видео)</span>
						</label>
					</div>
				</div>
				<div class="anketa__col">
					<fieldset class="anketa__field">
						<legend class="anketa__label">Семейное положение</legend>
						<div class="anketa__options">
							<label class="radio-field">
								<span class="radio-field__box active">
									<input class="radio-field__input" type="radio" name="family" value="single" checked>
								</span>
								<span class="radio-field__label">Не был(а) Женат /Замужем</span>
							</label>
							<label class="radio-field">
								<span class="radio-field__box">
									<input class="radio-field__input" type="radio" name="family" value="married">
								</span>
								<span class="radio-field__label">Женат /Замужем</span>
							</label>
							<label class="radio-field">
								<span class="radio-field__box">
									<input class="radio-field__input" type="radio" name="family" value="divorced">
								</span>
								<span class="radio-field__label">Разведен(-а)/ вдовец\вдова</span>
							</label>
						</div>
					</fieldset>
					<fieldset class="anketa__field">
						<legend class="anketa__label">Вы предпочитаете найти партнера</legend>
						<div class="anketa__options">
							<label class="radio-field">
								<span class="radio-field__box active">
									<input class="radio-field__input" type="radio" name="partner" value="local" checked>
								</span>
								<span class="radio-field__label">Исключительно из вашей страны, города, региона</span>
							</label>
							<label class="radio-field">
								<span class="radio-field__box">
									<input class="radio-field__input" type="radio" name="partner" value="foreign">
								</span>
								<span class="radio-field__label">Только иностранца/иностранку из определенной страны или региона</span>
							</label>
							<label class="radio-field">
								<span class="radio-field__box">
									<input class="radio-field__input" type="radio" name="partner" value="any">
								</span>
								<span class="radio-field__label">Неважно, из какой страны, главное - серьезные отношения</span>
							</label>
						</div>
					</fieldset>
					<fieldset class="anketa__field">
						<legend class="anketa__label">На сколько для вас важно материальное положение вашего будущего партнера?</legend>
						<div class="anketa__options">
							<label class="radio-field">
								<span class="radio-field__box active">
									<input class="radio-field__input" type="radio" name="money" value="key" checked>
								</span>
								<span class="radio-field__label">Очень важно, считаю это одним из ключевых критериев</span>
							</label>
							<label class="radio-field">
								<span class="radio-field__box">
									<input class="radio-field__input" type="radio" name="money" value="important">
								</span>
								<span class="radio-field__label">Важно, но не решающее</span>
							</label>
							<label class="radio-field">
								<span class="radio-field__box">
									<input class="radio-field__input" type="radio" name="money" value="personal">
								</span>
								<span class="radio-field__label">Не имеет большого значения, для меня важнее личные качества и чувства</span>
							</label>
							<label class="radio-field">
								<span class="radio-field__box">
									<input class="radio-field__input" type="radio" name="money" value="none">
								</span>
								<span class="radio-field__label">Совершенно не важно</span>
							</label>
						</div>
					</fieldset>
					<div class="anketa__checks">
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
				</div>
			</div>
			<button class="btn btn--primary anketa__submit send-form" type="button">
				<?= esc_html(theme_text($section['submit_text'] ?? '', 'Отправить анкету')) ?>
			</button>
			<div class="anketa__help">
				<p class="anketa__help-title"><?= esc_html(theme_text($section['help_title'] ?? '', 'Нет времени заполнять анкету?')) ?></p>
				<p class="anketa__help-text"><?= esc_html(theme_text($section['help_text'] ?? '', 'Напишите нам в телеграм и мы ответим вам')) ?></p>
				<div class="anketa__socials">
					<a class="anketa__social" href="<?= esc_url($telegram) ?>" aria-label="Телеграм">
						<span class="anketa__social-icon">
							<img src="<?= esc_url(theme_asset('img/svg/telegram.svg')) ?>" alt="">
						</span>
						Телеграм
					</a>
					<a class="anketa__social" href="<?= esc_url($max) ?>" aria-label="MAX">
						<span class="anketa__social-icon">
							<img src="<?= esc_url(theme_asset('img/svg/max.svg')) ?>" alt="">
						</span>
						MAX
					</a>
					<a class="anketa__social" href="<?= esc_url($vk) ?>" aria-label="ВКонтакте">
						<span class="anketa__social-icon">
							<img src="<?= esc_url(theme_asset('img/svg/vk.svg')) ?>" alt="">
						</span>
						ВКонтакте
					</a>
				</div>
			</div>
		</form>
	</div>
</section>
