<?php
session_start();

// Удаляем все сессионные переменные
$_SESSION = array();

// Если поддерживается PHP 5.3.0 или более поздняя версия, то уничтожаем сессию с помощью функции session_destroy()
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Уничтожаем сессию
session_destroy();

// Перенаправляем пользователя на страницу входа или на главную страницу
header("Location: login.php");
exit;
?>