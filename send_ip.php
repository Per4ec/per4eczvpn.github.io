<?php
// send_ip.php
require_once 'config.php';

// Функция получения IP (та же, что и в примере выше)
function getUserIP() {
    // ... (вставьте сюда код получения IP из предыдущего примера) ...
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ipList[0]);
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

$ip = getUserIP();
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Неизвестно';
$time = date('Y-m-d H:i:s');
$referer = $_SERVER['HTTP_REFERER'] ?? 'Прямой заход';

$message = "👤 <b>Новый посетитель (HTML)</b>\n";
$message .= "🕒 Время: $time\n";
$message .= "🌐 IP: <code>$ip</code>\n";
$message .= "📱 UA: $userAgent\n";
$message .= "🔗 Откуда: $referer";

sendToTelegram($message);

// Возвращаем пустой ответ для fetch
echo "OK";
?>
