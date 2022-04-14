<?php
$name = $_POST['full_name'];
$birthdate = (new DateTime($_POST['birthday']))->format('d.m.Y');
$phone = $_POST['tel'];
$email = $_POST['email'];
$city = $_POST['city'];
$school = $_POST['school'];
$question = $_POST['question'];

$name = htmlspecialchars($name);
$birthdate = htmlspecialchars($birthdate);
$phone = htmlspecialchars($phone);
$email = htmlspecialchars($email);
$city = htmlspecialchars($city);
$school = htmlspecialchars($school);
$question = htmlspecialchars($question);

$data = [
  'REMOTE_ADDR' => isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['REMOTE_ADDR'] . "/" . $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'],
  'HTTP_REFERER' => isset($_COOKIE['referrer']) ? urldecode($_COOKIE['referrer']) : null,
  'QUERY_STRING' => isset($_COOKIE['query_string']) ? str_replace('?', '', urldecode($_COOKIE['query_string'])) : null,
  'form' => 'dod',
  'name' => $name,
  'birthdate' => $birthdate,
  'phone' => $phone,
  'email' => $email,
  'city' => $city,
  'comments' => 'Школа: ' . $_POST['school'] . "\n" . 'Вопрос: ' . $_POST['question']
];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://crm.tusur.ru/index.php?r=api/order',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => $data,
));

$response = curl_exec($curl);
curl_close($curl);
$response = json_decode($response);

if ($response && isset($response->result) && $response->result === 'ok') {
  echo 'Спасибо! Ваша заявка принята!';
}
