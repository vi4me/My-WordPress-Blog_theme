<?php

/* https://api.telegram.org/bot1081320990:AAFan7YRMiygzcL_G81pROxmgaM5FYlWScc/getUpdates,
где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */

$name = $_POST['user_name'];
$phone = $_POST['user_phone'];
$email = $_POST['user_email'];
$token = "1081320990:AAFan7YRMiygzcL_G81pROxmgaM5FYlWScc";
$chat_id = "547270062";
$arr = array(
  'Имя пользователя: ' => $name,
  'Телефон: ' => $phone,
  'Email' => $email
);

foreach($arr as $key => $value) {
  $txt .= "<b>".$key."</b> ".$value."%0A";
};

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

if ($sendToTelegram) {

   echo "Спасибо за обратную связь, мы с вами свяжемся в ближайшее время.";

} else {
  echo "Ошибка";
}
?>
