<?php
session_start();
// Генерируем случайные числа
$num1 = rand(1, 10);
$num2 = rand(1, 10);
// Вычисляем результат
$result = $num1 + $num2;
// Сохраняем результат в сессии
$_SESSION['captcha_result'] = $result;
$error = ""; // Исправляем имя переменной

// Проверяем, существует ли ключ 'error' в сессии и не является ли он null
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Удаляем ошибку после ее обработки
}
?>
<body>
<style>
    body {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('uploads/martin-katler-rjASNUw3SDE-unsplash.jpg') no-repeat center center fixed;
        background-size: cover;
        color: #f8f9fa;
    }
    .container {
        margin-top: 100px;
        text-align: center;
    }
    form {
        display: inline-block;
        background-color: rgba(0, 0, 0, 0.8);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #f8f9fa;
        background-color: rgba(255, 255, 255, 0.1);
        color: #f8f9fa;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        border-radius: 5px;
        color: #f8f9fa;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: scale(1.05);
    }
    .header {
        background-color: rgba(0, 0, 0, 0.8);
        padding: 10px 0;
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
    }
    .header a {
        text-decoration: none;
        color: #f8f9fa;
        font-size: 24px;
        font-weight: bold;
        transition: color 0.3s ease;
    }
    .header a:hover {
        color: #007bff;
    }
    .register-link {
        margin-top: 20px;
        font-size: 14px;
        color: #f8f9fa;
    }
    .register-link a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    .register-link a:hover {
        color: #0056b3;
    }
    .error-message {
        color: #ff0000;
    }
</style>
<div class="header">
    <a href="index.php">Your Site</a>
</div>

<div class="container">
    <h2>Авторизация</h2>
    <form method="post" action="log_controller.php">

        <div class="form-group">
            <label for="mail">Email:</label>
            <input type="email" class="form-control" id="mail" name="mail" placeholder="Введите email" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Введите пароль" required>
        </div>
        <div class="form-group">

            <input type="hidden" value="<?php echo $result ?>" name="result" >
            <?php echo $error ? "<p class='error-message'>$error</p>" : ""; ?>

            <label for="captcha">Решите пример: <?php echo "$num1 + $num2"; ?></label>
            <input type="text" class="form-control" id="captcha" name="captcha"  required>
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
    <div class="register-link">
        Еще не зарегистрированы? <a href="registration.php">Зарегистрироваться</a>
    </div>
</div>
<?php include "foter.php"; ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
