<?php
session_start();

if (isset($_SESSION['user'])) {
    // Пользователь авторизован
    $user = $_SESSION['user'];

    // Проверка роли пользователя
    if ($user['role'] == 'admin') {
    }
} else {
}

// Выход из сессии и перенаправление на страницу авторизации
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['success_message']); // Очистка только сообщения об успехе
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        /* Стили для блока шапки */
        .custom-navbar {
            background-color: #000000; /* Черный цвет фона */
            padding: 10px 0; /* Внутренние отступы */
            border-bottom: 1px solid #333; /* Нижняя граница */
        }

        /* Стили для логотипа */
        .custom-navbar .navbar-brand {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: 1px;
            color: #ffd000; /* Желтый цвет текста */
        }

        /* Стили для элементов навигации */
        .custom-navbar .nav-link {
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            font-size: 18px;
            letter-spacing: 0.5px;
            color: #ffffff; /* Белый цвет текста */
            padding: 10px 15px; /* Внутренние отступы */
            margin: 0 5px; /* Внешние отступы */
            border-radius: 5px; /* Скругленные углы */
            transition: background-color 0.3s ease; /* Плавный переход */
        }

        .custom-navbar .nav-link:hover {
            background-color: #ffd000; /* Желтый цвет фона при наведении */
            color: #000000; /* Черный цвет текста при наведении */
        }

        /* Стили для выпадающего меню */
        .custom-navbar .dropdown-menu {
            background-color: #343a40; /* Темный цвет фона */
            border: none; /* Удаление границы */
        }

        .custom-navbar .dropdown-item {
            color: #ffffff; /* Белый цвет текста */
        }

        .custom-navbar .dropdown-item:hover {
            background-color: #ffd000; /* Желтый цвет фона при наведении */
            color: #000000; /* Черный цвет текста при наведении */
        }

        /* Стили для логотипа */
        .navbar-brand .logo {
            max-height: 40px; /* Устанавливаем максимальную высоту для логотипа */
            transition: transform 0.3s ease; /* Добавляем плавный переход */
        }

        .navbar-brand .logo:hover {
            transform: scale(1.1); /* Увеличиваем логотип при наведении */
        }
    </style>

</head>
<body>
<div class="container mt-3">
    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="PrinTelo.svg" class="logo" alt="Логотип"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="category.php" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Категории
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="category.php">Категории</a></li>
                            <li><a class="dropdown-item" href="uslugi.php">Просмотр услуг</a></li>
                            <li><a class="dropdown-item" href="tovars.php">Просмотр товаров</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Компания
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="company.php">О нас</a></li>
                            <li><a class="dropdown-item" href="info.php">Информация</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacts.php">Контакты</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if (isset($_SESSION['user'])) {
                                echo "Привет, " . $user['name'];
                            } else {
                                echo "Войти";
                            } ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="login.php">Авторизация</a></li>
                            <li><a class="dropdown-item" href="registration.php">Регистрация</a></li>
                            <?php if (isset($user) && $user['role'] == 'admin') { ?>
                                <li><a class="dropdown-item" href="admin_panel.php">Админ панель</a></li>
                            <?php } ?>
                            <?php if (isset($user) && $user['role'] == 'user') { ?>
                                <li><a class="dropdown-item" href="profile.php">Профиль</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php?logout=1">Выйти</a>
                    </li>
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="clear_session.php">Очистить сессию</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
