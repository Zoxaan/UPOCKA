<?php
session_start();

// Массив доступных математических операций
$operations = ['+', '-', '*'];

// Генерируем случайные числа
$num1 = rand(1, 10);
$num2 = rand(1, 10);

// Выбираем случайную математическую операцию
$operation = $operations[array_rand($operations)];

// Вычисляем результат
switch ($operation) {
    case '+':
        $result = $num1 + $num2;
        break;
    case '-':
        $result = $num1 - $num2;
        break;
    case '*':
        $result = $num1 * $num2;
        break;
}

// Сохраняем результат в сессию
$_SESSION['captcha_result'] = $result;

// Выводим математический пример
echo $num1 . ' ' . $operation . ' ' . $num2 . ' = ?';
?>