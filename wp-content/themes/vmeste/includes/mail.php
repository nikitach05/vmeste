<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

add_action( 'wp_ajax_send_form', 'send_form' );
add_action( 'wp_ajax_nopriv_send_form', 'send_form' );
function send_form() {

  $mail = connectSMTP();

  $mail_from = get_field('mail_from', 'option') ?: 'info@example.com';
  $mail->setFrom($mail_from, get_bloginfo('name'));

  $mail->isHTML(true);
  $subject = get_bloginfo('name') . ' — заявка';
  $mail->Subject = $subject;

  $body = '';

  $mail_to = get_field('mail_to', 'option');
  if (!empty($mail_to)) {
    foreach ($mail_to as $email) {
      if (!empty($email['email'])) {
        $mail->addAddress($email['email'], get_bloginfo('name'));
      }
    }
  }

  $fields = [
    'name' => 'Имя / ФИО',
    'phone' => 'Телефон',
    'email' => 'Email',
    'birthdate' => 'Дата рождения',
    'gender' => 'Пол',
    'city' => 'Город',
    'family' => 'Семейное положение',
    'partner' => 'Предпочтения по партнёру',
    'money' => 'Материальное положение',
  ];

  foreach ($fields as $key => $label) {
    if (!empty($_POST[$key])) {
      $body .= $label . ': ' . sanitize_text_field(wp_unslash($_POST[$key])) . '<br>';
    }
  }

  // Обработка загруженного файла (только один файл)
  if (!empty($_FILES['file']['name']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

    $original_name = sanitize_file_name($_FILES['file']['name']);
    $tmp_name = $_FILES['file']['tmp_name'];

    // Прикрепляем файл напрямую к письму без сохранения на сервер
    $mail->addAttachment($tmp_name, $original_name);
  }

  $mail->Body = $body;

  try {
    $mail->send();
    wp_send_json_success([
      'message' => 'Заявка успешно отправлена'
    ]);
  } catch (Exception $e) {
    wp_send_json_error([
      // 'message' => 'Не удалось отправить заявку. Попробуйте позже.'
      'message' => $e->getMessage()
    ]);
  }

  wp_die();
}

function connectSMTP() {
  // PHPMailer options
  $mail = new PHPMailer(true);

  $mail->CharSet = 'UTF-8';

  $mail->SMTPDebug = SMTP::DEBUG_SERVER;
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPDebug = 0;

  $mail->Host = 'ssl://smtp.mail.ru';
  $mail->Username = 'info@dawaivmeste.ru';
  $mail->Password = 'T6eTdOyz7HFFHp';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  $mail->Port = 465;

  return $mail;
}