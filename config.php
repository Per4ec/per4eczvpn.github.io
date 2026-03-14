<?php
// config.php

define('TELEGRAM_TOKEN', '8582977696:AAH5cmD-pjbF7J60R49MW0rB7onmje8DHLY'); // Замените на ваш токен
define('TELEGRAM_CHAT_ID', '5099005051'); // Замените на ваш Chat ID

// Функция для отправки сообщения в Telegram
function sendToTelegram($message) {
    $url = "https://api.telegram.org/bot" . TELEGRAM_TOKEN . "/sendMessage";
    $data = [
        'chat_id' => TELEGRAM_CHAT_ID,
        'text' => $message,
        'parse_mode' => 'HTML' // Для форматирования текста
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    file_get_contents($url, false, $context);
}
?>
