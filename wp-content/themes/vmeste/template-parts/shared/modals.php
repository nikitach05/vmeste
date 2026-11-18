<?php
$modals = $args['modals'] ?? (get_field('modals', 'option') ?: []);
$order_title = theme_text($modals['order_title'] ?? '', 'Оставьте заявку и мы расскажем, чем клуб может быть полезен лично для вас');
$order_submit = theme_text($modals['order_submit'] ?? '', 'Отправить заявку');
$privacy = $modals['privacy_label'] ?? 'Я подтверждаю, что ознакомлен (а) с <a href="#">политикой в отношении обработки персональных данных</a> и даю своё <a href="#">согласие</a> на обработку персональных данных';
$ads = $modals['ads_label'] ?? 'Я ознакомлен (а) с <a href="#">политикой рекламной рассылки</a> и даю своё <a href="#">согласие</a> на рекламную рассылку';
$success_title = theme_text($modals['success_title'] ?? '', 'Спасибо!<br>ваша заявка отправлена');
$success_text = theme_text($modals['success_text'] ?? '', 'Менеджер свяжется с вами в ближайшее время и расскажет все подробности');
?>

<div id="order-modal" style="display: none;">
	<div class="order-modal">
		<button class="order-modal__close" type="button" data-fancybox-close aria-label="Закрыть">
			<svg>
				<use href="<?= esc_url(theme_asset('img/svg-sprite/sprite.svg')) ?>#close"></use>
			</svg>
		</button>
		<h2 class="order-modal__title"><?= esc_html($order_title) ?></h2>
		<form class="order-modal__form">
			<input class="request__input input required" type="text" name="name" placeholder="Ваше имя" autocomplete="name">
			<div class="request__phone">
				<img class="request__flag" src="<?= esc_url(theme_asset('img/svg/ru.svg')) ?>" alt="">
				<span class="order-modal__caret" aria-hidden="true"></span>
				<input class="request__input input required" type="tel" name="phone" placeholder="+7 999 999 99 99" autocomplete="tel">
			</div>
			<div class="request__checks">
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
			<button class="btn btn--primary request__submit send-form" type="button"><?= esc_html($order_submit) ?></button>
		</form>
	</div>
</div>

<div id="success-modal" style="display: none;">
	<div class="success-modal">
		<button class="order-modal__close" type="button" data-fancybox-close aria-label="Закрыть">
			<svg>
				<use href="<?= esc_url(theme_asset('img/svg-sprite/sprite.svg')) ?>#close"></use>
			</svg>
		</button>
		<h2 class="success-modal__title"><?= $success_title ?></h2>
		<p class="success-modal__text"><?= esc_html($success_text) ?></p>
	</div>
</div>
