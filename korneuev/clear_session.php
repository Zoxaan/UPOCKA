<?php
session_start();

// Удаление сообщения об успехе из сессии
unset($_SESSION['success_message']);

// Перенаправление обратно на страницу, с которой был выполнен запрос
header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
?>
