<?php
// index.php
require_once 'config.php'; // Подключаем токен и функцию

// --- Логика отправки IP ---
// Получаем реальный IP, даже если сайт за прокси (Cloudflare и т.д.)
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    // Часто используется прокси, берем первый IP из цепочки
    $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    $ip = trim($ipList[0]);
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

// Дополнительная информация
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Неизвестно';
$page = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$time = date('Y-m-d H:i:s');

// Формируем сообщение
$message = "🔥 <b>Новый посетитель!</b>\n";
$message .= "🕒 Время: $time\n";
$message .= "🌐 IP-адрес: <code>$ip</code>\n";
$message .= "📱 User Agent: $userAgent\n";
$message .= "📄 Страница: $page";

// Отправляем в Telegram
sendToTelegram($message);

// --- HTML код вашего сайта ---
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой Сайт</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding-top: 50px; }
    </style>
</head>
<body>
    <h1>Добро пожаловать!</h1>
    <p>Это пример сайта с логированием IP в Telegram.</p>
</body>
</html>
